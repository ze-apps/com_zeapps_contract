<?php

namespace App\com_zeapps_contract\Controllers;

use App\fr_soca_production\Models\Atelier;
use App\fr_soca_production\Models\Effectif;
use App\fr_soca_production\Models\Salarie;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Storage;
use Zeapps\libraries\XLSXWriter;

class Contracts extends Controller
{
    private $sheet_name;

    public function getAll(Request $request)
    {
        $filters = array();

        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);
        $context = $request->input('context', false);

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE)) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $salaries_rs = Salarie::orderBy('nom') ;

        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $salaries_rs = $salaries_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $salaries_rs = $salaries_rs->where($key, $value) ;
            }
        }

        $total = $salaries_rs->count();
        $salaries_rs_id = $salaries_rs ;

        $salaries = $salaries_rs->limit($limit)->offset($offset)->get();

        if(!$salaries) {
            $salaries = array();
        }


        $ids = [];
        if($total < 500) {
            $rows = $salaries_rs_id->select(array("id"))->get();
            foreach ($rows as $row) {
                array_push($ids, $row->id);
            }
        }

        // Ateliers
        $ateliers = Atelier::orderBy('id')->get();
        if (!$ateliers) {
            $ateliers = array();
        }

        // Total + formatage date fin de contrat (if exist)
        foreach ($salaries as $salarie) {

            // Fin de contrat ?
            if ($salarie->fin_contrat) {
                $salarie->fin_contrat = date('d/m/Y', strtotime($salarie->fin_contrat));
            }

            // Formatage du total
            $salarie->total = $salarie->lundi + $salarie->mardi + $salarie->mercredi + $salarie->jeudi + $salarie->vendredi + $salarie->samedi + $salarie->dimanche;
            $salarie->total = str_replace('.', ',', strval($salarie->total));
        }

        echo json_encode(array(
            'salaries' => $salaries,
            'ateliers' => $ateliers,
            'total' => $total,
            'ids' => $ids
        ));
    }

    public function context()
    {
        $ateliers = Atelier::orderBy('id')->get();
        if (!$ateliers) {
            $ateliers = array();
        }

        echo json_encode(array('ateliers' => $ateliers));
    }

    public function get(Request $request)
    {
        $id = $request->input('id', 0);

        $salarie = new Salarie();

        if ($id > 0) {
            $salarie = Salarie::find($id);

            // Formatage éventuelle date de fon de contrat
            if ($salarie->fin_contrat) {
                $salarie->fin_contrat = date('d/m/Y', strtotime($salarie->fin_contrat));
            }
        }

        echo json_encode(array(
            'salarie' => $salarie
        ));
    }

    public function save()
    {
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {

            // Get posted data by json
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $salarie = new Salarie() ;

        $old_jours = array();
        if (isset($data["id"]) && is_numeric($data["id"]) && $data["id"] > 0) {
            $salarie = Salarie::where('id', $data["id"])->first() ;
            $old_jours['lundi'] = $salarie->lundi;
            $old_jours['mardi'] = $salarie->mardi;
            $old_jours['mercredi'] = $salarie->mercredi;
            $old_jours['jeudi'] = $salarie->jeudi;
            $old_jours['vendredi'] = $salarie->vendredi;
            $old_jours['samedi'] = $salarie->samedi;
            $old_jours['dimanche'] = $salarie->dimanche;
        }

        foreach ($data as $key => $value) {

            if ($key == 'fin_contrat' && $value == '') {
                $value = null;
            } elseif($key == 'fin_contrat' && $value != '')  {
                $value = \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }

            $salarie->$key = $value ;
        }

        $new_jours = array();
        foreach ($old_jours as $key => $value) {
            if ($value != $salarie->$key) {
                $new_jours[$key] = $salarie->$key;
            }
        }

        $salarie->save();

        /*********************
         * Salarié Inactif ?
         */
        if ($salarie->actif == 0) {

            $effectifs = Effectif::getEffectifsForSalaryAndAtelierFromNextWeek($salarie->id);

            foreach ($effectifs as $effectif) {
                $effectif->delete();
            }

        } elseif ($salarie->actif == 1) {

            /**************************************************
             * If new hours : Update effectif from next week
             */
            $effectifs = Effectif::getEffectifsForSalaryAndAtelierFromNextWeek($salarie->id, $salarie->id_atelier);

            if (count($new_jours)) {
                foreach ($effectifs as $effectif) {
                    foreach ($new_jours as $key => $value) {
                        $effectif->$key = $value;
                    }
                    try {
                        $effectif->save();
                    } catch (\Exception $ex) {
                        throw new Exception('Erreur (2) lors de la mise à jour de l\'effectif');
                    }
                }
            }

            /************************************************************
             * If fin_contrat exist, delete from next week of this date
             */

            if ($salarie->fin_contrat) {

                $explode = explode('-', $salarie->fin_contrat);
                $year = $explode[0];

                $next_week = date('W', strtotime($salarie->fin_contrat . ' +1 week'));


                $semaine_fin_contrat = $next_week;
                $annee_fin_contrat = $year;

                $effectifs = Effectif::getEffectifsForSalaryAndAtelierFromNextWeek($salarie->id, null, $semaine_fin_contrat, $annee_fin_contrat);

                foreach ($effectifs as $effectif) {
                    try {
                        $effectif->delete();
                    } catch (\Exception $ex) {
                        throw new Exception('Erreur (3) lors de tentative de mise à jour de l\'effectif');
                    }
                }
            }

        }

        echo $salarie;
    }

    public function delete(Request $request)
    {
        $id = $request->input('id', 0);

        $salarie = Salarie::where('id', $id)->first();

        $deleted = $salarie->delete();

        echo $deleted ? $id : 0;
    }

    public function make_export()
    {
        $salaries = Salarie::orderBy('id', 'ASC') ;

        // Filters
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {

            // Get posted data by json
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['nom LIKE']) && $data['nom LIKE']) {
                $salaries = $salaries->where('nom', 'like', '%' . $data['nom LIKE'] . '%');
            }

            if (isset($data['prenom LIKE']) && $data['prenom LIKE']) {
                $salaries = $salaries->where('prenom', 'like', '%' . $data['prenom LIKE'] . '%');
            }

            if (isset($data['id_atelier']) && $data['id_atelier']) {
                $salaries = $salaries->where('id_atelier', $data['id_atelier']);
            }

        }

        $salaries = $salaries->get();

        if ($salaries) {

            $header = array("string");

            $row1 = array("Liste des salariés");
            $row2 = array("#", "Nom", "Prénom", "Fin contrat", "Atelier", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche", "Total");

            $writer = new XLSXWriter();

            $this->sheet_name = 'Sheet1';

            $writer->writeSheetHeader($this->sheet_name, $header, $suppress_header_row = true);

            // Formatage
            $format = array('font'=>'Arial',
                'font-size' => 12,
                'font-style' => 'bold,italic',
                'border' => 'top, right, left, bottom',
                'halign' => 'center');

            $writer->writeSheetRow($this->sheet_name, $row1, $format);

            $format['font-size'] = 10;

            $writer->writeSheetRow($this->sheet_name, $row2, $format);

            foreach ($salaries as $key => $salarie) {

                $total = $salarie->lundi + $salarie->mardi + $salarie->mercredi +
                    $salarie->jeudi + $salarie->vendredi + $salarie->samedi + $salarie->dimanche ;

                $row3 = array(
                    $salarie->id,
                    $salarie->nom,
                    $salarie->prenom,
                    $salarie->fin_contrat ? date('d/m/Y', strtotime($salarie->fin_contrat)) : '',
                    $salarie->nom_atelier,
                    $salarie->lundi,
                    $salarie->mardi,
                    $salarie->mercredi,
                    $salarie->jeudi,
                    $salarie->vendredi,
                    $salarie->samedi,
                    $salarie->dimanche,
                    str_replace('.', ',', $total) . ' h'
                );

                // Formatage
                $format = array(
                    'halign'=>'center');

                $writer->writeSheetRow($this->sheet_name, $row3, $format);
            }

            $writer->markMergedCell($this->sheet_name, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 4);

            // Gnérer une url temporaire unique pour le fichier Excel dans /tmp
            $link = BASEPATH . 'tmp/salaries_' . Storage::generateRandomString() . '.xlsx';
            $writer->writeToFile($link);

            echo json_encode(array(
                'link' => $link
            ));

        } else {

            echo json_encode(false);
        }
    }

    public function get_export(Request $request)
    {
        $link = $request->input('link', 0);

        // Verifier si l'url commence par /tmp/ et ne contient pas ..
        if ( !strpos($link, '/tmp/') || (strpos($link, '/tmp/') && strpos($link, '/tmp/') == 0) || strpos($link, '..') ) {
            abort(404);
        }

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($link) . "\"");
        header('Content-Length: '. filesize($link));
        header('Expires: 0');
        header('Pragma: no-cache');

        readfile($link);

        // Suppression du fichier zip sur le serveur
        unlink($link);
    }


    public function modal(Request $request) {
        /*$limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $companies_rs = CompaniesModel::orderBy('company_name') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $companies_rs = $companies_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $companies_rs = $companies_rs->where($key, $value) ;
            }
        }

        $total = $companies_rs->count();


        $companies = $companies_rs->limit($limit)->offset($offset)->get();

        if(!$companies) {
            $companies = array();
        }*/



        // TODO : à supprimer à codage
        $total = 0 ;
        $contract_type = array();
        // TODO : à supprimer à codage



        echo json_encode(array("data" => $contract_type, "total" => $total));
    }

}
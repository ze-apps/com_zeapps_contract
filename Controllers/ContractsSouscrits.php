<?php

namespace App\com_zeapps_contract\Controllers;

use App\com_zeapps_contract\Models\ContractSouscrit;
use App\com_zeapps_contract\Models\ContractType;
use App\com_zeapps_contract\Models\ContractTypeTarif;
use Zeapps\Core\Controller;
use Zeapps\Core\Request;

class ContractsSouscrits extends Controller
{

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

        $contracts_souscrits_rs = ContractSouscrit::orderBy('libelle') ;

        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $contracts_souscrits_rs = $contracts_souscrits_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $contracts_souscrits_rs = $contracts_souscrits_rs->where($key, $value) ;
            }
        }

        $total = $contracts_souscrits_rs->count();
        $contracts_souscrits_rs_id = $contracts_souscrits_rs ;

        $contracts_souscrits = $contracts_souscrits_rs->limit($limit)->offset($offset)->get();
        if(!$contracts_souscrits) {
            $contracts_souscrits = array();
        }

        // Formatage affichage pour la vue
        foreach ($contracts_souscrits as $contract) {

            // Contractant
            $contract->contractant = '';
            if ($contract->id_entreprise > 0) {
                $contract->contractant = $contract->id_entreprise_label;
            } elseif ($contract->id_contact > 0) {
                $contract->contractant = $contract->id_contact_label;
            }

            // Couleur label "statut"
            if ($contract->statut == 'Ouvert') {
                $contract->label_color = 'label label-success';
            } elseif ($contract->statut == 'Clôturé') {
                $contract->label_color = 'label label-danger';
            }

            // Prochaine echeance
            $contract->prochaine_echeance = date('d/m/Y', strtotime($contract->date_facturation_suivante));
        }

        $ids = [];
        if($total < 500) {
            $rows = $contracts_souscrits_rs_id->select(array("id"))->get();
            foreach ($rows as $row) {
                array_push($ids, $row->id);
            }
        }

        echo json_encode(array(
            'contracts_souscrits' => $contracts_souscrits,
            'total' => $total,
            'ids' => $ids
        ));
    }

    public function context()
    {

    }

    public function get(Request $request)
    {
        $id = $request->input('id', 0);

        $contract_souscrit = new ContractSouscrit();

        $contract_souscrit_tarifs_formates = array();

        if ($id > 0) {

            $contract_souscrit = ContractSouscrit::find($id);

            // Type of contract
            $contract_type = ContractType::findOrFail($contract_souscrit->id_contrat_type);
            $contract_souscrit->libelle_type_contract = $contract_type->libelle;

            // Tarifs
            $contract_souscrit_tarifs = ContractTypeTarif::where('id_contract_type', $contract_souscrit->id_contrat_type)->get();
            foreach ($contract_souscrit_tarifs as $contract_souscrit_tarif) {
                $contract_souscrit_tarifs_formates[] = $contract_souscrit_tarif->duree_periode . ' mois - ' . $contract_souscrit_tarif->tarif_periode . ' €';
            }

            $contract_souscrit->contract_souscrit_tarifs_formates = $contract_souscrit_tarifs_formates;

            // Formatage des dates
            $contract_souscrit->date_ouverture = date('d/m/Y', strtotime($contract_souscrit->date_ouverture));
            $contract_souscrit->date_premiere_facturation = date('d/m/Y', strtotime($contract_souscrit->date_premiere_facturation));
            $contract_souscrit->date_facturation_suivante = date('d/m/Y', strtotime($contract_souscrit->date_facturation_suivante));
        }

        echo json_encode(array(
            'contract_souscrit' => $contract_souscrit,
        ));
    }

    public function save()
    {

    }

    public function delete(Request $request)
    {
        $id = $request->input('id', 0);
        $contracts = ContractSouscrit::where('id', $id)->first();
        $deleted = $contracts->delete();
        echo json_encode($deleted);
    }

}
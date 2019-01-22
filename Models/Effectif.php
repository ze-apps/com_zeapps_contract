<?php

namespace App\fr_soca_production\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelExportType;
use Zeapps\Core\ModelHelper;
use Zeapps\Core\ObjectHistory;

class Effectif extends Model {

    use SoftDeletes;

    protected $fieldModelInfo ;

    static protected $_table = 'fr_soca_production_effectifs';
    protected $table ;

    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        // Civilite
        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->increments('id');

        $this->fieldModelInfo->string('nom', 255)->default("");
        $this->fieldModelInfo->string('prenom', 255)->default("");

        // Salarie
        $this->fieldModelInfo->integer('id_salarie', false, true)->default(0);

        // Atelier
        $this->fieldModelInfo->integer('id_atelier', false, true)->default(0);
        $this->fieldModelInfo->string('nom_atelier', 255)->default("");

        // Jours
        $this->fieldModelInfo->double('lundi');
        $this->fieldModelInfo->double('mardi');
        $this->fieldModelInfo->double('mercredi');
        $this->fieldModelInfo->double('jeudi');
        $this->fieldModelInfo->double('vendredi');
        $this->fieldModelInfo->double('samedi');
        $this->fieldModelInfo->double('dimanche');

        $this->fieldModelInfo->integer('numero_semaine', false, true)->default(0);
        $this->fieldModelInfo->integer('annee', false, true)->default(0);

        $this->fieldModelInfo->timestamps();
        $this->fieldModelInfo->softDeletes();

        parent::__construct($attributes);
    }

    public static function getSchema() {
        return $schema = Capsule::schema()->getColumnListing(self::$_table) ;
    }

    public function getFields() {
        return $this->fieldModelInfo->getFields();
    }

    public function save(array $options = []) {

        // for history
        $valueOriginal = $this->original ;

        /**** to delete unwanted field ****/
        $schema = self::getSchema();
        foreach ($this->getAttributes() as $key => $value) {
            if (!in_array($key, $schema)) {
                //echo $key . "\n" ;
                unset($this->$key);
            }
        }
        /**** end to delete unwanted field ****/

        $reponse = parent::save($options) ;

        // save to ObjectHistory
        ObjectHistory::addHistory(self::$_table, $this->id, $this->getFields(), $this, $valueOriginal);

        return $reponse;
    }

    public function delete() {

        // for history
        $valueOriginal = $this->original;

        $deleted = parent::delete();

        // save to ObjectHistory
        if ($deleted) {
            ObjectHistory::addHistory(self::$_table, $this->id, $this->getFields(), null, $valueOriginal);
            return true;
        }

        return false;
    }

    public function getModelExport() : ModelExportType {
        $objModelExport = new ModelExportType() ;
        $objModelExport->table = $this->table ;
        $objModelExport->tableLabel = "Salariés" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }

    /**
     * Récupérer effectifs à partir de la semaine prochaine de la date systeme
     *
     * @param $id_salarie
     * @param null $id_atelier
     * @param null $sem_fin_contrat
     * @param null $annee_fin_contrat
     * @return mixed
     */
    public static function getEffectifsForSalaryAndAtelierFromNextWeek($id_salarie, $id_atelier = null, $sem_fin_contrat = null, $annee_fin_contrat = null) {

        $effectifs = Effectif::where('id_salarie', $id_salarie);

        if ($id_atelier) {
            $effectifs = $effectifs->where('id_atelier', $id_atelier);
        }

        if ($sem_fin_contrat && $annee_fin_contrat) {
            $effectifs = $effectifs->whereRaw('( (numero_semaine >= '.$sem_fin_contrat.' and annee = '.$annee_fin_contrat.') or annee > '.$annee_fin_contrat.')');
        } else {
            $effectifs = $effectifs->whereRaw('( (numero_semaine > '.date('W').' and annee = '.date('Y').') or annee > '.date('Y').')');
        }

        return $effectifs->get();
    }

    /**
     * Fonction de calcul du temps dispo pour une semaine donnée
     *
     * @param $numeroSemaine
     * @param $annee
     * @param $type
     * @return mixed
     * @throws \Exception
     */
    public static function getHoursWeekAtelier($numeroSemaine, $annee, $type)
    {


        // Liste des salariés si c'est pour calculer les heures de travail de chaque atelier
        $ateliers = Atelier::all();
        $salaries = Salarie::all();
        $effectifs = Effectif::all();

        if ($type == 'affichage') {
            // Rechercher les effectifs par année et par numéro de semaine (tous les ateliers)
            $effectifs = self::where('numero_semaine', $numeroSemaine)->where('annee', $annee)->get();
        }

        // Ignorer les jours de fermetures exceptionnelles
        $fermetures_exceptionnelles = FermetureExceptionnelle::getFermeturesExceptionnellesDuneAnnee($annee);

        // Ignorer les jours d'absence du salarié
        $absences = Absence::getAbsencesDuneAnnee($annee);

        // Passer le nombre d'heures journalier à 0 pour chaque effectif dont
        foreach ($effectifs as $effectif) {

            foreach ($fermetures_exceptionnelles as $fermeture) {

                $semaine_fermeture = date('W', strtotime($fermeture->date_debut));

                if ($semaine_fermeture == $numeroSemaine) {

                    $date_debut = date('Y-m-d', strtotime($fermeture->date_debut));

                    // Ne pas depasser la semaine en cours (pour la vue seulement)
                    if ($fermeture->date_fin) {

                        $semaine_date_fin = date('W', strtotime($fermeture->date_fin));
                        if ($semaine_date_fin > $numeroSemaine) {
                            if (self::getJourSemaine($date_debut) != 'dimanche') {
                                $fermeture->date_fin = new \DateTime($date_debut . ' Next Sunday');
                            } else {
                                $fermeture->date_fin = new \DateTime($date_debut);
                            }
                            $fermeture->date_fin = $fermeture->date_fin->format('Y-m-d');
                        }
                    }

                    $effectif = self::nbHeuresZeroPourFermetureOuAbsence($fermeture, $effectif, $type);
                }
            }

            foreach ($absences as $absence) {

                $semaine_fermeture = date('W', strtotime($absence->date_debut));

                if ($semaine_fermeture == $numeroSemaine && $effectif->id_salarie == $absence->id_salarie) {

                    $date_debut = date('Y-m-d', strtotime($absence->date_debut));

                    // Ne pas depasser la semaine en cours (pour la vue seulement)
                    if ($absence->date_fin) {

                        $semaine_date_fin = date('W', strtotime($absence->date_fin));
                        if ($semaine_date_fin > $numeroSemaine) {
                            if (self::getJourSemaine($date_debut) != 'dimanche') {
                                $absence->date_fin = new \DateTime($date_debut . ' Next Sunday');
                            } else {
                                $absence->date_fin = new \DateTime($date_debut);
                            }
                            $absence->date_fin = $absence->date_fin->format('Y-m-d');
                        }
                    }

                    $effectif = self::nbHeuresZeroPourFermetureOuAbsence($absence, $effectif, $type);
                }
            }

            /********
             * Total
             */
            $lundi = $effectif->lundi;
            if ($effectif->lundi == -1) {
                $lundi = floatval(0);
            }

            $mardi = $effectif->mardi;
            if ($effectif->mardi == -1) {
                $mardi = floatval(0);
            }

            $mercredi = $effectif->mercredi;
            if ($effectif->mercredi == -1) {
                $mercredi = floatval(0);
            }

            $jeudi = $effectif->jeudi;
            if ($effectif->jeudi == -1) {
                $jeudi = floatval(0);
            }

            $vendredi = $effectif->vendredi;
            if ($effectif->vendredi == -1) {
                $vendredi = floatval(0);
            }

            $samedi = $effectif->samedi;
            if ($effectif->samedi == -1) {
                $samedi = floatval(0);
            }

            $dimanche = $effectif->dimanche;
            if ($effectif->dimanche == -1) {
                $dimanche = floatval(0);
            }

            $effectif->total = $lundi + $mardi + $mercredi + $jeudi + $vendredi + $samedi + $dimanche;
        }

        if ($type == 'calcul') {

            $retour = array();

            foreach ($ateliers as $atelier) {

                $heures = new \stdClass();

                $heures->lundi = $heures->mardi = $heures->mercredi = $heures->jeudi = $heures->vendredi = $heures->samedi = $heures->dimanche = $heures->total = floatval(0);

                foreach ($effectifs as $effectif) {

                    if ($effectif->id_atelier == $atelier->id) {

                        $heures->lundi += $effectif->lundi;
                        $heures->mardi += $effectif->mardi;
                        $heures->mercredi += $effectif->mercredi;
                        $heures->jeudi += $effectif->jeudi;
                        $heures->vendredi += $effectif->vendredi;
                        $heures->samedi += $effectif->samedi;
                        $heures->dimanche += $effectif->dimanche;

                        $heures->total += $effectif->lundi + $effectif->mardi + $effectif->mercredi + $effectif->jeudi + $effectif->vendredi + $effectif->samedi + $effectif->dimanche;
                    }
                }

                $retour[$atelier->id] = $heures;
            }

            return $retour;
        }

        return $effectifs;
    }

    /**
     * Récupère le jour de la semaine en français pour les champs de la table
     *
     * @param $date
     * @return string
     * @throws \Exception
     */
    private static function getJourSemaine($date)
    {
        $ddate = date('Y-m-d', strtotime($date));

        $date = new \DateTime($ddate);
        $day = $date->format("D");

        switch ($day) {
            case 'Mon' :
                return 'lundi';
                break;
            case 'Tue' :
                return 'mardi';
                break;
            case 'Wed' :
                return 'mercredi';
                break;
            case 'Thu' :
                return 'jeudi';
                break;
            case 'Fri' :
                return 'vendredi';
                break;
            case 'Sat' :
                return 'samedi';
                break;
            case 'Sun' :
                return 'dimanche';
                break;
            default :
                return 'error';
                break;
        }
    }

    /**
     * Récupère l'intervalle des dates de début et de fin d'une semaine donnée
     *
     * @param $week
     * @param $year
     * @return mixed
     * @throws \Exception
     */
    public static function getStartAndEndDateOfWeek($week, $year) {

        $dto = new \DateTime();
        $dto->setISODate($year, $week);
        $ret[0] = $dto->format('Y-m-d');

        $i = 1;
        while($i < 7) {
            $dto->modify('+1 day');
            $ret[$i] = $dto->format('Y-m-d');
            $i++;
        }

        return $ret;
    }

    /**
     * Prend un effectif en entrée, et nous le renvoie après avoir mis ses jour à 0
     * selon la fermeture ou l'absence (date fixe ou période)
     *
     * @param $fermeture_ou_absence
     * @param $effectif
     * @param string $type
     * @return mixed
     * @throws \Exception
     */
    private static function nbHeuresZeroPourFermetureOuAbsence($fermeture_ou_absence, $effectif, $type)
    {
        if (is_null($fermeture_ou_absence->date_fin)) {
            $jour = self::getJourSemaine($fermeture_ou_absence->date_debut);
            $effectif->$jour = $type == 'affichage' ? floatval(-1) : floatval(0);
        } else {
            $begin = new \DateTime($fermeture_ou_absence->date_debut);
            $end = new \DateTime(date('Y-m-d', strtotime($fermeture_ou_absence->date_fin . ' +1 day')));

            $interval = \DateInterval::createFromDateString('1 day');
            $period = new \DatePeriod($begin, $interval, $end);

            foreach ($period as $dt) {
                $jour = self::getJourSemaine($dt->format('Y-m-d'));
                $effectif->$jour = $type == 'affichage' ? floatval(-1) : floatval(0);
            }
        }

        return $effectif;
    }

}
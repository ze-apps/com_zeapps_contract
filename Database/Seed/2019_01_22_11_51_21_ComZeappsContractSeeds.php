<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\fr_soca_production\Models\Soca as OpportunityModel;


class ComZeappsContractSeeds
{
    public function run()
    {
        Capsule::table('zeapps_modules')->insert([
            'module_id' => "com_zeapps_contract",
            'label' => "com_zeapps_contract",
            'active' => "1",
            'version' => "1.0.0",
            'last_sql' => "0",
            'dependencies' => "",
            'missing_dependencies' => "",
            'created_at'=>'2019-01-22',
            'updated_at'=>'2019-01-22',
        ]);

        /***************************************************************************
         * ATELIERS
         */

        /*Capsule::table('fr_soca_production_ateliers')->insert([
            'label' => "BE",
            'ordre' => 1,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20',
        ]);
        Capsule::table('fr_soca_production_ateliers')->insert([
            'label' => "Menuiserie",
            'ordre' => 2,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20',
        ]);
        Capsule::table('fr_soca_production_ateliers')->insert([
            'label' => "Achat",
            'ordre' => 3,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20',
        ]);
        Capsule::table('fr_soca_production_ateliers')->insert([
            'label' => "Expédition",
            'ordre' => 4,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20',
        ]);
        Capsule::table('fr_soca_production_ateliers')->insert([
            'label' => "Vente",
            'ordre' => 5,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20',
        ]);
        Capsule::table('fr_soca_production_ateliers')->insert([
            'label' => "Matière première",
            'ordre' => 6,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20',
        ]);
*/
        /****************************************************************************
         * SALARIES
         */

        /*Capsule::table('fr_soca_production_salaries')->insert([
            'nom' => "BENNANE",
            'prenom' => "Aziz",

            'fin_contrat' => null,
            'actif' => 1,

            'id_atelier' => 1,
            'nom_atelier' => "BE",

            'lundi' => 7,
            'mardi' => 7.5,
            'mercredi' => 8,
            'jeudi' => 7,
            'vendredi' => 8,
            'samedi' => 0,
            'dimanche' => 0,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
        Capsule::table('fr_soca_production_salaries')->insert([
            'nom' => "RAMEL",
            'prenom' => "Nicolas",

            'fin_contrat' => null,
            'actif' => 1,

            'id_atelier' => 2,
            'nom_atelier' => "Menuiserie",

            'lundi' => 8,
            'mardi' => 8,
            'mercredi' => 8,
            'jeudi' => 8,
            'vendredi' => 7.5,
            'samedi' => 4,
            'dimanche' => 0,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
        Capsule::table('fr_soca_production_salaries')->insert([
            'nom' => "DUPONT",
            'prenom' => "François",

            'fin_contrat' => '2019-03-01',
            'actif' => 1,

            'id_atelier' => 3,
            'nom_atelier' => "Achat",

            'lundi' => 7,
            'mardi' => 7.5,
            'mercredi' => 8,
            'jeudi' => 7.5,
            'vendredi' => 0,
            'samedi' => 0,
            'dimanche' => 0,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
        Capsule::table('fr_soca_production_salaries')->insert([
            'nom' => "MARCHAL",
            'prenom' => "Olivier",

            'fin_contrat' => '2019-03-31',
            'actif' => 1,

            'id_atelier' => 2,
            'nom_atelier' => "Menuiserie",

            'lundi' => 5,
            'mardi' => 6.5,
            'mercredi' => 7,
            'jeudi' => 6.5,
            'vendredi' => 5,
            'samedi' => 0,
            'dimanche' => 0,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
        Capsule::table('fr_soca_production_salaries')->insert([
            'nom' => "LEFEVRE",
            'prenom' => "Nathalie",

            'fin_contrat' => null,
            'actif' => 0,

            'id_atelier' => 5,
            'nom_atelier' => "Vente",

            'lundi' => 8,
            'mardi' => 7.5,
            'mercredi' => 8,
            'jeudi' => 7.5,
            'vendredi' => 6,
            'samedi' => 4,
            'dimanche' => 0,
            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);*/


        /******************************************************************************
         * fermetures exceptionnelles
         */
/*
        Capsule::table('fr_soca_production_fermetures_exceptionnelles')->insert([

            'libelle' => "Lundi de Pâques",
            'date_debut' => "2019-04-02 00:00:00",
            'date_fin' => null,

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
        Capsule::table('fr_soca_production_fermetures_exceptionnelles')->insert([

            'libelle' => "Fête du travail",
            'date_debut' => "2019-05-01 00:00:00",
            'date_fin' => null,

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
        Capsule::table('fr_soca_production_fermetures_exceptionnelles')->insert([

            'libelle' => "Ascension",
            'date_debut' => "2019-05-10 00:00:00",
            'date_fin' => null,

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
        Capsule::table('fr_soca_production_fermetures_exceptionnelles')->insert([

            'libelle' => "Congés été",
            'date_debut' => "2019-08-01 00:00:00",
            'date_fin' => "2019-08-15 00:00:00",

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
        Capsule::table('fr_soca_production_fermetures_exceptionnelles')->insert([

            'libelle' => "Congés hiver",
            'date_debut' => "2019-12-01 00:00:00",
            'date_fin' => "2019-12-31 00:00:00",

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);

*/
        /******************************************************************************
         * Absences salaries
         */
/*
        Capsule::table('fr_soca_production_absences_salaries')->insert([

            'libelle' => "Congés hiver",
            'date_debut' => "2019-12-21 00:00:00",
            'date_fin' => "2019-12-31 00:00:00",

            'id_salarie' => 1,
            'nom_prenom_salarie' => "BENNANE Aziz",

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);

        Capsule::table('fr_soca_production_absences_salaries')->insert([

            'libelle' => "Congés été",
            'date_debut' => "2019-06-01 00:00:00",
            'date_fin' => "2019-06-22 00:00:00",

            'id_salarie' => 1,
            'nom_prenom_salarie' => "BENNANE Aziz",

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);

        Capsule::table('fr_soca_production_absences_salaries')->insert([

            'libelle' => "Congés hiver",
            'date_debut' => "2019-11-01 00:00:00",
            'date_fin' => "2019-11-11 00:00:00",

            'id_salarie' => 2,
            'nom_prenom_salarie' => "RAMEL Nicolas",

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);

        Capsule::table('fr_soca_production_absences_salaries')->insert([

            'libelle' => "Congés été",
            'date_debut' => "2019-07-01 00:00:00",
            'date_fin' => "2019-07-22 00:00:00",

            'id_salarie' => 2,
            'nom_prenom_salarie' => "RAMEL Nicolas",

            'created_at'=>'2018-12-20',
            'updated_at'=>'2018-12-20'
        ]);
*/

    }
}

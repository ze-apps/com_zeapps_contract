<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Zeapps\Core\Storage;


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

        ///////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////// CONTRATS_TYPES ///////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////
        ///
        Capsule::table('com_zeapps_contract_contracts_types')->insert([
            'libelle' => "WEB",
            'actif' => "Oui",
            'created_at'=>'2019-01-24',
            'updated_at'=>'2019-01-24',
        ]);
        Capsule::table('com_zeapps_contract_contracts_types')->insert([
            'libelle' => "HOSTING",
            'actif' => "Oui",
            'created_at'=>'2019-01-24',
            'updated_at'=>'2019-01-24',
        ]);
        Capsule::table('com_zeapps_contract_contracts_types')->insert([
            'libelle' => "STORAGE",
            'actif' => "Non",
            'created_at'=>'2019-01-24',
            'updated_at'=>'2019-01-24',
        ]);

        ///////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////// CONTRATS_TYPES TARIFS ///////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////
        ///
        Capsule::table('com_zeapps_contract_contracts_types_tarifs')->insert([
            'id_contract_type' => 1,
            'duree_periode' => 67,
            'tarif_periode' => 112.00,
            'duree_minimale_contract' => 24,
            'frais_resiliation' => 15.5,
            'frais_modification' => 17.9,
            'frais_installation' => 18.9,
            'id_taux_tva' => 1,
            'id_taux_tva_value' => 20.15,
            'compte_compta' => "compte_compta_1",
            'created_at'=>'2019-01-24',
            'updated_at'=>'2019-01-24',
        ]);
        Capsule::table('com_zeapps_contract_contracts_types_tarifs')->insert([
            'id_contract_type' => 2,
            'duree_periode' => 50,
            'tarif_periode' => 125.45,
            'duree_minimale_contract' => 30,
            'frais_resiliation' => 36.5,
            'frais_modification' => 20.5,
            'frais_installation' => 19.9,
            'id_taux_tva' => 2,
            'id_taux_tva_value' => 10.99,
            'compte_compta' => "compte_compta_1",
            'created_at'=>'2019-01-24',
            'updated_at'=>'2019-01-24',
        ]);
        Capsule::table('com_zeapps_contract_contracts_types_tarifs')->insert([
            'id_contract_type' => 2,
            'duree_periode' => 47,
            'tarif_periode' => 88.60,
            'duree_minimale_contract' => 24,
            'frais_resiliation' => 33.25,
            'frais_modification' => 11.9,
            'frais_installation' => 18.5,
            'id_taux_tva' => 1,
            'id_taux_tva_value' => 20.15,
            'compte_compta' => "compte_compta_2",
            'created_at'=>'2019-01-24',
            'updated_at'=>'2019-01-24',
        ]);

        ///////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// CONTRATS //////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////
        ///
        Capsule::table('com_zeapps_contract_contracts_souscrits')->insert([
            'id_entreprise' => 1,
            'id_contact' => 1,
            'id_entreprise_label' => 'Apple',
            'id_contact_label' => 'M. Steve Jobs',
            'libelle' => 'Hébergement',
            'numero_piece' => strtoupper(Storage::generateRandomString()),
            'date_ouverture' => '2019-06-30',
            'date_premiere_facturation' => '2019-07-15',
            'date_facturation_suivante' => '2019-07-22',
            'delai_renouvellement' => 30,
            'statut' => 'Ouvert',
            'commentaire' => 'Premier contrat avec ce client ...',
            'id_contrat_type' => 1,
            'id_contrat_type_tarif' => 1,
            'created_at'=>'2019-01-28',
            'updated_at'=>'2019-01-28',
        ]);

    }
}

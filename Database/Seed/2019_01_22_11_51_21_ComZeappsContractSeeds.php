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

    }
}

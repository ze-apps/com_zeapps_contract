<?php

use Zeapps\Core\Routeur ;

Routeur::get('/com_zeapps_contract/contracts/types/tarifs/get/{id}', 'App\\com_zeapps_contract\\Controllers\\ContractsTypesTarifs@get');
Routeur::post("/com_zeapps_contract/contracts/types/tarifs/save", 'App\\com_zeapps_contract\\Controllers\\ContractsTypesTarifs@save');
Routeur::post("/com_zeapps_contract/contracts/types/tarifs/delete/{id}", 'App\\com_zeapps_contract\\Controllers\\ContractsTypesTarifs@delete');

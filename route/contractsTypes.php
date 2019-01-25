<?php

use Zeapps\Core\Routeur ;

Routeur::get('/com_zeapps_contract/contracts/types/liste', 'App\\com_zeapps_contract\\Controllers\\View@contractsTypes');
Routeur::post('com_zeapps_contract/contracts/types/getAll/{limit}/{offset}/{context}', 'App\\com_zeapps_contract\\Controllers\\ContractsTypes@getAll');
Routeur::get('/com_zeapps_contract/contracts/types/get/{id}', 'App\\com_zeapps_contract\\Controllers\\ContractsTypes@get');
Routeur::post("/com_zeapps_contract/contracts/types/save", 'App\\com_zeapps_contract\\Controllers\\ContractsTypes@save');
Routeur::get('/com_zeapps_contract/contracts/types/view', 'App\\com_zeapps_contract\\Controllers\\View@contractsTypesView');
Routeur::post("/com_zeapps_contract/contracts/types/delete/{id}", 'App\\com_zeapps_contract\\Controllers\\ContractsTypes@delete');

// Modal
Routeur::get('/com_zeapps_contract/contracts/types/modal_liste/', 'App\\com_zeapps_contract\\Controllers\\View@contractsFormModal');
Routeur::post("/com_zeapps_contract/contracts/types/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\ContractsTypes@modal');

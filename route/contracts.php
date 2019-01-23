<?php

use Zeapps\Core\Routeur ;

///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// CONTRACTS /////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///
Routeur::post("/com_zeapps_contract/contracts/context/", 'App\\com_zeapps_contract\\Controllers\\Contracts@context');
Routeur::post("/com_zeapps_contract/contracts/save", 'App\\com_zeapps_contract\\Controllers\\Contracts@save');
Routeur::post("/com_zeapps_contract/contracts/delete/{id}", 'App\\com_zeapps_contract\\Controllers\\Contracts@delete');

Routeur::get('/com_zeapps_contract/contracts/view', 'App\\com_zeapps_contract\\Controllers\\View@contractView');

Routeur::get('/com_zeapps_contract/contracts/get/{id}', 'App\\com_zeapps_contract\\Controllers\\Contracts@get');
Routeur::get('/com_zeapps_contract/contracts/liste', 'App\\com_zeapps_contract\\Controllers\\View@contracts');

Routeur::post("/com_zeapps_contract/contracts/getAll/{limit}/{offset}/{context}", 'App\\com_zeapps_contract\\Controllers\\Contracts@getAll');

// Types
Routeur::get('/com_zeapps_contract/contracts/types/modal_liste', 'App\\com_zeapps_contract\\Controllers\\View@contractsFormModal');
Routeur::get('/com_zeapps_contract/contracts/types/liste', 'App\\com_zeapps_contract\\Controllers\\View@contractsTypes');
Routeur::get('/com_zeapps_contract/contracts/types/config', 'App\\com_zeapps_contract\\Controllers\\View@contractsConfig');

// Modal
Routeur::get('/com_zeapps_contract/contracts/types/modal_liste/', 'App\\com_zeapps_contract\\Controllers\\View@contractsFormModal');
Routeur::post("/com_zeapps_contract/contracts/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\Contracts@modal');

// Excel
Routeur::post("/com_zeapps_contract/contracts/make_export/", 'App\\com_zeapps_contract\\Controllers\\Contracts@make_export');
Routeur::get("/com_zeapps_contract/contracts/get_export/", 'App\\com_zeapps_contract\\Controllers\\Contracts@get_export');
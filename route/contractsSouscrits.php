<?php

use Zeapps\Core\Routeur ;


Routeur::post("/com_zeapps_contract/contracts/context/", 'App\\com_zeapps_contract\\Controllers\\ContractsSouscrits@context');
Routeur::post("/com_zeapps_contract/contracts/save", 'App\\com_zeapps_contract\\Controllers\\ContractsSouscrits@save');
Routeur::get('/com_zeapps_contract/contracts/get/{id}', 'App\\com_zeapps_contract\\Controllers\\ContractsSouscrits@get');
Routeur::get('/com_zeapps_contract/contracts/view', 'App\\com_zeapps_contract\\Controllers\\View@contractView');
Routeur::post("/com_zeapps_contract/contracts/delete/{id}", 'App\\com_zeapps_contract\\Controllers\\ContractsSouscrits@delete');
Routeur::get('/com_zeapps_contract/contracts/get/{id}', 'App\\com_zeapps_contract\\Controllers\\ContractsSouscrits@get');
Routeur::get('/com_zeapps_contract/contracts/liste', 'App\\com_zeapps_contract\\Controllers\\View@contracts');
Routeur::post("/com_zeapps_contract/contracts/getAll/{limit}/{offset}/{context}", 'App\\com_zeapps_contract\\Controllers\\ContractsSouscrits@getAll');

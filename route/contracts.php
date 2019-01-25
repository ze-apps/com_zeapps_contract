<?php

use Zeapps\Core\Routeur ;


Routeur::post("/com_zeapps_contract/contracts/context/", 'App\\com_zeapps_contract\\Controllers\\Contracts@context');
Routeur::post("/com_zeapps_contract/contracts/save", 'App\\com_zeapps_contract\\Controllers\\Contracts@save');
Routeur::get('/com_zeapps_contract/contracts/view', 'App\\com_zeapps_contract\\Controllers\\View@contractView');
Routeur::post("/com_zeapps_contract/contracts/delete/{id}", 'App\\com_zeapps_contract\\Controllers\\Contracts@delete');
Routeur::get('/com_zeapps_contract/contracts/get/{id}', 'App\\com_zeapps_contract\\Controllers\\Contracts@get');
Routeur::get('/com_zeapps_contract/contracts/liste', 'App\\com_zeapps_contract\\Controllers\\View@contracts');

Routeur::post("/com_zeapps_contract/contracts/getAll/{limit}/{offset}/{context}", 'App\\com_zeapps_contract\\Controllers\\Contracts@getAll');
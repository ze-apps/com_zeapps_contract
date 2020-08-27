<?php

/*************** insert in essential menu ***************/
$tabMenu = array () ;
$tabMenu["label"] = "Contrats" ;
$tabMenu["url"] = "/ng/com_zeapps_contract/contracts/liste" ;
$tabMenu["access"] = "com_zeapps_contract_read" ;
$tabMenu["order"] = 0 ;
$menuEssential[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["label"] = "Contrats types" ;
$tabMenu["url"] = "/ng/com_zeapps_contract/contracts/types/liste" ;
$tabMenu["access"] = "com_zeapps_contract_admin" ;
$tabMenu["order"] = 1 ;
$menuEssential[] = $tabMenu ;

/***************** insert in left menu ******************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_contract_contrats";
$tabMenu["space"] = "com_zeapps_contract" ;
$tabMenu["label"] = "Contrats" ;
$tabMenu["fa-icon"] = "file" ;
$tabMenu["url"] = "/ng/com_zeapps_contract/contracts/liste" ;
$tabMenu["access"] = "com_zeapps_contract_read" ;
$tabMenu["order"] = 0 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_contract_contrats_types";
$tabMenu["space"] = "com_zeapps_contract" ;
$tabMenu["label"] = "Contrats types" ;
$tabMenu["fa-icon"] = "file" ;
$tabMenu["url"] = "/ng/com_zeapps_contract/contracts/types/liste" ;
$tabMenu["access"] = "com_zeapps_contract_admin" ;
$tabMenu["order"] = 1 ;
$menuLeft[] = $tabMenu ;

/********** insert in top menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_contract_contrats" ;
$tabMenu["space"] = "com_zeapps_contract" ;
$tabMenu["label"] = "Contrats" ;
$tabMenu["url"] = "/ng/com_zeapps_contract/contracts/liste" ;
$tabMenu["access"] = "com_zeapps_contract_read" ;
$tabMenu["order"] = 0 ;
$menuHeader[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_contract_contrats_types" ;
$tabMenu["space"] = "com_zeapps_contract" ;
$tabMenu["label"] = "Contrats types" ;
$tabMenu["url"] = "/ng/com_zeapps_contract/contracts/types/liste" ;
$tabMenu["access"] = "com_zeapps_contract_admin" ;
$tabMenu["order"] = 1 ;
$menuHeader[] = $tabMenu ;

<?php

namespace App\fr_soca_production\Observer;

use Zeapps\Core\iObserver ;
use Zeapps\Models\CronModel;

class SocaObserver implements iObserver
{
    public static function action($transmitterClassName = '', $actionName = '', $arrayParam = array(), $callBack = null) {

        if ($transmitterClassName == 'com_zeapps_crm' && $actionName == 'save') {
            echo "ok contact observer<br>" ;
        }


    }


    public static function getHook() {
        $retour = array();

        return $retour ;
    }



    public static function getCron() {
        $retour = array();

        // déclaration du cron : executé tous les jours à 4h00
        $cron = new CronModel() ;
        $cron->minute = "0" ;
        $cron->hour = "4" ;
        $cron->command = "App\\fr_soca_production\\Controllers\\Crons@checkEffectifs" ;
        $retour[] = $cron ;

        return $retour ;
    }





}
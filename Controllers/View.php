<?php

namespace App\com_zeapps_contract\Controllers;

use Zeapps\Core\Controller;

class View extends Controller
{

    ///////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////// CONTRACT //////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////
    ///
    public function contracts()
    {
        $data = array();
        return view("contracts/liste", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

    public function contractView()
    {
        $data = array();
        return view("contracts/view", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

    // Types
    public function contractsTypes()
    {
        $data = array();
        return view("contracts/types/liste", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

    public function contractsFormModal()
    {
        $data = array();
        return view("contracts/types/modal_liste", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

    public function contractsConfig()
    {
        $data = array();
        return view("contracts/types/config", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

}
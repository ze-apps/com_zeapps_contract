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

    public function contractConfiguration()
    {
        $data = array();
        return view("contracts/configuration", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

    public function contractView()
    {
        $data = array();
        return view("contracts/view", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

}
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

    public function contractsSouscritsFormModal()
    {
        $data = array();
        return view("contracts/form_modal", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

    ///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////// TYPES ///////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////
    ///
    public function contractsTypes()
    {
        $data = array();
        return view("contracts/types/liste", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

    public function contractsTypesView()
    {
        $data = array();
        return view("contracts/types/view", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

    public function contractsTypesFormModal()
    {
        $data = array();
        return view("contracts/types/modal_liste", $data, BASEPATH . 'App/com_zeapps_contract/views/');
    }

}
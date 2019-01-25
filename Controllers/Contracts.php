<?php

namespace App\com_zeapps_contract\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;

class Contracts extends Controller
{

    public function getAll(Request $request)
    {

    }

    public function context()
    {

    }

    public function get(Request $request)
    {

    }

    public function save()
    {

    }

    public function delete(Request $request)
    {

    }

    public function modal(Request $request) {

        /*$limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $companies_rs = CompaniesModel::orderBy('company_name') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $companies_rs = $companies_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $companies_rs = $companies_rs->where($key, $value) ;
            }
        }

        $total = $companies_rs->count();


        $companies = $companies_rs->limit($limit)->offset($offset)->get();

        if(!$companies) {
            $companies = array();
        }*/



        // TODO : à supprimer à codage
        $total = 0 ;
        $contract_type = array();
        // TODO : à supprimer à codage



        echo json_encode(array("data" => $contract_type, "total" => $total));
    }

}
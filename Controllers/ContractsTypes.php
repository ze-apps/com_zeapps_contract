<?php

namespace App\com_zeapps_contract\Controllers;

use App\com_zeapps_contract\Models\ContractType;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;

class ContractsTypes extends Controller
{
    private $sheet_name;

    public function getAll(Request $request)
    {
        $filters = array();

        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);
        $context = $request->input('context', false);

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE)) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $contracts_types_rs = ContractType::orderBy('libelle') ;

        $actifs_options = ['oui', 'non'];

        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $contracts_types_rs = $contracts_types_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $contracts_types_rs = $contracts_types_rs->where($key, $value) ;
            }
        }

        $total = $contracts_types_rs->count();
        $contracts_types_rs_id = $contracts_types_rs ;

        $contracts_types = $contracts_types_rs->limit($limit)->offset($offset)->get();

        if(!$contracts_types) {
            $contracts_types = array();
        }

        $ids = [];
        if($total < 500) {
            $rows = $contracts_types_rs_id->select(array("id"))->get();
            foreach ($rows as $row) {
                array_push($ids, $row->id);
            }
        }

        echo json_encode(array(
            'contracts_types' => $contracts_types,
            'actifs_options' => $actifs_options,
            'total' => $total,
            'ids' => $ids
        ));
    }

    public function context()
    {

    }

    public function get(Request $request)
    {
        $id = $request->input('id', 0);

        $contract_type = new ContractType();

        $tarifs_contracts_types = array();
        if ($id > 0) {
            $contract_type = ContractType::find($id);
            $tarifs_contracts_types = $contract_type->getAllWithTarifs($id);
        }

        echo json_encode(array(
            'tarifs_contracts_types' => $tarifs_contracts_types,
            'contract_type' => $contract_type
        ));
    }

    public function save()
    {
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // Get posted data by json
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $contract_type = new ContractType();
        if ($data['id'] > 0) {
            $contract_type = ContractType::findOrFail($data['id']);
        }

        // Update or set data
        foreach ($data as $key => $value) {
            if ($key != 'id') {
                $contract_type->$key = $value;
            }
        }

        $contract_type->save();

        echo $contract_type;
    }

    public function delete(Request $request)
    {
        $id = $request->input('id', 0);

        $contract_type = ContractType::where('id', $id)->first();

        $deleted = $contract_type->delete();

        echo $deleted ? $id : 0;
    }

    // TODO : A FAIRE
    // TODO : A FAIRE
    // TODO : A FAIRE
    // TODO : A FAIRE
    // TODO : A FAIRE
    // TODO : A FAIRE
    public function modal(Request $request)
    {
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
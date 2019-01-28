<?php

namespace App\com_zeapps_contract\Controllers;

use App\com_zeapps_contract\Models\ContractType;

use App\com_zeapps_crm\Models\Taxes;
use Zeapps\Core\Controller;
use Zeapps\Core\Request;

class ContractsTypes extends Controller
{

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

        // Get array('id_contract_type' => 'nb_tarifs')
        $model = new ContractType();
        $contracts_types_with_tarifs = $model->getAllWithTarifs();

        // Set attribute to object for vue
        foreach ($contracts_types as $contract_typ) {
            foreach ($contracts_types_with_tarifs as $key => $value) {
                if ($contract_typ->id == $key) {
                    $contract_typ->nb_tarifs = $value > 1 ? $value . ' tarifs' : $value . ' tarif';
                    break;
                }
            }
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

        // Taux TVA
        $all_taux_tva = Taxes::all();

        echo json_encode(array(
            'tarifs_contracts_types' => $tarifs_contracts_types,
            'contract_type' => $contract_type,
            'all_taux_tva'  => $all_taux_tva
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

    public function modal(Request $request)
    {
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $contract_type_rs = ContractType::orderBy('libelle') ;

        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $contract_type_rs = $contract_type_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $contract_type_rs = $contract_type_rs->where($key, $value) ;
            }
        }

        $total = $contract_type_rs->count();


        $contract_type = $contract_type_rs->limit($limit)->offset($offset)->get();

        if(!$contract_type) {
            $contract_type = array();
        }

        echo json_encode(array("data" => $contract_type, "total" => $total));
    }

}
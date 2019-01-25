<?php

namespace App\com_zeapps_contract\Controllers;

use App\com_zeapps_contract\Models\ContractTypeTarif;
use Zeapps\Core\Controller;
use Zeapps\Core\Request;

class ContractsTypesTarifs extends Controller
{
    public function get(Request $request)
    {
        $id = $request->input('id', 0);

        $contract_type_tarif = new ContractTypeTarif();

        if ($id > 0) {
            $contract_type_tarif = ContractTypeTarif::find($id);
        }

        echo json_encode(array(
            'contract_type_tarif' => $contract_type_tarif
        ));
    }

    public function save()
    {
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // Get posted data by json
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $contract_type_tarif = new ContractTypeTarif();

        if ($data['id'] > 0) {
            $contract_type_tarif = ContractTypeTarif::findOrFail($data['id']);
        }

        // Update or set data
        foreach ($data as $key => $value) {
            if ($key != 'id') {
                $contract_type_tarif->$key = $value;
            }
        }

        $contract_type_tarif->save();

        echo $contract_type_tarif;
    }

    public function delete(Request $request)
    {
        $id = $request->input('id', 0);

        $contract_type_tarif = ContractTypeTarif::where('id', $id)->first();

        $deleted = $contract_type_tarif->delete();

        echo $deleted ? $id : 0;
    }

}
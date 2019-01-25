<?php

namespace App\com_zeapps_contract\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelExportType;
use Zeapps\Core\ModelHelper;
use Zeapps\Core\ObjectHistory;

class ContractType extends Model {

    use SoftDeletes;

    protected $fieldModelInfo ;

    static protected $_table = 'com_zeapps_contract_contracts_types';
    protected $table ;

    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->increments('id');

        $this->fieldModelInfo->string('libelle', 255);
        $this->fieldModelInfo->string('actif', 255);

        $this->fieldModelInfo->timestamps();
        $this->fieldModelInfo->softDeletes();

        parent::__construct($attributes);
    }

    public static function getSchema() {
        return $schema = Capsule::schema()->getColumnListing(self::$_table) ;
    }

    public function getFields() {
        return $this->fieldModelInfo->getFields();
    }

    public function save(array $options = []) {

        // for history
        $valueOriginal = $this->original ;

        /**** to delete unwanted field ****/
        $schema = self::getSchema();
        foreach ($this->getAttributes() as $key => $value) {
            if (!in_array($key, $schema)) {
                //echo $key . "\n" ;
                unset($this->$key);
            }
        }
        /**** end to delete unwanted field ****/

        $reponse = parent::save($options) ;

        // save to ObjectHistory
        ObjectHistory::addHistory(self::$_table, $this->id, $this->getFields(), $this, $valueOriginal);

        return $reponse;
    }

    public function delete() {

        // for history
        $valueOriginal = $this->original;

        $deleted = parent::delete();

        // save to ObjectHistory
        if ($deleted) {
            ObjectHistory::addHistory(self::$_table, $this->id, $this->getFields(), null, $valueOriginal);
            return true;
        }

        return false;
    }

    public function getModelExport() : ModelExportType {
        $objModelExport = new ModelExportType() ;
        $objModelExport->table = $this->table ;
        $objModelExport->tableLabel = "Type de contrats" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }

    /**
     * GET Tarifs of all (or one) Contract_type
     *
     * @param null $id
     * @return ContractTypeTarif[]|\Illuminate\Database\Eloquent\Collection|null
     */
    public function getAllWithTarifs($id = null)
    {
        $retour = null;

        if ($id) {
            $contract_type = ContractType::findOrFail($id);
            if ($contract_type) {
                $retour = ContractTypeTarif::where('id_contract_type', $contract_type->id)->get();
            }
        } else {
            $retour = ContractTypeTarif::groupBy('id_contract_type')->selectRaw('count(*) as nb_tarifs, id_contract_type')->pluck('nb_tarifs', 'id_contract_type')->toArray();
        }

        return $retour;
    }

}
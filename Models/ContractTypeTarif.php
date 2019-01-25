<?php

namespace App\com_zeapps_contract\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelExportType;
use Zeapps\Core\ModelHelper;
use Zeapps\Core\ObjectHistory;

class ContractTypeTarif extends Model {

    use SoftDeletes;

    protected $fieldModelInfo ;

    static protected $_table = 'com_zeapps_contract_contracts_types_tarifs';
    protected $table ;

    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->increments('id');

        // Contrat types
        $this->fieldModelInfo->integer('id_contract_type', false, true)->default(0);

        // Periode
        $this->fieldModelInfo->integer('duree_periode')->default(0);
        $this->fieldModelInfo->double('tarif_periode');
        $this->fieldModelInfo->integer('duree_minimale_contract')->default(0);

        // Frais
        $this->fieldModelInfo->double('frais_resiliation');
        $this->fieldModelInfo->double('frais_modification');
        $this->fieldModelInfo->double('frais_installation');

        // Compta - TVA
        $this->fieldModelInfo->integer('id_taux_tva', false, true)->default(0);
        $this->fieldModelInfo->string('id_taux_tva_value', false, true)->default('');
        $this->fieldModelInfo->string('compte_compta', false, true)->default('');

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

}
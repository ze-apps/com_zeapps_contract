<?php

namespace App\fr_soca_production\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelExportType;
use Zeapps\Core\ModelHelper;
use Zeapps\Core\ObjectHistory;

class Absence extends Model {

    use SoftDeletes;

    protected $fieldModelInfo ;

    static protected $_table = 'fr_soca_production_absences_salaries';
    protected $table ;

    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        // Civilite
        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->increments('id');

        $this->fieldModelInfo->string('libelle', 255);

        $this->fieldModelInfo->date('date_debut');
        $this->fieldModelInfo->date('date_fin')->nullable();

        // Salarié
        $this->fieldModelInfo->integer('id_salarie', false, true)->default(0);
        $this->fieldModelInfo->string('nom_prenom_salarie', 255)->default("");

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
        $objModelExport->tableLabel = "Absences" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }



    public static function getAbsencesDuneAnnee($annee)
    {
        $absences = Absence::whereRaw("date_debut >= '$annee-01-01' and date_fin <= '$annee-12-31'")
            ->orWhereRaw("date_debut >= '$annee-01-01' and date_debut <= '$annee-12-31' and date_fin is null")
            ->get();
        return $absences;
    }

}
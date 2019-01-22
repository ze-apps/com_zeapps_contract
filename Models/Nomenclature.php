<?php

namespace App\fr_soca_production\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;
use Zeapps\Core\ModelHelper;

class Nomenclature extends Model {

    use SoftDeletes;

    static protected $_table = 'fr_soca_production_nomenclatures';
    protected $table ;

    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        // stock la liste des champs
        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->increments('id');

        $this->fieldModelInfo->string('xxxxxxx', 150)->default("");
        $this->fieldModelInfo->float('xxxxxxx')->default(0);
        $this->fieldModelInfo->date('xxxxxxx')->nullable();

        // Companies
        $this->fieldModelInfo->integer('id_xxxxxxx', false, true)->default(0);
        $this->fieldModelInfo->string('xxxxxxx', 255)->default("");

        // Contacts
        $this->fieldModelInfo->integer('id_xxxxxxx', false, true)->default(0);
        $this->fieldModelInfo->string('xxxxxxx', 255)->default("");

        // User account manager
        $this->fieldModelInfo->integer('id_xxxxxxx', false, true)->default(0);
        $this->fieldModelInfo->string('xxxxxxx', 255)->default("");

        // Activities
        $this->fieldModelInfo->integer('id_xxxxxxx', false, true)->default(0);
        $this->fieldModelInfo->string('xxxxxxx', 255)->default("");

        // Status
        $this->fieldModelInfo->integer('id_xxxxxxx', false, true)->default(0);
        $this->fieldModelInfo->string('xxxxxxx', 255)->default("");
        $this->fieldModelInfo->string('xxxxxxx', 255)->default("");

        $this->fieldModelInfo->timestamps();
        $this->fieldModelInfo->softDeletes();

        parent::__construct($attributes);
    }

    public static function getSchema()
    {
        return $schema = Capsule::schema()->getColumnListing(self::$_table) ;
    }

    public function save(array $options = [])
    {
        /**** to delete unwanted field ****/
        $schema = self::getSchema();
        foreach ($this->getAttributes() as $key => $value) {
            if (!in_array($key, $schema)) {
                //echo $key . "\n" ;
                unset($this->$key);
            }
        }
        /**** end to delete unwanted field ****/

        return parent::save($options);
    }

}
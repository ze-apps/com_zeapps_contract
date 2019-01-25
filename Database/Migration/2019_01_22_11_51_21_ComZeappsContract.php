<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class ComZeappsContract
{
    public function up()
    {
        ///////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////// CONTRATS_TYPES ///////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////
        ///
        Capsule::schema()->create('com_zeapps_contract_contracts_types', function (Blueprint $table) {

            $table->increments('id');

            $table->string('libelle', 255)->default("");
            $table->string('actif')->default('oui');

            $table->timestamps();
            $table->softDeletes();
        });

        ///////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////// CONTRATS_TYPES_TARIFS ////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////
        ///
        Capsule::schema()->create('com_zeapps_contract_contracts_types_tarifs', function (Blueprint $table) {

            $table->increments('id');

            // Contracts types
            $table->integer('id_contract_type', false, true)->default(0);

            // Periode
            $table->integer('duree_periode')->default(0);
            $table->double('tarif_periode');
            $table->integer('duree_minimale_contract')->default(0);

            // Frais
            $table->double('frais_resiliation');
            $table->double('frais_modification');
            $table->double('frais_installation');

            // Compta - TVA
            $table->integer('id_taux_tva', false, true)->default(0);
            $table->string('id_taux_tva_value', false, true)->default('');
            $table->string('compte_compta', false, true)->default('');

            $table->timestamps();
            $table->softDeletes();
        });

        /////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////// CONTRATS_SOUSCRITS //////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        ///
        Capsule::schema()->create('com_zeapps_contract_contracts_souscrits', function (Blueprint $table) {

            $table->increments('id');

            // Enrtreprise et/ou Contact
            $table->integer('id_entreprise', false, true)->default(0);
            $table->integer('id_contract', false, true)->default(0);
            $table->string('id_entreprise_label')->default('');
            $table->string('id_contract_label')->default('');

            $table->string('libelle');
            $table->string('numero_piece');

            // Dates & délais
            $table->date('date_ouverture');
            $table->date('date_premiere_facturation');
            $table->date('date_facturation_suivante');
            $table->integer('delai_renouvellement');

            // Statut
            $table->string('statut');
            $table->longText('commentaire');

            // Contrats types
            $table->integer('id_contrat_type', false, true)->default(0);
            $table->integer('id_contrat_type_tarif', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('com_zeapps_contract_contracts_types');
        Capsule::schema()->dropIfExists('com_zeapps_contract_contracts_types_tarifs');
        Capsule::schema()->dropIfExists('com_zeapps_contract_contracts_souscrits');
    }
}

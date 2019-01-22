<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class ComZeappsContract
{
    public function up()
    {
        ///////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ATELIERS //////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////
        ///
        /*Capsule::schema()->create('fr_soca_production_ateliers', function (Blueprint $table) {

            $table->increments('id');

            $table->string('label', 255)->default("");
            $table->integer('ordre', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });*/

        ///////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// SALARIES //////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////
        ///
        /*Capsule::schema()->create('fr_soca_production_salaries', function (Blueprint $table) {

            $table->increments('id');

            // Civilite
            $table->string('nom', 255)->default("");
            $table->string('prenom', 255)->default("");

            // Infos
            $table->date('fin_contrat')->nullable();
            $table->tinyInteger('actif')->default(1);

            // Atelier
            $table->integer('id_atelier', false, true)->default(0);
            $table->string('nom_atelier', 255)->default("");

            // Jours
            $table->double('lundi');
            $table->double('mardi');
            $table->double('mercredi');
            $table->double('jeudi');
            $table->double('vendredi');
            $table->double('samedi');
            $table->double('dimanche');

            $table->timestamps();
            $table->softDeletes();
        });*/

        ///////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// EFFECTIFS /////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////
        ///
        /*Capsule::schema()->create('fr_soca_production_effectifs', function (Blueprint $table) {

            $table->increments('id');

            // Civilite
            $table->integer('id_salarie', false, true)->default(0);
            $table->string('nom', 255)->default("");
            $table->string('prenom', 255)->default("");

            // Atelier
            $table->integer('id_atelier', false, true)->default(0);
            $table->string('nom_atelier', 255)->default("");

            // Jours
            $table->double('lundi');
            $table->double('mardi');
            $table->double('mercredi');
            $table->double('jeudi');
            $table->double('vendredi');
            $table->double('samedi');
            $table->double('dimanche');

            $table->integer('numero_semaine', false, true)->default(0);
            $table->integer('annee', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });*/

        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////// FERMETURES EXCEPTIONNELLES ///////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        ///
        /*Capsule::schema()->create('fr_soca_production_fermetures_exceptionnelles', function (Blueprint $table) {

            $table->increments('id');

            $table->string('libelle', 255);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });*/

        /////////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////// ABSENCES SALARIES //////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////////////
        ///
        /*Capsule::schema()->create('fr_soca_production_absences_salaries', function (Blueprint $table) {

            $table->increments('id');

            $table->string('libelle', 255);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();

            // Nom et prénom du salarié
            $table->integer('id_salarie', false, true)->default(0);
            $table->string('nom_prenom_salarie', 255)->default("");

            $table->timestamps();
            $table->softDeletes();
        });*/
    }

    public function down()
    {
        /*Capsule::schema()->dropIfExists('fr_soca_production_ateliers');
        Capsule::schema()->dropIfExists('fr_soca_production_salaries');
        Capsule::schema()->dropIfExists('fr_soca_production_effectifs');
        Capsule::schema()->dropIfExists('fr_soca_production_fermetures_exceptionnelles');
        Capsule::schema()->dropIfExists('fr_soca_production_absences_salaries');*/
    }
}

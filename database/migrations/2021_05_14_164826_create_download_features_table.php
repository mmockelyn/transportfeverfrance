<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_features', function (Blueprint $table) {
            $table->id();
            $table->integer('type_feature')->nullable()->comment("0: Vehicule |1: Autre Objet");
            $table->string('type_vehicule')->nullable();
            $table->string('conduite_vehicule')->nullable();
            $table->string('vitesse')->nullable();
            $table->string('performance')->nullable();
            $table->string('traction')->nullable();
            $table->string('dispo_start')->nullable();
            $table->string('dispo_end')->nullable();
            $table->string('ecartement')->nullable();
            $table->string('capacity')->nullable();
            $table->string('pays')->nullable();

            $table->foreignId('download_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_features');
    }
}

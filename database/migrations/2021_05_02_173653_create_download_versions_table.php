<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_versions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('version');
            $table->string('link_packages');
            $table->string('content');
            $table->enum('type', ['alpha', 'beta', 'release', 'hotfix'])->default('release');
            $table->integer('state')->default(0)->comment("0: Non Publier |1: En cours de publication |2: Publier");
            $table->foreignId('download_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('user_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_versions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_supports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('email_user')->nullable();
            $table->string('name_user')->nullable();
            $table->string('subject');
            $table->longText('message');
            $table->integer('state')->default(0)->comment("0: Ouvert |1: En attente de l'auteur |2: En attente de l'utilisateur |3: Terminer");
            $table->integer('_rgt')->nullable();
            $table->integer('_lft')->nullable();
            $table->integer('parent_id')->nullable();
            $table->foreignId('download_id')
                ->constrained()
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
        Schema::dropIfExists('download_supports');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadSupportRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_support_rooms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('message');
            $table->integer('author_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreignId('download_support_id')
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
        Schema::dropIfExists('download_support_rooms');
    }
}

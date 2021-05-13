<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('provider')->default(0)->comment("0: null |1: steam |2: tfnet |3: tf_france");
            $table->boolean('active')->default(false);
            $table->string('steam_link_package')->nullable();
            $table->string('tfnet_link_package')->nullable();
            $table->string('tf_france_link_package')->nullable();
            $table->string('image')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('short_content');
            $table->text('content');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('version_latest')->default('1.0');
            $table->integer('count_view')->default(0);
            $table->integer('count_download')->default(0);
            $table->timestamps();

            $table->foreignId('download_category_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('download_sub_category_id')->constrained()
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
        Schema::dropIfExists('downloads');
    }
}

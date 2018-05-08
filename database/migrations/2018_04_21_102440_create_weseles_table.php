<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeselesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weseles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->string('termin', 55);
            $table->integer('na_ile_osob_tort')->unsigned()->nullable();
            $table->string('rodzaj_tortu',55)->nullable();
            $table->string('smak', 55)->nullable();
            $table->string('filename', 191)->nullable();
            $table->integer('sernik')->nullable();
            $table->integer('smietana_galaertka')->nullable();
            $table->integer('jablecznik')->nullable();
            $table->integer('makowiec')->nullable();
            $table->integer('owocowe')->nullable();
            $table->integer('rafaello')->nullable();
            $table->integer('w_z')->nullable();
            $table->integer('miodownik')->nullable();
            $table->integer('czekoladowe')->nullable();
            $table->integer('ile_paczek')->unsigned();
            $table->string('wielkosc_paczki', 55)->nullable();
            $table->string('rodzaj_paczki', 55)->nullable();
            $table->text('info')->nullable();
            $table->string('status',91);
            $table->timestamps();
        });

        Schema::table('weseles', function (Blueprint $table) {
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
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
        Schema::table('weseles', function (Blueprint $table) {
            $table->dropForeign('weseles_users_id_foreign');
        });

        Schema::dropIfExists('weseles');
    }
}

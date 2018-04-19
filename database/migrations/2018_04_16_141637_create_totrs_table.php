<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nazwa');
            $table->text('opis');
            $table->string('filename', 191);
            $table->timestamps();
        });

        Schema::create('torts', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('id_kategorii')->unsigned();
            $table->integer('na_ile_osob')->unsigned();
            $table->string('rodzaj_dekoracji', 91);
            $table->date('termin');
            $table->string('status', 91);
            $table->text('info')->nullable();
            $table->string('filename', 191)->nullable();
            $table->timestamps();
        });

        Schema::table('torts', function (Blueprint $table) {
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('id_kategorii')
                ->references('id')
                ->on('kategories')
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
        Schema::table('torts', function (Blueprint $table) {
            $table->dropForeign('torts_users_id_foreign');
            $table->dropForeign('torts_id_kategorii_foreign');
        });

        Schema::dropIfExists('kategories');
        Schema::dropIfExists('torts');
    }
}

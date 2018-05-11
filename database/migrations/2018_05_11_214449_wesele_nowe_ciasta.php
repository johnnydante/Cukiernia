<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WeseleNoweCiasta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weseles', function(Blueprint $table) {
            $table->integer('seromak')
                ->nullable()
                ->after('czekoladowe');
            $table->integer('pani_walewska')
                ->nullable()
                ->after('seromak');
            $table->integer('ambasador')
                ->nullable()
                ->after('pani_walewska');
            $table->integer('brzoskwiniowiec')
                ->nullable()
                ->after('ambasador');
            $table->integer('pianka_z_malinami')
                ->nullable()
                ->after('brzoskwiniowiec');
            $table->integer('królewiec')
                ->nullable()
                ->after('pianka_z_malinami');
            $table->integer('szpinakowe')
                ->nullable()
                ->after('królewiec');
            $table->integer('powidła_krem')
                ->nullable()
                ->after('szpinakowe');
            $table->integer('rureczki')
                ->nullable()
                ->after('powidła_krem');
            $table->integer('babeczki')
                ->nullable()
                ->after('rureczki');
            $table->integer('ciasteczka_mieszane')
                ->nullable()
                ->after('babeczki');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weseles', function (Blueprint $table){
            $table->dropColumn('seromak');
            $table->dropColumn('pani_walewska');
            $table->dropColumn('ambasador');
            $table->dropColumn('brzoskwiniowiec');
            $table->dropColumn('pianka_z_malinami');
            $table->dropColumn('królewiec');
            $table->dropColumn('szpinakowe');
            $table->dropColumn('powidła_krem');
            $table->dropColumn('rureczki');
            $table->dropColumn('babeczki');
            $table->dropColumn('ciasteczka_mieszane');
        });
    }
}

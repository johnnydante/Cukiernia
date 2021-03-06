<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TortRodzajMasy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('torts', function(Blueprint $table) {
            $table->string('rodzaj_masy', 155)
                ->nullable()
                ->after('smak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('torts', function (Blueprint $table){
            $table->dropColumn('rodzaj_masy');
        });
    }
}

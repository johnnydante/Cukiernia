<?php

use Illuminate\Database\Seeder;
use App\Kategorie;

class KategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Kategorie();
        $product->nazwa = 'Ślub';
        $product->opis = 'Torty na wesela';
        $product->filename = 'wesele.jpg';
        $product->save();

        $product = new Kategorie();
        $product->nazwa = 'Chrzest';
        $product->opis = 'Torty na chrzściny';
        $product->filename = 'chrzest.jpg';
        $product->save();

        $product = new Kategorie();
        $product->nazwa = 'Urodziny';
        $product->opis = 'Torty urodzinowe';
        $product->filename = 'urodziny.jpg';
        $product->save();

        $product = new Kategorie();
        $product->nazwa = 'Komunia';
        $product->opis = 'Torty komunijne';
        $product->filename = 'komunia.jpg';
        $product->save();
    }
}

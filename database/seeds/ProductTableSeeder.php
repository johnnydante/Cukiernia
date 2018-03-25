<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->nazwa = 'Sernik z truskawkami';
        $product->cena = 50;
        $product->save();

        $product = new Product();
        $product->nazwa = 'Tort Galicyjski';
        $product->cena = 65;
        $product->save();

        $product = new Product();
        $product->nazwa = 'Torcik bezowy z malinami';
        $product->cena = 55;
        $product->save();

        $product = new Product();
        $product->nazwa = 'Szarlotka';
        $product->cena = 40;
        $product->save();

        $product = new Product();
        $product->nazwa = 'Czekoladowe z gruszkami';
        $product->cena = 45;
        $product->save();

        $product = new Product();
        $product->nazwa = 'Owocowe z galaretką';
        $product->cena = 35;
        $product->save();
    }
}

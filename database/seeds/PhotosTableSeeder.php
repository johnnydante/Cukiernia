<?php

use Illuminate\Database\Seeder;
use App\Photos;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<141; $i++){
            $photo = new Photos();
            $photo->filename = 'tort ('.$i.').jpg';
            $photo->save();
        }
    }
}

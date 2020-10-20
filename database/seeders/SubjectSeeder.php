<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'name' => 'Français',
                'slug' => 'francais',
                'url' => '/image/francais.jpg'
            ],
            [
                'name' => 'Mathématiques',
                'slug' => 'mathematiques',
                'url' => '/image/mathematiques.jpg'
            ],
            [
                'name' => 'Histoire',
                'slug' => 'histoire',
                'url' => '/image/histoire.jpg'
            ],
            [
                'name' => 'Géopgraphie',
                'slug' => 'geographie',
                'url' => '/image/geographie.jpg'
            ],
            [
                'name' => 'Anglais',
                'slug' => 'anglais',
                'url' => '/image/anglais.jpg'
            ],
            [
                'name' => 'Espagnol',
                'slug' => 'espagnol',
                'url' => '/image/espagnol.png'
            ],
        ]);
    }
}

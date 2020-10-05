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
                'slug' => 'francais'
            ],
            [
                'name' => 'Mathématiques',
                'slug' => 'mathematiques'
            ],
            [
                'name' => 'Histoire',
                'slug' => 'histoire'
            ],
            [
                'name' => 'Géopgraphie',
                'slug' => 'geographie'
            ],
            [
                'name' => 'Anglais',
                'slug' => 'anglais'
            ],
            [
                'name' => 'Espagnol',
                'slug' => 'espagnol'
            ],
        ]);
    }
}

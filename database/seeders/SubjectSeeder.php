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
            ['name' => 'Français'],
            ['name' => 'Mathématiques'],
            ['name' => 'Histoire'],
            ['name' => 'Géopgraphie'],
            ['name' => 'Anglais'],
            ['name' => 'Espagnol'],
        ]);
    }
}

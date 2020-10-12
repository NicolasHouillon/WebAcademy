<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            ["name" => "CP", "school_level" => "Primaire"],
            ["name" => "CE1", "school_level" => "Primaire"],
            ["name" => "CE2", "school_level" => "Primaire"],
            ["name" => "CM1", "school_level" => "Primaire"],
            ["name" => "CM2", "school_level" => "Primaire"],
            ["name" => "6ème", "school_level" => "Collège"],
            ["name" => "5ème", "school_level" => "Collège"],
            ["name" => "4ème", "school_level" => "Collège"],
            ["name" => "3ème", "school_level" => "Collège"],
            ["name" => "Seconde", "school_level" => "Lycée"],
            ["name" => "Première", "school_level" => "Lycée"],
            ["name" => "Terminale", "school_level" => "Lycée"],
        ]);
    }
}

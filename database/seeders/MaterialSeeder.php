<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $primaire = Level::where('name', 'CP')->pluck('id')->first();
        $college = Level::where('name', '6ème')->pluck('id')->first();
        $lycee = Level::where('name', 'Seconde')->pluck('id')->first();

        DB::table('materials')->insert([
            ["name" => "Français", "level_id" => $primaire],
            ["name" => "Mathématiques", "level_id" => $primaire],
            ["name" => "Art", "level_id" => $primaire],

            ["name" => "Langue vivante", "level_id" => $college],
            ["name" => "SVT", "level_id" => $college],
            ["name" => "Histoire - Géographie", "level_id" => $college],

            ["name" => "Phylosophie", "level_id" => $lycee],
            ["name" => "Physique - Chimie", "level_id" => $lycee],
            ["name" => "Sciences nunémriques", "level_id" => $lycee],
        ]);
    }
}

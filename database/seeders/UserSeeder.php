<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run(){
        for ($i = 0; $i < 20; $i++) {
            User::factory()->create();
        }

        //Professeur
        DB::table('users')->insert([
            ["lastname" => "Robert",
                "firstname" => "Duchmol",
                "email" => "robert.duchmol@mail.fr",
                "password" => Hash::make('secret'),
                "group_id" => 2]
        ]);

        //Etudiant
        DB::table('users')->insert([
            ["lastname" => "Karl",
                "firstname" => "Remy",
                "email" => "karl.remy@mail.fr",
                "password" => Hash::make('secret'),
                "group_id" => 4]
        ]);

        //Administrateur
        DB::table('users')->insert([
            ["lastname" => "Nicolas",
                "firstname" => "Houillon",
                "email" => "nicolas.houillon@mail.fr",
                "password" => Hash::make('secret'),
                "group_id" => 1]
        ]);
    }

}

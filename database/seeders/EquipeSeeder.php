<?php

namespace Database\Seeders;

use App\Models\Equipes;
use App\Models\User;
use Illuminate\Database\Seeder;

class EquipeSeeder extends Seeder
{
    public function run(): void
    {

        $damien = User::where('email','dbenedetti@fgroup-audiovisual.com')->first();
        $kelian = User::where('email','kbardon@fgroup-audiovisual.com')->first();

        $direction = Equipes::create([
            'name' => 'Direction',
            'user_id' => $kelian->id,
            'email' => 'ALL_DIRECTION@fgroup-audiovisual.com',
            'phone' => '0606060606',
            'description' => 'Equipe de direction'
        ]);

        $technique = Equipes::create([
            'name' => 'Technique',
            'user_id' => $damien->id,
            'email' => 'ALL_TECHNIQUE@fgroup-audiovisual.com',
            'phone' => '0606060606',
            'description' => 'Equipe technique'
        ]);

        $direction->users()->attach($kelian->id);

        $technique->users()->attach([
            $kelian->id,
            $damien->id
        ]);

    }
}

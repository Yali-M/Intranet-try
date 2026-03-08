<?php

namespace Database\Seeders;

use App\Models\Emissions;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmissionSeeder extends Seeder
{
    public function run(): void
    {

        $kelian = User::where('email','kbardon@fgroup-audiovisual.com')->first();

        Emissions::create([
            'name' => 'Emission test',
            'description' => 'Emission de test',
            'status' => 'En cours',
            'user_id' => $kelian->id,
            'date_debut' => '2021-09-09',
            'date_fin' => '2030-09-09',
            'heure_debut' => '09:00',
            'heure_fin' => '10:00',
            'recurence' => 'weekly',
            'type' => 'différé'
        ]);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Valoris;

class ValorisSeeder extends Seeder
{
    public function run(): void
    {

        Valoris::create([
            'title' => 'Participation émission',
            'description' => 'Participation bénévole à une émission',
            'points' => 10
        ]);

        Valoris::create([
            'title' => 'Aide technique',
            'description' => 'Aide à la mise en place du matériel',
            'points' => 8
        ]);

        Valoris::create([
            'title' => 'Organisation événement',
            'description' => 'Participation à l’organisation d’un événement',
            'points' => 15
        ]);

        Valoris::create([
            'title' => 'Formation interne',
            'description' => 'Participation à une formation',
            'points' => 5
        ]);

        Valoris::create([
            'title' => 'Support administratif',
            'description' => 'Aide administrative ou logistique',
            'points' => 6
        ]);

    }
}

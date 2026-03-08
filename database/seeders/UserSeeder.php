<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Equipes;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Création des utilisateurs
        $admin = User::create([
            'name' => 'Damien',
            'lastname' => 'Benedetti',
            'email' => 'dbenedetti@fgroup-audiovisual.com',
            'email_perso' => 'parwan@outlook.fr',
            'telephone' => '0606060606',
            'fonction' => 'Directeur Adjoint des Opérations techniques',
            'valoris' => 80,
            'date_naissance' => '2003-09-09',
            'terms' => true,
            'password' => Hash::make('123'),
        ]);

        $manager = User::create([
            'name' => 'Kélian',
            'lastname' => 'Bardon',
            'email' => 'kbardon@fgroup-audiovisual.com',
            'email_perso' => 'kelian.bardon@gmail.com',
            'telephone' => '0606060606',
            'fonction' => 'Directeur des Opérations',
            'valoris' => 0,
            'date_naissance' => '2000-05-05',
            'terms' => true,
            'password' => Hash::make('123'),
        ]);

        // Création des rôles
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleRH = Role::firstOrCreate(['name' => 'RH']);
        $roleRE = Role::firstOrCreate(['name' => 'Responsable Equipe']);

        // Attribution des rôles
        $admin->assignRole($roleAdmin, $roleRH, $roleRE);
        $manager->assignRole($roleAdmin);

        // Création d’équipes
        $eDirection = Equipes::firstOrCreate([
            'name' => 'Direction',
            'user_id' => $manager->id,
            'email' => 'ALL_DIRECTION@fgroup-audiovisual.com',
            'phone' => '0606060606',
            'description' => 'Equipe de direction',
        ]);

        $eTechnique = Equipes::firstOrCreate([
            'name' => 'Technique',
            'user_id' => $admin->id,
            'email' => 'ALL_TECHNIQUE@fgroup-audiovisual.com',
            'phone' => '0606060606',
            'description' => 'Equipe technique',
        ]);

        // Affectation des utilisateurs aux équipes
        $eDirection->users()->syncWithoutDetaching([$manager->id]);
        $eTechnique->users()->syncWithoutDetaching([$manager->id, $admin->id]);

        $this->command->info('Users, rôles et équipes créés avec succès !');
    }
}

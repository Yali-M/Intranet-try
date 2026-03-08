<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {

        $permissions = [

            'Absences.gestion',
            'Absences.validate',
            'users.get',
            'Valoris.addpoints',
            'Equipe.edit',
            'Equipe.delete',
            'Emissions.all',
            'Emissions.ForceEdit',
            'Emissions.ForceDelete',
            'Emissions.validate',
            'Episode.remove',
            'valoris-declaration-mensuel',
            'valoris-declaration-mensuel-force',
            'valoris-declaration-mensuel-list'

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission
            ]);

        }

    }
}

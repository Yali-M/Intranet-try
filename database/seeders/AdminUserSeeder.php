  <?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {

        $damien = User::create([
            'name' => 'Damien',
            'lastname' => 'Benedetti',
            'telephone' => '0606060606',
            'fonction' => 'Directeur Adjoint des Opérations techniques',
            'valoris' => 80,
            'date_naissance' => '2003-09-09',
            'email_perso' => 'parwan@outlook.fr',
            'email' => 'dbenedetti@fgroup-audiovisual.com',
            'terms' => true,
            'password' => bcrypt('123'),
            'discord_id' => '469116212786495489',
            'discord_channel' => '1366526001814966363',
            'pushover_id' => 'ucna3b3sn1dan2435ariwctrvcv6yw'
        ]);

        $kelian = User::create([
            'name' => 'Kélian',
            'lastname' => 'Bardon',
            'telephone' => '0606060606',
            'fonction' => 'Directeur des Opérations',
            'valoris' => 0,
            'date_naissance' => '2000-05-05',
            'email_perso' => 'kelian.bardon@gmail.com',
            'email' => 'kbardon@fgroup-audiovisual.com',
            'password' => bcrypt('123')
        ]);

        $damien->assignRole(['Admin','RH','Responsable Equipe']);
        $kelian->assignRole('Admin');

    }
}

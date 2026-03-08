<?php

namespace Database\Seeders;

use App\Models\NotificationSubscriber;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {

        $damien = User::where('email','dbenedetti@fgroup-audiovisual.com')->first();

        NotificationSubscriber::create([
            'user_id' => $damien->id,
            'notification_name' => 'absence.validate'
        ]);

    }
}

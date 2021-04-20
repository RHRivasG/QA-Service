<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'JhonnyBravo98',
            'password' => bcrypt('12345678')
        ])->assignRole('moderator');
        User::create([
            'username' => 'BloodyMary06',
            'password' => bcrypt('12345678')
        ])->assignRole('moderator');
        User::create([
            'username' => 'DaveBarbaro0613',
            'password' => bcrypt('12345678')
        ])->assignRole('participant');
    }
}

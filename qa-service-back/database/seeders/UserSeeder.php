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
            'email' => 'jhonny_bravo98@test.com',
            'password' => bcrypt('12345678')
        ])->assignRole('moderator');
        User::create([
            'username' => 'BloodyMary06',
            'email' => 'bloody_mary06@test.com',
            'password' => bcrypt('12345678')
        ])->assignRole('participant');
        User::create([
            'username' => 'DaveBarbaro0613',
            'email' => 'dave_barbaro613@test.com',
            'password' => bcrypt('12345678')
        ])->assignRole('participant');
    }
}

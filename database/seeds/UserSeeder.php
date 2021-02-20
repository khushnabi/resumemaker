<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Adil',
            'email' => 'adil.sudo@gmail.com',
            'password' => bcrypt('Apple')
        ]);
        // User::factory()->create();
    }
}

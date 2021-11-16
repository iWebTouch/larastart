<?php

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
        DB::table('users')->delete();

        // create admin user
        factory(App\User::class)->create([
            'name' => 'Administrator',
            'email' => 'admin@site.com',
            'is_admin' => 1
        ]);

    }
}

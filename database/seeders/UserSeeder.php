<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@site.com',
            'is_admin' => 1
        ]);

    }
}

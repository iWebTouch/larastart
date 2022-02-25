<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        // create admin user
        Setting::create([
            'name' => 'MyWebApp',
            'email' => 'admin@site.com',
            'logo' => 'site_logo.png',
        ]);

    }
}

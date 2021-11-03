<?php

use Illuminate\Database\Seeder;

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
        factory(App\Setting::class)->create([
            'name' => 'MyWebApp',
            'email' => 'admin@site.com'
        ]);

    }
}

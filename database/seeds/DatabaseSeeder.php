<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'last_name' => env('ADMIN_LAST_NAME', 'root'),
          'first_name' => env('ADMIN_FIRST_NAME', 'root'),
          'email' => env('ADMIN_EMAIL', 'youremail@domain.com'),
          'password' => bcrypt(env('ADMIN_PASSWORD', 'toor')),
          'level' => 0,
      ]);
      DB::unprepared(file_get_contents(app_path()."/database/seeds/suivisio_seeds.sql"));
    }
}

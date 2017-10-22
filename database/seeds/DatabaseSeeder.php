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
          'last_name' => 'root',
          'first_name' => 'root',
          'email' => 'youremail@domain.com',
          'password' => bcrypt('toor'),
          'level' => 0,
      ]);
      DB::unprepared(file_get_contents(app_path()."/database/seeds/suivisio_seeds.sql"));
    }
}

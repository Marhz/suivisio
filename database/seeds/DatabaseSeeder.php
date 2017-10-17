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
          'email' => 'your email',
          'password' => bcrypt('toor'),
          'level' => 0,
      ]);
      DB::table('courses')->insert([
          'id' => 1,
          'name' => 'SLAM',
          'label' => 'Solutions logicielles et applications métier',
      ]);
      DB::table('courses')->insert([
          'id' => 2,
          'name' => 'SISR',
          'label' => "Systèmes d'infrastructures et Solutions Réseaux",
      ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('polls')->insert(['name' => 'Sans opinon', 'course_id' => 1]);
      DB::table('polls')->insert(['name' => 'SLAM', 'course_id' => 1]);
      DB::table('polls')->insert(['name' => 'SISR', 'course_id' => 1]);
  }
}

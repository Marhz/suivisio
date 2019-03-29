<?php

use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('documents')->insert(['name' => 'Fiche situation professionnelle 1']);
      DB::table('documents')->insert(['name' => 'Fiche situation professionnelle 2']);
      DB::table('documents')->insert(['name' => 'Attestation de stage année 1']);
      DB::table('documents')->insert(['name' => 'Attestation de stage année 2']);
      DB::table('documents')->insert(['name' => 'Attestation de travail (alternants)']);
      DB::table('documents')->insert(['name' => 'Page de garde E4']);
      DB::table('documents')->insert(['name' => 'Page de garde E6']);
    }
}

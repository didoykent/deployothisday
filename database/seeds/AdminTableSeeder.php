<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new \App\User([

      'username' => 'zodiac',
      'password' => bcrypt('zodiac12'),
      'position' => 'admin',
      'thisUserRole' => 'positionrivadmin'


      ]);

      $user->save();
    }
}

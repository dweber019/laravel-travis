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
        (new \App\User([
          'name' => 'David Weber',
          'email' => 'david.weber.schenker@gmail.com',
          'password' => bcrypt('12345'),
        ]))->save();
    }
}

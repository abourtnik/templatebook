<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run() {

        DB::table('users')->insert(

            ['name' => 'anton', 'email' => 'anton.bourtnik@hotmail.fr', 'password' => bcrypt('aaaaaaaa') , 'created_at' => date("Y-m-d H:i:s")]
        );
    }
}
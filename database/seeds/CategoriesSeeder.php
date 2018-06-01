<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder {

    public function run() {
        DB::table('categories')->insert(

            ['name' => 'wordpress', 'description' => 'Une petite description', 'image' => 'wordpress.png'],
            ['name' => 'prestashop', 'description' => 'Une petite description',  'image' => 'prestashop.png'],
            ['name' => 'html-css', 'description' => 'Une petite description', 'image' => 'html_css.jpeg']
        );
    }
}
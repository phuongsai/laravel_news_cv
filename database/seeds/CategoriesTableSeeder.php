<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'other',
            'slug' => 'other',
        ]);
        DB::table('categories')->insert([
            'name' => 'News',
            'slug' => 'news',
        ]);
        DB::table('categories')->insert([
            'name' => 'Tutorials',
            'slug' => 'tutorials',
        ]);
        DB::table('categories')->insert([
            'name' => 'Books',
            'slug' => 'books',
        ]);
    }
}

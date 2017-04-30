<?php

use Illuminate\Database\Seeder;

class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'homepage_meta_title' => 'test',
            'homepage_meta_descrption' => 'test',
            'homepage_keywords' => 'test',
        ]);
    }
}

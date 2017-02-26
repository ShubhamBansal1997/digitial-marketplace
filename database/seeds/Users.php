<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_fname' => 'Shubham',
            'user_lname' => 'Bansal',
            //'user_password' => bcrypt('admin'),
            'user_email' => 'shubham.bansal1988@gmail.com',
            'user_slug' => 'Shubham-Bansal',
            'user_pwd' => bcrypt('admin'),
            'user_status' => true,
            'user_accesslevel' => 1,
            'user_delete' => false,
        ]);

        DB::table('users')->insert([
        	'user_fname' => 'Shikhar',
        	'user_lname' => 'Aggarwal',
        	'user_email' => 'shikharaggarwal@gmail.com',
        	'user_slug' => 'Shikhar-Aggarwal',
        	'user_pwd' => bcrypt('admin'),
        	'user_status' => true,
        	'user_accesslevel' => 2,
        	'user_delete' => false,
        	]);
        DB::table('users')->insert([
        	'user_fname' => 'Rohn',
        	'user_lname' => 'methta',
        	'user_email' => 'rohitmetha@gmail.com',
        	'user_slug' => 'Rohn-methta',
        	'user_pwd' => bcrypt('admin'),
        	'user_status' => true,
        	'user_accesslevel' => 3,
        	'user_delete' => false,
    	]);
    }
}

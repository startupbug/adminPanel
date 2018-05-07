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
    	//Insert in Roles 
	        DB::table('roles')->insert([
	            'name' => 'admin',
	            'display_name' => 'Admin',
	            'description' => 'Admin user role',
	        ]);

        //Insert in User
	        DB::table('users')->insert([
	            'name' => 'admin',
	            'email' => 'admin@gmail.com',
	            'password' => bcrypt(123),
	        ]);

        //Attach Role
	        DB::table('role_user')->insert([
	            'user_id' => 1,
	            'role_id' => 1,
	        ]);	    
    }
}

<?php

use Illuminate\Database\Seeder;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
	    //Make all Permission for Admin
	    $permission_array = array('access-header', 'access-footer', 'access-all');
	    $created_perm_ids = array();

	    foreach($permission_array as $permission){

	        $perm_inserted = DB::table('permissions')->insertGetId([
	            'name' => $permission,
	            'display_name' => str_replace('-', ' ', $permission),
	            'description' => str_replace('-', ' ', $permission),
	        ]);

	        $created_perm_ids[] = $perm_inserted;
	    }

	    //Assign all Permissions to Admin
	    foreach($created_perm_ids as $created_perm_id){

	        $perm_inserted = DB::table('permission_role')->insert([
	            'permission_id' => $created_perm_id,
	            'role_id' => 1,
	        ]);
	    }
    }
}

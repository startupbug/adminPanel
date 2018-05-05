<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
	public function getAllPermissions(){
		return $this->all();
	}

	public function getSinglePermission($id){
        return $this->where('id', $id)
                    ->first();		
	}
}

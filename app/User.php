<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Notifications\userNotify;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait; // add this trait to your user model

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAllUsers(){
        
        return $this->leftjoin('role_user', 'role_user.user_id', '=', 'users.id')
                     ->leftjoin('roles', 'roles.id', '=', 'role_user.role_id')
                     ->leftjoin('statuses', 'statuses.id', '=', 'users.status_id')
                     ->select('users.id', 'users.name', 'users.email', 'roles.display_name', 'statuses.status')
                     ->get();
    }

    public function getSingleUsers($id){
        return $this->join('role_user', 'role_user.user_id', '=', 'users.id')
                     ->join('roles', 'roles.id', '=', 'role_user.role_id')
                     ->leftjoin('statuses', 'statuses.id', '=', 'users.status_id')
                     ->select('users.id', 'users.status_id', 'roles.id as role_id', 'users.name', 'users.email', 'roles.display_name', 'users.password', 'statuses.status')
                     ->where('users.id', $id)
                     ->first();
    }

    public function getSingleUserDetail($id){
        return $this->join('role_user', 'role_user.user_id', '=', 'users.id')
                     ->join('roles', 'roles.id', '=', 'role_user.role_id')
                     ->leftjoin('statuses', 'statuses.id', '=', 'users.status_id')
                     ->select('users.id', 'roles.id as role_id', 'users.name', 'users.email', 'roles.display_name', 'users.password', 'statuses.status')
                     ->where('users.id', $id)
                     ->first();        
    }
}

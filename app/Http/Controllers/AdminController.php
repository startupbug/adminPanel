<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity_log;
use App\User;

class AdminController extends Controller
{
    public function index(){
    	return view('admin.index');
    }

    public function usermanagement_index(){
    	return view('admin.user-management');
    }

    //Activity Log Controller
    public function activitylog_index(){
		$data['activity_logs'] = Activity_log::select('users.name', 'activity_log.*')
									->leftjoin('users', 'users.id', '=', 'activity_log.user_id')->get();    	
    	return view('admin.activitylog.index')->with($data);
    }
}

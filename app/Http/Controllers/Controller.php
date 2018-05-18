<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Activity_log;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //generic function for initializing session
    protected function set_session($msg, $status){
	     session()->put('result', $status);
	     session()->put('msg', $msg);
    }

    protected function logActivity($activity){

    	$activity_log = new Activity_log();
    	$activity_log->user_id = Auth::user()->id;
    	$activity_log->text = $activity;
    	$activity_log->ip_address = $_SERVER['REMOTE_ADDR'];
    	$activity_log->save();
    }
}

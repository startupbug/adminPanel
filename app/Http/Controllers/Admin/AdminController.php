<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AnalyticsController;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Activity_log;
use App\Todo;
use App\Page;

class AdminController extends Controller
{
    public function index(){

    	$analytics = new AnalyticsController;
        
        $data['usercount'] = User::all()->count();
        $data['today_usercount'] = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['activitylogcount'] = Activity_log::all()->count();
        $data['today_activitylogcount'] = Activity_log::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['todocount'] = Todo::all()->count(); 
        $data['com_todocount'] = Todo::where('status', 2)->count();

        $data['pagecount'] = Page::all()->count();

    	return view('admin.index', ['country' => $analytics->getCountries()])->with($data);
    }

    public function usermanagement_index(){

    	return view('admin.user-management');
    }
}

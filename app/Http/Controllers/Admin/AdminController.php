<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AnalyticsController;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

    	$analytics = new AnalyticsController;
    	//dd($analytics->getCountries());
    	return view('admin.index', ['country' => $analytics->getCountries()]);
    }

    public function usermanagement_index(){
    	return view('admin.user-management');
    }
}

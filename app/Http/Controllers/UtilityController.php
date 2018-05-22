<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function todolist_index(){
    	return view('admin.adminPanelutility.todolist-index');
    }
}

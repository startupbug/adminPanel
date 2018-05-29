<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class GoogleCalender extends Controller
{
    //

    public function all_events(){
    	$events = Event::get();
    	dd($events);

    	//create a new event
		$event = new Event;

		$event->name = 'A new event';
		$event->startDateTime = Carbon::now();
		$event->endDateTime = Carbon::now()->addHour();
		$event->addAttendee(['email' => 'irfa.aimviz@gmail.com']);
		$event->addAttendee(['email' => 'farhan.aimviz@gmail.com']);

		$event->save();
		dd($event);
    }
}

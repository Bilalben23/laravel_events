<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventIndexController extends Controller
{

    public function __invoke(Request $request)
    {
        $events = Event::with("country", "tags")->orderBy("created_at", "desc")->paginate(12);

        return view("eventIndex", compact("events"));
    }
}
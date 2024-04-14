<?php

namespace App\Http\Controllers;

use App\Models\Event;

class SavedEventController extends Controller
{

    public function __invoke()
    {
        $events = Event::with("savedEvents")->whereHas("savedEvents", function ($q) {
            $q->where("user_id", auth()->id());
        })->get();

        return view("events.savedEvents",compact("events"));
    }
}
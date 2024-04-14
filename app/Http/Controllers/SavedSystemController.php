<?php

namespace App\Http\Controllers;

use App\Models\Event;

class SavedSystemController extends Controller
{
    public function __invoke(int $id)
    {
        $event = Event::findOrFail($id);
        $savedEvent = $event->savedEvents()->whereUser_id(auth()->id())->first();
        if (!is_null($savedEvent)) {
            $savedEvent->delete();
            return null;
        } else {
            $savedEvent = $event->savedEvents()->create([
                "user_id" => auth()->id(),
            ]);
            return $savedEvent;
        }
    }
}
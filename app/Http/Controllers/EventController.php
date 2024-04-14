<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\Country;
use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use ILluminate\Support\Str;


class EventController extends Controller
{

    public function index(): View
    {
        # eager loading VS  lazy loading
        $events = Event::with("country")->get();
        return view("events.index", compact("events"));
    }

    public function create(): View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view("events.create", compact("countries", "tags"));
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data["image"] = Storage::putFile("events", $request->file("image"));
        $data["user_id"] = auth()->id();

        $data["slug"] = Str::slug($request->title);

        $event = Event::create($data);
        $event->tags()->attach($request->tags);

        return to_route("events.index")
            ->with("success-message", "Event Created Successfully!");
    }

    public function show(Event $event)
    {
        //
    }

    public function edit(Event $event): View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view("events.edit", compact("countries", "tags", "event"));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();
        $data["slug"] = Str::slug($request->title);
        $data["user_id"]= auth()->id();

        if ($request->hasFile("image")) {
            // delete old image:
            Storage::delete($event->image);

            // Store the new image:
            $data["image"] = Storage::putFile("events", $request->file("image"));
        } else {
            $data["image"] = $event->image;
        }


        $event->update($data);
        $event->tags()->sync($request->tags);

        return to_route("events.index")
            ->with("success-message", "Event updated successfully!");
    }

    // Route Model binding:
    public function destroy(Event $event): redirectResponse
    {
        Storage::delete($event->image);
        $event->tags()->detach();
        $event->delete();
        return to_route("events.index")
            ->with("success-message", "Event deleted successfully!");
    }
}
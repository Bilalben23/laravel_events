<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = auth()->user()->galleries;
        return view("galleries.index", compact("galleries"));
    }

    public function create(): View
    {
        return view("galleries.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "caption" => ["required", "string"],
            "image" => ["required", "image", "mimes:png,jpeg,jpg,gif,svg", "max:2048"],
        ]);

        if ($request->hasFile("image")) {
            auth()->user()->galleries()->create([
                "caption" => $request->input("caption"),
                "image" => $request->file("image")->store("galleries", "public")
            ]);
            return to_route("galleries.index")
                ->with("success-message", "Gallery created successfully!");
        }

        return Redirect::back();
    }

    public function edit(Gallery $gallery)
    {
        return view("galleries.edit", compact("gallery"));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $path = $gallery->image;
        $request->validate([
            "caption" => ["required", "string"],
            "image" => ["nullable", "image", "mimes:png,jpeg,jpg,gif,svg", "max:2048"],
        ]);

        if ($request->hasFile("image")) {
            Storage::delete($gallery->image);
            $path = $request->file("image")->store("galleries", "public");
        }

        $gallery->update([
            "caption" => $request->input("caption"),
            "image" => $path,
        ]);
        return to_route("galleries.index")
            ->with("success-message", "Gallery updated successfully!");
    }

    public function destroy(Gallery $gallery)
    {
        Storage::delete($gallery->image);

        $gallery->delete();
        return to_route("galleries.index")
            ->with("success-message", "Gallery deleted successfully!");
    }
}
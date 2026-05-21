<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mood;
use Illuminate\Http\Request;

class MoodController extends Controller
{
    public function index()
    {
        $moods = Mood::all();
        return view("admin.moods.index", compact("moods"));
    }

    public function create()
    {
        return view("admin.moods.create");
    }

    public function store(Request $request)
    {
        $newMood = new Mood();
        $newMood->name = $request->name;
        $newMood->save();
        return redirect()->route("admin.moods.index");
    }

    public function show(Mood $mood)
    {
        return view("admin.moods.show", compact("mood"));
    }

    public function edit(Mood $mood)
    {
        return view("admin.moods.edit", compact("mood"));
    }

    public function update(Request $request, Mood $mood)
    {
        $mood->name = $request->name;
        $mood->save();
        return redirect()->route("admin.moods.index");
    }

    public function destroy(Mood $mood)
    {
        $mood->delete();
        return redirect()->route("admin.moods.index");
    }
}
<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

use App\Models\Category;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::all();

        return view("contents.index", compact("contents"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();
         return view("contents.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();


        $newContent = new Content();

        $newContent->title = $data["title"];
         $newContent->category_id = $data["category_id"];
          $newContent->time_needed_visiting  = $data["time_needed_visiting"];
           $newContent->mood_tag  = $data["mood_tag"];
            $newContent->description  = $data["description"];

            $newContent->save();

            return redirect()->route("admin.contents.show", $newContent);
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        return view("contents.show", compact("content"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        return view("contents.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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

        return view("admin.contents.index", compact("contents"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();
         return view("admin.contents.create", compact("categories"));
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
        return view("admin.contents.show", compact("content"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)

    {
        $categories =Category::all();
        return view("admin.contents.edit", compact("content", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
         $data = $request->all();




        $content->title = $data["title"];
         $content->category_id = $data["category_id"];
          $content->time_needed_visiting  = $data["time_needed_visiting"];
           $content->mood_tag  = $data["mood_tag"];
            $content->description  = $data["description"];

            $content->update();

            return redirect()->route("admin.contents.show", $content);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route("admin.contents.index");
    }
}

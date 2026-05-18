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

        $newContent =$data["title"];
         $newContent =$data["category->name"];
          $newContent =$data["time_needed_visiting"];
           $newContent =$data["mood_tag"];
            $newContent =$data["description"];

            $newContent->Save();

            return redirect()->view("contents.show", $newContent);
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
    public function edit(string $id)
    {
        //
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

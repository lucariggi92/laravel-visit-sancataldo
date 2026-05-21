<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Content;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\Mood;
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
          $moods = Mood::all(); 
         return view("admin.contents.create", compact("categories", "moods"));
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
        $newContent->description  = $data["description"];

            if(array_key_exists("image", $data)){
                $img_url =Storage::putFile("contents", $data["image"]);
                $newContent->image = $img_url;
            }

            $newContent->save();

            if($request->has("moods")){
              $newContent->moods()->attach($data["moods"]);
            }

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
            $moods = Mood::all();
        return view("admin.contents.edit", compact("content", "categories", "moods"));
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
        $content->description  = $data["description"];
            
        if(array_key_exists("image", $data)){
            Storage::delete($content->image);
              $img_url =Storage::putFile("contents", $data["image"]);
              $content->image = $img_url;
            }


            $content->update();
                if($request->has("moods")){
                    $content->moods()->sync($data["moods"]);
                } else {
                    $content->moods()->detach();
                }


            return redirect()->route("admin.contents.show", $content);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {

    if($content->image){
        Storage::delete($content->image);
    }
        $content->delete();
        return redirect()->route("admin.contents.index");
    }
}

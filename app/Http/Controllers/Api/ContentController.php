<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;


class ContentController extends Controller
{
   
    
       
    public function show(Content $content){

    $content->load("category", "moods");

    return response()->json([
        "success" => true,
        "data" => $content
    ]);

    }
   
}





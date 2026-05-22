<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;


class ContentController extends Controller
{
   
    public function index(){
      $contents = Content::with("caegory", "moods")->get();

    }
   
       
    public function show(Content $content)
    {
        // Cerchiamo il contenuto tramite ID caricando anche le relazioni category e moods
        $content ->load("category", "moods");

     
        // Se esiste, lo restituiamo racchiuso nella chiave "data"
        return response()->json([
            "success" => true,
            "data" => $content
        ]);
    }
   
}





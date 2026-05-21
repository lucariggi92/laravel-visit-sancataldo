<?php

namespace App\Http\Controllers\Api;

use App\Models\Itinerary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function index(){

    $itineraries = Itinerary::with('contents.category')->get();

    return response()->json(
        [
            "success"=> true,
            "data"=> $itineraries
        ]
    );
    }


    // Genera e salva un nuovo itinerario in base alle preferenze dell'utente
    public function store(Request $request)
    {
        $mood = $request->input('mood');
        $category = $request->input('category');
        $food = $request->input('food');
        $time = (int) $request->input('time'); // minuti disponibili

//deve filtrre un contentuo in base alla categoria 
//deve filtrare u secondo contentuto che abbia la stessa categoria di prima ma anche il mood e che sia diverso da quello precedente
//se ha scelto che ha fame deve inserire il content filtrato in base al food_type

 // Seleziona i contents che rientrano nel tempo disponibile



 //se non rientrano? scegli il secondo conten mood e categorie e il cibo
 //se hai ancora tempo inserisci un cpntrnt con filtro catgories
 //se hai ancora tempo aggiungi un contenddt con categories e mood filtrato

 //se come tempo hai tutta la giornata puoi inserire colazione pranzo e cena e li aggiungi

 //salva l'itinerario con tot la collerzione di contents che saaranno salvati immagino nella tabella pivot

        // Filtra i contents in base a mood e categoria
        // esclude i contents food (food_type non null) — li gestiamo separatamente
        $contents = Content::where('mood_tag', $mood)
            ->whereHas('category', function($q) use ($category) {
                $q->where('name', $category);
            })
            ->whereNull('food_type')
            ->get();

        // Seleziona i contents che rientrano nel tempo disponibile
        $selected = collect();
        $totalTime = 0;

        foreach ($contents as $content) {
            if ($totalTime + $content->time_needed_visiting <= $time) {
                $selected->push($content);
                $totalTime += $content->time_needed_visiting;
            }
        }

        // Se l'utente vuole mangiare, aggiungi un content food
        if ($food && $food !== 'nessuno') {
            $foodContent = Content::whereNotNull('food_type')
                ->where('food_type', $food)
                ->first();

            if ($foodContent) {
                $selected->push($foodContent);
                $totalTime += $foodContent->time_needed_visiting;
            }
        }

        // Crea e salva l'itinerario
        $itinerary = new Itinerary();
        $itinerary->title = "La tua giornata a San Cataldo";
        $itinerary->description = "Un itinerario pensato per te — mood: $mood, tempo: $time minuti.";
        $itinerary->mood = $mood;
        $itinerary->food_preference = $food !== 'nessuno' ? $food : null;
        $itinerary->time_available = $time;
        $itinerary->save();

        // Collega i contents all'itinerario tramite la pivot
        $itinerary->contents()->attach($selected->pluck('id'));

        // Restituisce l'itinerario completo con i contents e le categorie
        $itinerary->load('contents.category');

        return response()->json([
            "success" => true,
            "data" => $itinerary
        ]);
    }

}

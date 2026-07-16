<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Models\Mood;
use App\Models\Itinerary;
use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// <!-- 
// 1.Filtra contents per mood E categoria
// 2.verifica se il tempo a disposizone è maggiore del time neede visiting
// 3.se la condizone pè soddifatta lo salva
// 4.verifica se  vuole mangiare (SI NO)
// 5.se si scegli il type food (casuale) se no passa al n.7
// 6.somma il time needed del food + il content e verifica se la somma totale dei due time visiting è minore o uguale al tempo a disposizinedell'utente
// 6. se no procede con un altro food finchè non trova quello che che il cui visiting time + quello dei content precedenti è minore uguale tempo sufficiente
// 7.se si procede ad aggiungere altri content filtrati per mood e categoria 
// 8.verifica se c'è abbastanza tempo nuovamwnte confrontant il tot visiting tim didei due contnt e il food
// 9. se si ne aggiung un altro, se no si ferma e salva l'itinerario.  -->





class ItineraryController extends Controller
{
    public function index()
    {
        $itineraries = Itinerary::with('contents.category')->get();

        return response()->json([
            "success" => true,
            "data" => $itineraries
        ]);
    }

    public function store(Request $request)
    {
        $mood = $request->input('mood');
        $category = $request->input('category');
        $food = $request->input('food'); // es. "spuntino" oppure null
        $time = (int) $request->input('time'); // minuti disponibili

        // collect() crea una lista vuota — come un array ma con metodi Laravel
        // la useremo per raccogliere i contents selezionati
        $selected = collect();
        $totalTime = 0;

        // STEP 1-3: cerca il primo content che matcha mood E categoria
        // whereHas() verifica che esista una relazione — in questo caso
        // che il content abbia tra i suoi moods quello scelto dall'utente
        // è come fare un JOIN ma in modo "eloquente"

        $categoryId = Category::where('name', $category)->first()->id;
        $moodId = Mood::where('name', $mood)->first()->id;


        $firstContent = Content::where('category_id', $categoryId)
            ->whereHas('moods', function($q) use ($moodId) {
                $q->where('mood_id', $moodId);
            })
            ->where('time_needed_visiting', '<=', $time)
            ->first();

        if ($firstContent) {
            // push() aggiunge un elemento alla collection
            $selected->push($firstContent);
            $totalTime += $firstContent->time_needed_visiting;
        }

        // STEP 4-6: se l'utente vuole mangiare
        if ($food) {
            // prende tutti i contents food del tipo scelto
            $foodContents = Content::whereNotNull('food_type')
                ->where('food_type', $food)
                ->get();

            // scorre i food finché non trova uno che rientra nel tempo rimasto
            foreach ($foodContents as $foodContent) {
                if ($totalTime + $foodContent->time_needed_visiting <= $time) {
                    $selected->push($foodContent);
                    $totalTime += $foodContent->time_needed_visiting;
                    // break esce dal foreach appena trova il primo food che va bene
                    // senza break continuerebbe ad aggiungere tutti i food!
                    break;
                }
            }
        }

        // STEP 7-9: se c'è ancora tempo, aggiungi altri contents
        if ($totalTime < $time) {

            // pluck('id') estrae solo gli id dalla collection $selected
            // es. se $selected ha 2 contents con id 3 e 7, pluck restituisce [3, 7]
            // whereNotIn esclude quelli già selezionati per non avere duplicati
            $others = Content::where('category_id', $categoryId)
                    ->whereHas('moods', function($q) use ($moodId) {
                        $q->where('mood_id', $moodId);
                    })
                    ->whereNotIn('id', $selected->pluck('id'))
                    ->get();

            foreach ($others as $content) {
                if ($totalTime + $content->time_needed_visiting <= $time) {
                    $selected->push($content);
                    $totalTime += $content->time_needed_visiting;
                }
            }
        }



        // Salva l'itinerario — il titolo si genera automaticamente
        $itinerary = new Itinerary();
        $itinerary->title = "La tua giornata a San Cataldo";
        $itinerary->description = "Itinerario — mood: $mood, fatto di: $category";
        $itinerary->mood = $mood;
        $itinerary->food_preference = $food ?? null; // ?? significa: se $food è null, salva null
        $itinerary->time_available = $time;
        $itinerary->save();

        // attach() collega i contents all'itinerario nella tabella pivot
        // pluck('id') estrae gli id dei contents selezionati
        $itinerary->contents()->attach($selected->pluck('id'));

        // load() carica le relazioni sull'oggetto appena salvato
        // è come fare with() ma dopo il salvataggio
        $itinerary->load('contents.category', 'contents.moods');

        return response()->json([
            "success" => true,
            "data" => $itinerary
        ]);
    }
}
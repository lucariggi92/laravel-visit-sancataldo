# 🗺️ Visit San Cataldo — Guida completa al progetto

## 📌 Descrizione
Applicazione web che genera itinerari personalizzati per visitare San Cataldo in base alle preferenze dell'utente (stato d'animo, tempo disponibile, interessi, fame). Il frontend React presenta un form interattivo e mostra l'itinerario generato automaticamente.

---

## 🗄️ Struttura del Database

### Tabella `categories`
| Campo | Tipo | Note |
|---|---|---|
| id | bigint | PK auto |
| name | string | es. "Chiese", "Ristoranti" |
| slug | string | unique, es. "chiese" |
| icona | string | nome icona o path |
| timestamps | — | created_at, updated_at |

### Tabella `contents`
| Campo | Tipo | Note |
|---|---|---|
| id | bigint | PK auto |
| category_id | FK | → categories.id |
| title | string | nome del posto |
| description | text | descrizione |
| img_covering | string | path immagine |
| mood_tag | string | es. "rilassato", "energico", "curioso", "annoiato" |
| time_needed_visiting | integer | minuti necessari per la visita |
| interest_tag | string | es. "arte", "storia", "natura" |
| food_type | string | es. "spuntino", "cena", "cocktail" (null se non food) |
| timestamps | — | created_at, updated_at |

### Tabella `itineraries`
| Campo | Tipo | Note |
|---|---|---|
| id | bigint | PK auto |
| name | string | nome dell'itinerario |
| difficulty | string | es. "facile", "medio", "impegnativo" |
| type | string | es. "culturale", "gastronomico", "misto" |
| timestamps | — | created_at, updated_at |

### Tabella pivot `content_itinerary`
| Campo | Tipo | Note |
|---|---|---|
| id | bigint | PK auto |
| content_id | FK | → contents.id |
| itinerary_id | FK | → itineraries.id |
| order | integer | posizione nel percorso |
| timestamps | — | created_at, updated_at |

> 💡 La **durata totale** dell'itinerario si calcola dinamicamente sommando `time_needed_visiting` di tutti i contents collegati — non va salvata nel DB.

---

## 📁 Struttura file del progetto

```
app/
  Http/
    Controllers/
      Admin/
        CategoriesController.php
        ContentsController.php
        ItinerariesController.php
  Models/
    Category.php
    Content.php
    Itinerary.php

database/
  migrations/
    create_categories_table.php
    create_contents_table.php
    create_itineraries_table.php
    create_content_itinerary_table.php
  seeders/
    DatabaseSeeder.php
    CategoriesTableSeeder.php
    ContentsTableSeeder.php
    ItinerariesTableSeeder.php

resources/
  views/
    layouts/
      master.blade.php
    categories/
      index.blade.php
      create.blade.php
      edit.blade.php
    contents/
      index.blade.php
      create.blade.php
      edit.blade.php
    itineraries/
      index.blade.php
      create.blade.php
      edit.blade.php

routes/
  web.php
  api.php             ← per le chiamate React
```

---

## 🚀 Step by step — Backend Laravel

### STEP 1 — Reset e pulizia
```bash
php artisan migrate:fresh
```

---

### STEP 2 — Migration (nell'ordine!)

#### 2.1 Categories
```bash
php artisan make:migration create_categories_table
```
```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('icona')->nullable();
    $table->timestamps();
});
```

#### 2.2 Contents
```bash
php artisan make:migration create_contents_table
```
```php
Schema::create('contents', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->text('description');
    $table->string('img_covering')->nullable();
    $table->string('mood_tag');
    $table->integer('time_needed_visiting'); // in minuti
    $table->string('interest_tag');
    $table->string('food_type')->nullable();
    $table->timestamps();
});
```

#### 2.3 Itineraries
```bash
php artisan make:migration create_itineraries_table
```
```php
Schema::create('itineraries', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('difficulty'); // facile, medio, impegnativo
    $table->string('type');      // culturale, gastronomico, misto
    $table->timestamps();
});
```

#### 2.4 Pivot content_itinerary
```bash
php artisan make:migration create_content_itinerary_table
```
```php
Schema::create('content_itinerary', function (Blueprint $table) {
    $table->id();
    $table->foreignId('content_id')->constrained()->onDelete('cascade');
    $table->foreignId('itinerary_id')->constrained()->onDelete('cascade');
    $table->integer('order');
    $table->timestamps();
});
```

#### Esegui tutte le migration
```bash
php artisan migrate
```

---

### STEP 3 — Models

#### 3.1 Category
```bash
php artisan make:model Category
```
```php
class Category extends Model
{
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
```

#### 3.2 Content
```bash
php artisan make:model Content
```
```php
class Content extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function itineraries()
    {
        return $this->belongsToMany(Itinerary::class, 'content_itinerary')
                    ->withPivot('order')
                    ->withTimestamps();
    }
}
```

#### 3.3 Itinerary
```bash
php artisan make:model Itinerary
```
```php
class Itinerary extends Model
{
    public function contents()
    {
        return $this->belongsToMany(Content::class, 'content_itinerary')
                    ->withPivot('order')
                    ->orderByPivot('order')
                    ->withTimestamps();
    }

    // Durata totale calcolata dinamicamente
    public function getTotalDurationAttribute()
    {
        return $this->contents->sum('time_needed_visiting');
    }
}
```

---

### STEP 4 — Controllers Admin

```bash
php artisan make:controller Admin/CategoriesController
php artisan make:controller Admin/ContentsController
php artisan make:controller Admin/ItinerariesController
```

Ogni controller avrà i metodi: `index`, `create`, `store`, `edit`, `update`, `destroy`

---

### STEP 5 — Route

In `routes/web.php`, dentro il gruppo admin:
```php
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ContentsController;
use App\Http\Controllers\Admin\ItinerariesController;

Route::middleware(["auth", "verified"])
    ->name("admin.")
    ->prefix("admin")
    ->group(function(){
        Route::resource("categories", CategoriesController::class);
        Route::resource("contents", ContentsController::class);
        Route::resource("itineraries", ItinerariesController::class);
    });
```

---

### STEP 6 — Seeders

```bash
php artisan make:seeder CategoriesTableSeeder
php artisan make:seeder ContentsTableSeeder
php artisan make:seeder ItinerariesTableSeeder
```

Ordine di esecuzione in `DatabaseSeeder.php`:
```php
$this->call([
    CategoriesTableSeeder::class,  // prima le categorie
    ContentsTableSeeder::class,    // poi i contents (hanno FK su categories)
    ItinerariesTableSeeder::class, // infine gli itinerari
]);
```

```bash
php artisan migrate:fresh --seed
```

---

### STEP 7 — Views Blade (pannello admin)

Per ogni risorsa (categories, contents, itineraries):
- `index.blade.php` — tabella con elenco + pulsanti edit/delete
- `create.blade.php` — form di inserimento
- `edit.blade.php` — form di modifica precompilato

---

### STEP 8 — API per React

In `routes/api.php` creare un endpoint che riceve i parametri del form e restituisce l'itinerario generato:

```bash
php artisan make:controller Api/ItineraryController
```

```php
// routes/api.php
Route::post('/itinerary/generate', [ItineraryController::class, 'generate']);
```

Logica di generazione in base ai tag:
```php
public function generate(Request $request)
{
    $contents = Content::query()
        ->where('mood_tag', $request->mood)
        ->where('interest_tag', $request->interest)
        ->where('time_needed_visiting', '<=', $request->time)
        ->when($request->food, fn($q) => $q->orWhere('food_type', $request->food))
        ->with('category')
        ->get();

    $totalDuration = $contents->sum('time_needed_visiting');

    return response()->json([
        'contents' => $contents->groupBy('category.name'),
        'total_duration' => $totalDuration,
    ]);
}
```

---

## 🎨 STEP 9 — Frontend React

Form con 4 domande:

| Domanda | Opzioni |
|---|---|
| Stato d'animo | Rilassato, Energico, Curioso, Annoiato |
| Tempo disponibile | 1h (60min), 4h (240min), Tutto il pomeriggio (300min), Tutto il giorno (480min) |
| Interesse | Arte, Storia, Natura |
| Fame | Spuntino, Cena, Cocktail |

Flusso:
1. Utente compila il form
2. React invia POST a `/api/itinerary/generate` con i tag selezionati
3. Laravel filtra i contents per tag e risponde con JSON
4. React mostra l'itinerario raggruppato per categoria con durata totale

---

## 🔧 Comandi utili

| Comando | Descrizione |
|---|---|
| `php artisan serve` | Avvia il server |
| `php artisan migrate` | Esegue le migration |
| `php artisan migrate:fresh --seed` | Reset DB + seed |
| `php artisan db:seed` | Solo seeder |
| `php artisan route:list` | Lista tutte le route |
| `php artisan make:model Nome` | Crea un model |
| `php artisan make:controller Nome` | Crea un controller |
| `php artisan make:migration nome` | Crea una migration |
| `php artisan make:seeder NomeSeeder` | Crea un seeder |

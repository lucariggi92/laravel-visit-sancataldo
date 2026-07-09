# 🌿 Visit San Cataldo — Backend

Backend **Laravel** di **Visit San Cataldo**, applicazione che genera itinerari turistici personalizzati per la città di San Cataldo (CL), Sicilia, in base al mood, al tempo disponibile e alle preferenze dell'utente.

Questo repository espone le **API REST** utilizzate dal [frontend React](https://github.com/lucariggi92/laravel-react-visit-sancataldo) e include un **pannello di amministrazione** per gestire contenuti, categorie, mood e itinerari.

🔗 Instagram: [@visit_sancataldo](https://www.instagram.com/visit_sancataldo/)
🔗 Facebook: [Visit San Cataldo](https://www.facebook.com/profile.php?id=61579456103577&locale=it_IT)

---

## ✨ Funzionalità

- **API pubblica** per la generazione di itinerari personalizzati e il recupero dei dettagli delle tappe
- **Pannello admin** (autenticazione via Laravel Breeze) per gestire:
  - Contenuti/tappe (attrazioni e punti di ristorazione)
  - Categorie (Arte & Architettura, Siti Archeologici, Natura...)
  - Mood (curioso, avventuriero, rilassato...)
  - Itinerari generati
- **Algoritmo di generazione itinerario**: seleziona le tappe in base a mood e categoria scelti, verifica che il tempo di visita rientri in quello disponibile, aggiunge eventualmente una sosta gastronomica e continua ad aggiungere tappe finché c'è tempo residuo

---

## 🛠️ Stack tecnologico

- **[Laravel 11](https://laravel.com/)** (PHP 8.2+)
- **[Laravel Sanctum](https://laravel.com/docs/sanctum)** — predisposto per autenticazione API
- **[Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)** — scaffolding di autenticazione per il pannello admin
- **Blade** + **Tailwind CSS** / **Bootstrap 5** — viste del pannello admin
- **SQLite** come database di default (configurabile su MySQL/PostgreSQL)
- **Vite** — build degli asset del pannello admin

---

## 🗄️ Modello dati

| Tabella | Descrizione |
|---|---|
| `categories` | Categorie delle tappe (nome + colore) |
| `contents` | Tappe/attrazioni: titolo, descrizione, immagine, tempo di visita, tipo di pasto (se ristorazione), categoria collegata |
| `moods` | Stati d'animo selezionabili dall'utente |
| `content_mood` | Tabella pivot contenuti ↔ mood |
| `itineraries` | Itinerari generati: titolo, descrizione, mood, preferenza cibo, tempo disponibile |
| `content_itinerary` | Tabella pivot contenuti ↔ itinerario |

**Relazioni principali:**
- Un `Content` appartiene a una `Category` e a molti `Mood`
- Un `Itinerary` ha molti `Content` (tramite pivot)

---

## 🔌 API Endpoints

| Metodo | Endpoint | Descrizione |
|---|---|---|
| `GET` | `/api/itineraries` | Elenco di tutti gli itinerari generati |
| `POST` | `/api/itineraries` | Genera un nuovo itinerario a partire da `mood`, `category`, `time`, `food` |
| `GET` | `/api/contents/{content}` | Dettaglio di una singola tappa (con categoria e mood associati) |

### Come funziona `POST /api/itineraries`

1. Filtra i contenuti per `mood` e `category` scelti dall'utente
2. Seleziona la prima tappa il cui tempo di visita rientra nel tempo disponibile
3. Se l'utente ha indicato una preferenza alimentare (`food`), aggiunge la prima tappa di ristorazione compatibile con il tempo rimanente
4. Continua ad aggiungere altre tappe (stesso mood/categoria) finché c'è tempo residuo
5. Salva l'itinerario e restituisce le tappe selezionate con le relative categorie e mood

---

## 🚀 Setup e avvio in locale

### Requisiti

- PHP 8.2+
- Composer
- Node.js e npm (per gli asset del pannello admin)
- SQLite (o altro DB supportato da Laravel)

### Installazione

```bash
# clona il repository
git clone https://github.com/<tuo-username>/laravel-visit-sancataldo.git
cd laravel-visit-sancandaldo

# installa le dipendenze PHP
composer install

# installa le dipendenze JS (per il pannello admin)
npm install
```

### Configurazione ambiente

```bash
# copia il file di configurazione
cp .env.example .env

# genera la chiave dell'applicazione
php artisan key:generate

# crea il database SQLite (se non presente)
touch database/database.sqlite
```

Verifica che nel `.env` sia impostato:

```
DB_CONNECTION=sqlite
```

> Per usare MySQL/PostgreSQL, modifica le variabili `DB_*` nel `.env` di conseguenza.

### Migrazioni e seed

```bash
php artisan migrate --seed
```

Questo crea le tabelle e popola categorie, mood e contenuti di esempio.

### Avvio del server

```bash
php artisan serve
```

L'API sarà disponibile su `http://localhost:8000/api`.

Per il pannello admin, avvia anche il build degli asset front-end:

```bash
npm run dev
```

e visita `http://localhost:8000` per accedere/registrarti e raggiungere `/dashboard` e le sezioni `/admin/*`.

### CORS

Il file `config/cors.php` è configurato per accettare richieste da qualsiasi origine sulle rotte `api/*`. In produzione è consigliabile restringere `allowed_origins` al dominio del frontend.

---

## 🔗 Progetto collegato

Il frontend React (Vite) che consuma queste API si trova in un repository separato: **Visit San Cataldo — Frontend**.

---

## 🗺️ Roadmap

- [ ] Autenticazione API per il frontend pubblico (rate limiting / token)
- [ ] Validazione strutturata delle richieste (`FormRequest`) su `ItineraryController@store`
- [ ] Gestione multi-food e itinerari più lunghi (attualmente si ferma al primo food compatibile)
- [ ] Test automatici su API e algoritmo di generazione itinerario
- [ ] Paginazione per `GET /api/itineraries`
- [ ] Deploy in produzione (MySQL/PostgreSQL + storage immagini su cloud)

---

## 👤 Autore

Progetto sviluppato da **Luca**, ingegnere ambientale e sviluppatore web, come parte del progetto di comunicazione territoriale **Visit San Cataldo**.

---

## 📄 Licenza

Progetto privato. Tutti i diritti riservati, salvo diversa indicazione.


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Gestionale - Visit San Cataldo</title>
</head>
<body style="margin: 0; background-color: #121a21; font-family: system-ui, -apple-system, sans-serif;">

    {{-- HEADER GESTIONALE SCURO --}}
    <header style="background-color: #1b2631; padding: 16px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #2c3e50; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
        <div style="color: #ffffff; font-size: 1.1rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; gap: 8px;">
            <span>💻</span> Hub <span style="color: #8fa3b4; font-weight: 400;">Amministrazione</span>
        </div>
        <nav style="display: flex; gap: 16px; align-items: center;">
            @auth
                <a href="{{ route('dashboard') }}" 
                   style="color: #2d3d4a; text-decoration: none; font-size: 0.85rem; padding: 10px 26px; background-color: #ffffff; border-radius: 20px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 2px 8px rgba(255,255,255,0.1);">
                    Entra nella Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" 
                   style="color: #ffffff; text-decoration: none; font-size: 0.9rem; font-weight: 600; padding: 8px 20px; opacity: 0.85;">
                    Accedi
                </a>
                <a href="{{ route('register') }}" 
                   style="color: #2d3d4a; text-decoration: none; font-size: 0.85rem; padding: 10px 26px; background-color: #ffffff; border-radius: 20px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                    Registra Admin
                </a>
            @endauth
        </nav>
    </header>

    {{-- HERO / INTRO PANNELLO --}}
    <div style="background-color: #1b2631; padding: 90px 40px; text-align: center; border-bottom: 1px solid #2c3e50; box-shadow: inset 0 -20px 30px rgba(0,0,0,0.05);">
        <div style="background: rgba(255, 255, 255, 0.08); color: #ffffff; padding: 6px 18px; border-radius: 20px; display: inline-block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.1);">
            Pannello Centrale Backend
        </div>
        <h1 style="color: #ffffff; font-size: 3rem; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; margin: 0;">
            Visit <span style="color: #8fa3b4; font-weight: 300;">San Cataldo</span>
        </h1>
        <p style="color: #b2c2d1; font-size: 1.1rem; margin-top: 18px; max-width: 600px; margin-left: auto; margin-right: auto; line-height: 1.7; font-weight: 300;">
            Benvenuto nello spazio di lavoro privato. Gestisci i contenuti del database, personalizza le tappe e controlla i dati distribuiti in tempo reale alla tua applicazione React.
        </p>
        
        <div style="margin-top: 40px;">
            @auth
                <a href="{{ route('dashboard') }}" style="display: inline-block; padding: 14px 40px; background-color: #2d3d4a; color: #ffffff; font-weight: 600; text-transform: uppercase; text-decoration: none; border-radius: 25px; font-size: 0.85rem; letter-spacing: 1px; border: 2px solid #ffffff; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); font-weight: 700;">
                    Gestisci Contenuti ➔
                </a>
            @else
                <a href="{{ route('login') }}" style="display: inline-block; padding: 14px 40px; background-color: #2d3d4a; color: #ffffff; font-weight: 600; text-transform: uppercase; text-decoration: none; border-radius: 25px; font-size: 0.85rem; letter-spacing: 1px; border: 2px solid #ffffff; font-weight: 700;">
                    Effettua il Login per iniziare
                </a>
            @endauth
        </div>
    </div>

    {{-- STATISTICHE DATABASE UNIFORMATE --}}
    <div style="padding: 0 40px; max-width: 1000px; margin: -35px auto 0 auto; position: relative; z-index: 10;">
        <div style="display: flex; justify-content: center; gap: 24px;">
            
            <div style="text-align: center; flex: 1; background: #2c3e50; padding: 35px 30px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 2.8rem; font-weight: 900; color: #ffffff;">{{ \App\Models\Content::count() }}</div>
                <div style="color: #b2c2d1; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; margin-top: 8px; font-weight: 600; opacity: 0.8;">Contenuti Totali</div>
            </div>
            
            <div style="text-align: center; flex: 1; background: #2c3e50; padding: 35px 30px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 2.8rem; font-weight: 900; color: #ffffff;">{{ \App\Models\Category::count() }}</div>
                <div style="color: #b2c2d1; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; margin-top: 8px; font-weight: 600; opacity: 0.8;">Categorie</div>
            </div>
            
            <div style="text-align: center; flex: 1; background: #2c3e50; padding: 35px 30px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 2.8rem; font-weight: 900; color: #ffffff;">{{ \App\Models\Itinerary::count() }}</div>
                <div style="color: #b2c2d1; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; margin-top: 8px; font-weight: 600; opacity: 0.8;">Itinerari Generati</div>
            </div>

        </div>
    </div>

    {{-- MONITOR STATO INTERNO --}}
    <div style="max-width: 920px; margin: 60px auto 0 auto; padding: 0 20px; text-align: center;">
        <p style="color: #566f85; font-size: 0.85rem; border-top: 1px solid #1b2631; padding-top: 35px; font-weight: 500;">
            ⚡ Modalità Sviluppo Attiva • Connessione Database Locale OK
        </p>
    </div>

    {{-- FOOTER --}}
    <footer style="color: #415566; text-align: center; padding: 40px 20px 30px 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 0.5px;">
        © {{ date('Y') }} VISIT SAN CATALDO BACKEND • HUB PRIVATO
    </footer>

</body>
</html>
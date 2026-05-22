<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield("title") — Visit San Cataldo</title>
</head>
<body>

    {{-- HEADER --}}
    <header style="background-color: #2d3d4a; padding: 16px 40px; display: flex; justify-content: space-between; align-items: center;">
        
        <div style="color: white; font-size: 1.2rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
            <a href="{{ route('admin.contents.index') }}" style="text-decoration: none; color: white;">Visit <span style="color: #f5c518;">San Cataldo</span></a>
            <span style="color: rgba(255,255,255,0.4); font-size: 0.75rem; font-weight: 400; margin-left: 10px;">Area Amministrazione</span>
        </div>
        <nav style="display: flex; gap: 24px; align-items: center;">
    <a href="{{ route('admin.contents.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem;">Contenuti</a>
    <a href="{{ route('admin.categories.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem;">Categorie</a>
    <a href="{{ route('admin.moods.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem;">Mood</a>
    <a href="{{ route('admin.itineraries.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem;">Itinerari</a>

    {{-- SEPARATORE --}}
    <span style="color: rgba(255,255,255,0.2);">|</span>

    {{-- NOME UTENTE --}}
    <span style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">
        {{ Auth::user()->name }}
    </span>

    {{-- LOGOUT --}}
    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
        @csrf
        <button type="submit" style="background: none; border: 1px solid rgba(255,255,255,0.3); color: rgba(255,255,255,0.6); padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; cursor: pointer;">
            Logout
        </button>
    </form>
</nav>
    </header>

    {{-- CONTENUTO --}}
    @yield("contenuto")

    {{-- FOOTER --}}
    <footer style="background-color: #2d3d4a; color: rgba(255,255,255,0.5); text-align: center; padding: 20px; font-size: 0.8rem; margin-top: 40px;">
        © {{ date('Y') }} Visit San Cataldo — Area Amministrazione
    </footer>

</body>
</html>
<nav style="background-color: #0d1b24; border-bottom: 2px solid #f5c518; padding: 16px 40px; display: flex; justify-content: space-between; align-items: center;">
    
    {{-- LOGO --}}
    <a href="{{ route('dashboard') }}" style="text-decoration: none; color: white; font-size: 1.2rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
        Visit <span style="color: #f5c518;">San Cataldo</span>
    </a>

    {{-- USER + LOGOUT --}}
    <div style="display: flex; align-items: center; gap: 20px;">
        <span style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">
            {{ Auth::user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" style="background: none; border: 1px solid rgba(255,255,255,0.3); color: rgba(255,255,255,0.6); padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; cursor: pointer;">
                Logout
            </button>
        </form>
    </div>

</nav>
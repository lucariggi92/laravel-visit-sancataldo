<x-app-layout>

    <div style="background: radial-gradient(circle at center, #1b2631 0%, #121a21 100%); min-height: calc(100vh - 65px); display: flex; align-items: center; justify-content: center; text-align: center; padding: 2rem; font-family: system-ui, -apple-system, sans-serif;">
        
        <div style="background-color: rgba(27, 38, 49, 0.7); padding: 50px 40px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.05); max-width: 650px; width: 100%; box-sizing: border-box;">
            
            {{-- LOGO / TITOLO --}}
            <p style="color: #8fa3b4; text-transform: uppercase; letter-spacing: 3px; font-size: 0.8rem; margin-bottom: 1.5rem; font-weight: 700;">
                ⚡ Area Amministrazione Attiva
            </p>
            
            <h1 style="color: white; font-size: 3.5rem; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; margin: 0 0 1rem 0;">
                Visit <span style="color: #8fa3b4; font-weight: 300;">San Cataldo</span>
            </h1>
            
            <p style="color: #b2c2d1; font-size: 1.05rem; margin-bottom: 3rem; line-height: 1.6; font-weight: 300;">
                Gestisci contenuti, categorie, mood e itinerari del portale turistico distribuiti alla tua app React.
            </p>

            {{-- BOTTONI DI AZIONE (Pannello + React Rapido) --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                
                {{-- Entra nell'area Admin --}}
                <a href="{{ route('admin.contents.index') }}" 
                   style="background-color: #2d3d4a; color: #ffffff; padding: 16px 48px; border-radius: 99px; font-weight: 700; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; border: 2px solid #ffffff; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); transition: transform 0.1s;"
                   onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                    Entra nell'area admin →
                </a>

                {{-- Link rapido a React (Utilissimo mentre lavori nel pannello!) --}}
                <a href="http://localhost:5174/" target="_blank"
                   style="color: #00f0ff; text-decoration: none; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 10px 24px; background: rgba(0, 240, 255, 0.05); border: 1px solid rgba(0, 240, 255, 0.2); border-radius: 20px; transition: all 0.2s;"
                   onmouseover="this.style.background='rgba(0, 240, 255, 0.15)'; this.style.borderColor='#00f0ff'"
                   onmouseout="this.style.background='rgba(0, 240, 255, 0.05)'; this.style.borderColor='rgba(0, 240, 255, 0.2)'">
                    ⚛️ Controlla Frontend React
                </a>

            </div>

            {{-- LOGOUT --}}
            <div style="margin-top: 3.5rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.5rem;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            style="background: none; border: none; color: #566f85; font-size: 0.85rem; font-weight: 600; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: color 0.2s;"
                            onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#566f85'">
                        Disconnetti Sessione
                    </button>
                </form>
            </div>
            
        </div>

    </div>

</x-app-layout>
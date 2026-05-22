<x-guest-layout>
    <div style="background-color: #121a21; min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; font-family: system-ui, -apple-system, sans-serif;">
        
        {{-- CARD DEL FORM --}}
        <div style="background-color: #1b2631; width: 100%; max-width: 450px; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.05);">
            
            {{-- TITOLO DIDATTICO --}}
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: #ffffff; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                    Registra <span style="color: #8fa3b4; font-weight: 300;">Admin</span>
                </h2>
                <p style="color: #b2c2d1; font-size: 0.85rem; margin-top: 8px; font-weight: 300;">
                    Crea le credenziali per accedere al pannello didattico
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; color: #b2c2d1; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                        Nome Completo
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           style="width: 100%; padding: 12px 16px; background-color: #2c3e50; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #ffffff; font-size: 0.95rem; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#ffffff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'" />
                    
                    @if($errors->has('name'))
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 6px; font-weight: 500;">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; color: #b2c2d1; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                        Indirizzo Email
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                           style="width: 100%; padding: 12px 16px; background-color: #2c3e50; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #ffffff; font-size: 0.95rem; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#ffffff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'" />
                    
                    @if($errors->has('email'))
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 6px; font-weight: 500;">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; color: #b2c2d1; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                        Password
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           style="width: 100%; padding: 12px 16px; background-color: #2c3e50; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #ffffff; font-size: 0.95rem; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#ffffff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'" />
                    
                    @if($errors->has('password'))
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 6px; font-weight: 500;">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="password_confirmation" style="display: block; color: #b2c2d1; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                        Conferma Password
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           style="width: 100%; padding: 12px 16px; background-color: #2c3e50; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #ffffff; font-size: 0.95rem; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#ffffff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'" />
                    
                    @if($errors->has('password_confirmation'))
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 6px; font-weight: 500;">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>

                {{-- AZIONI DI LOG-IN / REGISTRAZIONE --}}
                <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 30px;">
                    <a href="{{ route('login') }}" 
                       style="color: #b2c2d1; text-decoration: none; font-size: 0.85rem; transition: color 0.2s;"
                       onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#b2c2d1'">
                        Già registrato? Accedi
                    </a>

                    <button type="submit" 
                            style="padding: 12px 30px; background-color: #2d3d4a; color: #ffffff; border: 2px solid #ffffff; border-radius: 25px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: transform 0.1s, box-shadow 0.2s;"
                            onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.3)'" 
                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">
                        Registra
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
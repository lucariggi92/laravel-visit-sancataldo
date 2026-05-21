@extends("layouts.master")

@section('title', 'Modifica Mood')

@section('contenuto')

<div class="bg-light min-vh-100 py-5">
    <div class="container" style="max-width: 850px;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-uppercase tracking-wide m-0" style="color: #2d3d4a; font-size: 1.8rem;">
                    Modifica Mood
                </h1>
                <p class="text-muted small m-0 mt-1">Stai modificando: <strong style="color: #2d3d4a;">{{ $mood->name }}</strong></p>
            </div>
            <a href="{{ route('admin.moods.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-pill fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Annulla
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4 p-md-5 bg-white">
                
                <form action="{{ route('admin.moods.update', $mood) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="name" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Nome Mood</label>
                        <input type="text" name="name" id="name" class="form-control border-2" value="{{ $mood->name }}" required style="border-radius: 8px; height: 45px;">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn text-white fw-bold text-uppercase px-5 py-3 shadow-sm border-0" 
                                style="background-color: #2d3d4a; border-radius: 8px; letter-spacing: 1px; font-size: 0.9rem;">
                            <i class="bi bi-arrow-repeat me-2"></i> Aggiorna Mood
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
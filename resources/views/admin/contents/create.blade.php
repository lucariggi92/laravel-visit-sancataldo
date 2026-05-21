@extends("layouts.master")

@section("title", "Aggiungi un contenuto")

@section("contenuto")

<div class="bg-light min-vh-100 py-5">
    <div class="container" style="max-width: 850px;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-uppercase tracking-wide m-0" style="color: #2d3d4a; font-size: 1.8rem;">
                    Nuovo Contenuto
                </h1>
                <p class="text-muted small m-0 mt-1">Inserisci i dettagli per creare un nuovo punto di interesse o attività.</p>
            </div>
            <a href="{{ route('admin.contents.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-pill fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Annulla
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4 p-md-5 bg-white">
                
                <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="title" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Titolo del Contenuto</label>
                            <input type="text" name="title" id="title" class="form-control border-2" placeholder="Es. Chiesa Madre" required style="border-radius: 8px; height: 45px;">
                        </div>

                        <div class="col-md-6 mt-3 mt-md-0">
                            <label for="category_id" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Categoria</label>
                            <select name="category_id" id="category_id" class="form-select border-2" style="height: 45px; border-radius: 8px;" required>
                                <option value="" selected disabled>Scegli una categoria...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="time_needed_visiting" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Tempo attività</label>
                            <div class="input-group border-2 rounded" style="border-radius: 8px;">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-clock"></i></span>
                                <input type="number" id="time_needed_visiting" name="time_needed_visiting" class="form-control border-start-0" placeholder="Es. 30" min="1" required style="height: 45px;">
                                <span class="input-group-text bg-light text-muted">min</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3 mt-md-0">
                            <label class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Mood / Tag</label>
                            <div class="border-2 form-control" style="border-radius: 8px; height: auto; padding: 10px 15px;">
                                @foreach($moods as $mood)
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            name="moods[]" 
                                            value="{{ $mood->id }}" 
                                            id="mood_{{ $mood->id }}">
                                        <label class="form-check-label text-uppercase fw-semibold small" for="mood_{{ $mood->id }}">
                                            {{ $mood->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    <div class="mb-5">
                        <label for="description" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Descrizione Estesa</label>
                        <textarea name="description" id="description" class="form-control border-2" rows="6" placeholder="Scrivi qui una descrizione dettagliata del luogo o dell'attività..." required style="border-radius: 8px; resize: none;"></textarea>
                    </div>

                  <div class="mb-5">
                        <label for="image" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Inserisci immagine</label>
                    <input type="file" name="image" id="image" class="form-control border-2" style="border-radius: 8px; line-height: 30px;">
                   </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn text-white fw-bold text-uppercase px-5 py-3 shadow-sm border-0" 
                                style="background-color: #2d3d4a; border-radius: 8px; letter-spacing: 1px; font-size: 0.9rem;">
                       Salva Contenuto
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
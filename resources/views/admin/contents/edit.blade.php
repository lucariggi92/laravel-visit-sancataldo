@extends("layouts.master")

@section("title", "Modifica contenuto")

@section("contenuto")


<div class="bg-light min-vh-100 py-5">
    <div class="container" style="max-width: 850px;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-uppercase tracking-wide m-0" style="color: #2d3d4a; font-size: 1.8rem;">
                    Modifica Contenuto
                </h1>
                <p class="text-muted small m-0 mt-1">Modifica i dettagli del punto di interesse o attività.</p>
            </div>
            <a href="{{ route('admin.contents.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-pill fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Annulla
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4 p-md-5 bg-white">
                
                <form action="{{ route('admin.contents.update', $content) }}" method="POST">
                    @csrf
                    @method("PUT")

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="title" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Titolo del Contenuto</label>
                            <input type="text" name="title" id="title" class="form-control border-2" placeholder="Es. Chiesa Madre" required style="border-radius: 8px; height: 45px;" value="{{$content->title}}">
                        </div>

                        <div class="col-md-6 mt-3 mt-md-0">
                            <label for="category_id" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Categoria</label>
                            <select name="category_id" id="category_id" class="form-select border-2" style="height: 45px; border-radius: 8px;" required>
                                <option value="" selected disabled>Scegli una categoria...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"{{$category->id == $content->category_id? "selected" : ""}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="time_needed_visiting" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Tempo attività</label>
                            <div class="input-group border-2 rounded" style="border-radius: 8px;">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-clock"></i></span>
                                <input type="number" id="time_needed_visiting" name="time_needed_visiting" class="form-control border-start-0" placeholder="Es. 30" min="1" required style="height: 45px;" value="{{$content->time_needed_visiting}}">
                                <span class="input-group-text bg-light text-muted">min</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3 mt-md-0">
                            <label for="mood_tag" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Mood / Tag</label>
                            <div class="input-group border-2 rounded" style="border-radius: 8px;">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-hash"></i></span>
                                <select name="mood_tag" id="mood_tag" class="form-select border-start-0" style="height: 45px;" required >
                                    <option value="" selected disabled>Scegli il mood...</option>
                                    <option value="curioso" {{ $content->mood_tag == 'curioso' ? 'selected' : '' }}>CURIOSO</option>
                                    <option value="affamato" {{ $content->mood_tag == 'affamato' ? 'selected' : '' }}>AFFAMATO</option>
                                    <option value="avventuriero" {{ $content->mood_tag == 'avventuriero' ? 'selected' : '' }}>AVVENTURIERO</option>
                                    <option value="rilassato" {{ $content->mood_tag == 'rilassato' ? 'selected' : '' }}>RILASSATO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="description" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Descrizione Estesa</label>
                        <textarea name="description" id="description" class="form-control border-2" rows="6" placeholder="Scrivi qui una descrizione dettagliata del luogo o dell'attività..." required style="border-radius: 8px; resize: none;">{{$content->description}}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn text-white fw-bold text-uppercase px-5 py-3 shadow-sm border-0" 
                                style="background-color: #2d3d4a; border-radius: 8px; letter-spacing: 1px; font-size: 0.9rem;">
                            <i class="bi bi-cloud-check me-2"></i> Salva Contenuto
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
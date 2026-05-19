@extends("layouts.master")

@section('title', 'Modifica Categoria')

@section('contenuto')

<div class="bg-light min-vh-100 py-5">
    <div class="container" style="max-width: 850px;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-uppercase tracking-wide m-0" style="color: #2d3d4a; font-size: 1.8rem;">
                    Modifica Categoria
                </h1>
                <p class="text-muted small m-0 mt-1">Stai modificando i dettagli della categoria: <strong style="color: #2d3d4a;">{{ $category->name }}</strong></p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-pill fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Annulla
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4 p-md-5 bg-white">
                
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-5 align-items-end">
                        
                        <div class="col-md-8">
                            <label for="name" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Nome Categoria</label>
                            <input type="text" name="name" id="name" class="form-control border-2" value="{{ $category->name }}" required style="border-radius: 8px; height: 45px;">
                        </div>

                        <div class="col-md-4 mt-3 mt-md-0">
                            <label for="color" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Colore Identificativo</label>
                            <div class="d-flex align-items-center gap-2 border-2 form-control" style="border-radius: 8px; height: 45px; padding: 0.375rem 0.75rem;">
                         
                                <input type="color" name="color" id="color" class="form-control form-control-color border-0 p-0" value="{{ $category->color }}" title="Scegli un colore" style="width: 100%; height: 30px; cursor: pointer; border-radius: 4px;">
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn text-white fw-bold text-uppercase px-5 py-3 shadow-sm border-0" 
                                style="background-color: #2d3d4a; border-radius: 8px; letter-spacing: 1px; font-size: 0.9rem;">
                            <i class="bi bi-arrow-repeat me-2"></i> Aggiorna Categoria
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
@extends("layouts.master")

@section('title', $category->name)

@section('contenuto')

<div class="bg-light min-vh-100 py-5">
    <div class="container" style="max-width: 800px;">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-pill d-flex align-items-center fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Torna alla lista
            </a>
            
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm text-white px-3 py-2 d-flex align-items-center shadow-sm" 
               style="background-color: #5a6b7a; border-color: #5a6b7a; font-size: 0.85rem; border-radius: 6px; font-weight: 500;">
                <i class="bi bi-pencil me-1"></i> Modifica Categoria
            </a>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
            
            <div class="p-4 p-md-5 text-white shadow-inner" style="background-color: {{ $category->color }};">
                <span class="badge rounded px-3 py-1.5 fw-semibold text-uppercase mb-2" 
                      style="background-color: rgba(255, 255, 255, 0.25); color: #fff; font-size: 0.75rem; letter-spacing: 0.5px;">
                    <i class="bi bi-tag-fill me-1"></i> Area Tematica
                </span>
                <h1 class="fw-bold text-uppercase tracking-wide display-6 m-0 text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.15);">
                    {{ $category->name }}
                </h1>
            </div>

            <div class="card-body p-4 p-md-5 bg-white">
                <h5 class="fw-bold text-uppercase small tracking-wider mb-3" style="color: #2d3d4a;">Dettagli Tecnici</h5>
                
                <div class="d-flex align-items-center gap-3 bg-light p-3 rounded-3 border">
                    <div class="p-2 rounded bg-white border shadow-sm">
                        <i class="bi bi-palette-fill fs-4" style="color: {{ $category->color }};"></i>
                    </div>
                    <div>
                        <small class="text-uppercase block text-muted d-block font-monospace" style="font-size: 0.65rem; letter-spacing: 0.5px;">Codice Colore Esadecimale</small>
                        <strong class="font-monospace text-dark fs-5">{{ strtoupper($category->color) }}</strong>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
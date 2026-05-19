@extends("layouts.master")

@section("title", $content->title)

@section("contenuto")

<div class="bg-light min-vh-100 py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.contents.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-pill d-flex align-items-center fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Torna alla lista
            </a>

            <div class="d-flex gap-2">
                <a href="{{route("admin.contents.edit", $content)}}" class="btn btn-sm btn-warning text-white px-3 py-2 d-flex align-items-center shadow-sm" 
                  style="font-size: 0.85rem; border-radius: 6px; font-weight: 500;">
                   Modifica Contenuto
                </a>


                <button type="button" class="btn btn-sm btn-danger px-3 py-2 d-flex align-items-center shadow-sm" 
                style="font-size: 0.85rem; border-radius: 6px; font-weight: 500;"
                 data-bs-toggle="modal" data-bs-target="#exampleModal">
                Elimina
                </button>


                
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
            
            <div class="p-4 p-md-5 text-white" style="background-color: #2d3d4a;">
                <div class="mb-3">
                    <span class="badge rounded px-3 py-2 fw-semibold text-uppercase" 
                           style="background-color:  {{ $content->category->color }}; color: #fff; font-size: 0.8rem; letter-spacing: 0.5px;">
                        <i class="bi bi-folder2-open me-1"></i> {{ $content->category->name }}
                    </span>
                </div>
                <h1 class="fw-bold text-uppercase tracking-wide display-6 m-0">{{ $content->title }}</h1>
            </div>

            <div class="card-body p-4 p-md-5 bg-white">
                
                <div class="d-flex flex-wrap gap-4 pb-4 mb-4 border-bottom text-muted">
                    <div class="d-flex align-items-center fs-6">
                        <i class="bi bi-clock-history me-2 text-primary" style="color: #2d3d4a !important; font-size: 1.2rem;"></i>
                        <div>
                            <small class="text-uppercase block text-muted d-block" style="font-size: 0.7rem; letter-spacing: 0.5px;">Tempo di visita</small>
                            <span class="fw-bold text-dark">{{ $content->time_needed_visiting }} minuti</span>
                        </div>
                    </div>

                    <div class="d-none d-md-block border-start"></div>

                    <div class="d-flex align-items-center fs-6">
                        <i class="bi bi-hash me-1 text-primary" style="color: #2d3d4a !important; font-size: 1.3rem;"></i>
                        <div>
                            <small class="text-uppercase block text-muted d-block" style="font-size: 0.7rem; letter-spacing: 0.5px;">Mood / Tag</small>
                            <span class="fw-bold text-dark text-uppercase">{{ $content->mood_tag }}</span>
                        </div>
                    </div>
                </div>

                <div class="content-text text-secondary lh-lg" style="font-size: 1.1rem; max-width: 800px;">
                    <h5 class="fw-bold text-uppercase small tracking-wider mb-3" style="color: #2d3d4a;">Descrizione del Luogo</h5>
                    <p class="m-0 text-dark" style="text-align: justify; opacity: 0.85;">
                        {{ $content->description }}
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina il contenuto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Sei sicuro di voler eliminare <strong>{{ $content->title }}</strong>? L'operazione non è reversibile.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form action="{{route("admin.contents.destroy", $content)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-sm btn-danger px-3 py-2 d-flex align-items-center shadow-sm" 
                        style="font-size: 0.85rem; border-radius: 6px; font-weight: 500;" value="Elimina">
           

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
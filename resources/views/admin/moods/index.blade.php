@extends("layouts.master")

@section('title', 'Mood')

@section('contenuto')

<div class="bg-light min-vh-100 py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold text-uppercase m-0" style="color: #2d3d4a; font-size: 2rem;">
                    Gestione Mood
                </h1>
                <p class="text-muted small m-0 mt-1">Lista di tutti i mood disponibili.</p>
            </div>
            <a href="{{ route('admin.moods.create') }}" class="btn rounded-pill px-4 py-2 fw-semibold text-uppercase shadow-sm text-white border-0" 
               style="background-color: #2d3d4a; font-size: 0.85rem;">
                <i class="bi bi-plus-lg me-1"></i> Nuovo Mood
            </a>
        </div>
        
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="text-white" style="background-color: #2d3d4a;">
                        <tr>
                            <th class="ps-4 py-3 small fw-semibold text-uppercase">#</th>
                            <th class="py-3 small fw-semibold text-uppercase">Nome</th>
                            <th class="pe-4 py-3 small fw-semibold text-uppercase text-end">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($moods as $mood)
                        <tr>
                            <td class="ps-4 text-muted small">#{{ $mood->id }}</td>
                            <td class="fw-bold" style="color: #2d3d4a;">{{ $mood->name }}</td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.moods.edit', $mood) }}" 
                                       class="btn btn-sm btn-warning text-white border-0 shadow-sm" 
                                       style="font-size: 0.8rem; border-radius: 6px;">
                                        <i class="bi bi-pencil me-1"></i> Modifica
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger border-0 shadow-sm" 
                                            style="font-size: 0.8rem; border-radius: 6px;"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $mood->id }}">
                                        <i class="bi bi-trash me-1"></i> Elimina
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white py-3 border-0 border-top text-muted small text-end pe-4">
                Totale mood: <strong style="color: #2d3d4a;">{{ $moods->count() }}</strong>
            </div>
        </div>

    </div>
</div>

{{-- Modal elimina per ogni mood --}}
@foreach($moods as $mood)
<div class="modal fade" id="deleteModal{{ $mood->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $mood->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel{{ $mood->id }}">Elimina il mood</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler eliminare <strong>{{ $mood->name }}</strong>? L'operazione non è reversibile.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form action="{{ route('admin.moods.destroy', $mood) }}" method="POST">
            @csrf
            @method("DELETE")
            <input type="submit" class="btn btn-sm btn-danger px-3 py-2 d-flex align-items-center shadow-sm" 
                style="font-size: 0.85rem; border-radius: 6px; font-weight: 500;" value="Elimina">
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection
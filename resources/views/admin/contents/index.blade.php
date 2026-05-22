@extends("layouts.master")

@section("title", "Contenuti")

@section("contenuto")

<div class="bg-light min-vh-100 py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="fw-bold text-uppercase tracking-wide m-0" style="color: #2d3d4a; font-size: 2rem;">
            Gestione Contenuti
        </h1>
        <p class="text-muted small m-0 mt-1">
            Pannello di controllo per i testi e i media del portale. 
            <strong style="color: #2d3d4a;">{{ $contents->count() }} elementi totali</strong>
        </p>
    </div>
    <a href="{{route("admin.contents.create")}}" class="btn rounded-pill px-4 py-2 fw-semibold text-uppercase shadow-sm text-white border-0" 
       style="background-color: #2d3d4a; font-size: 0.85rem;">
        <i class="bi bi-plus-lg me-1"></i> Nuovo Contenuto
    </a>
</div>
        
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="text-white" style="background-color: #2d3d4a;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-semibold" style="letter-spacing: 0.5px;">Titolo</th>
                            <th class="py-3 text-uppercase small fw-semibold" style="letter-spacing: 0.5px;">Descrizione</th>
                            <th class="py-3 text-uppercase small fw-semibold" style="letter-spacing: 0.5px;">Categoria</th>
                            <th class="py-3 text-uppercase small fw-semibold" style="letter-spacing: 0.5px;">Mood</th>
                            <th class="py-3 text-uppercase small fw-semibold" style="letter-spacing: 0.5px;">Tempo</th>
                            <th class="pe-4 py-3 text-uppercase small fw-semibold text-end" style="letter-spacing: 0.5px;">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contents as $content)
                        <tr>
                            <td class="ps-4 fw-bold" style="color: #2d3d4a;">{{ $content->title }}</td>
                            
                            <td class="text-secondary small">{{ Str::limit($content->description, 50) }}</td>
                            
                            <td>
                                <span class="badge rounded px-2 py-1.5 fw-medium text-uppercase btn-sm" 
                                      style="background-color:  {{ $content->category->color }}; font-size: 0.75rem;">
                                    {{ $content->category->name }}
                                </span>
                            </td>
                            
                            <td>
                                @foreach($content->moods as $mood)
                                    <span class="badge rounded px-2 py-1 me-1 fw-medium text-uppercase"
                                        style="background-color: #2d3d4a; font-size: 0.7rem;">
                                        {{ $mood->name }}
                                    </span>
                                @endforeach
                            </td>
                            
                            <td class="text-nowrap small text-dark">
                                <i class="bi bi-clock text-muted me-1"></i> {{ $content->time_needed_visiting }} min
                            </td>
                            
                          <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-sm text-white px-3 py-1.5 d-flex align-items-center border-0 shadow-sm" 
                                       style="background-color: #2d3d4a; font-size: 0.8rem; border-radius: 6px;" href="{{ route("admin.contents.show", $content->id) }}">
                                        Visualizza
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer bg-white py-3 border-0 border-top text-muted small text-end pe-4">
                Totale elementi: <strong style="color: #2d3d4a;">{{ $contents->count() }}</strong>
            </div>
        </div>

    </div>
</div>

@endsection
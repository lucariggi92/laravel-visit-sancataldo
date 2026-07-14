@extends("layouts.master")

@section("title", "itinerari")

{{-- Definiamo lo stile FUORI dalle sezioni principali se il master non ha i push, oppure forziamolo qui --}}
<style>
    /* Selettori ad altissima specificità per sovrascrivere Bootstrap 5 */
    .custom-pagination-wrapper .pagination .page-item .page-link {
        color: #2d3d4a !important;
        background-color: #ffffff !important;
        border-color: #dee2e6 !important;
    }

    /* Pagina Attiva */
    .custom-pagination-wrapper .pagination .page-item.active .page-link {
        background-color: #2d3d4a !important;
        border-color: #2d3d4a !important;
        color: #ffffff !important;
    }

    /* Hover */
    .custom-pagination-wrapper .pagination .page-item .page-link:hover {
        color: #ffffff !important;
        background-color: #1a252f !important;
        border-color: #1a252f !important;
    }

    /* Disabilitato */
    .custom-pagination-wrapper .pagination .page-item.disabled .page-link {
        color: #6c757d !important;
        background-color: #f8f9fa !important;
        border-color: #dee2e6 !important;
    }

    /* Rimuove l'effetto azzurro nativo di Bootstrap al click */
    .custom-pagination-wrapper .pagination .page-link:focus {
        box-shadow: 0 0 0 0.25rem rgba(45, 61, 74, 0.25) !important;
    }

    /* Fix per la sovrapposizione e la responsività */
    .custom-pagination-wrapper nav {
        width: 100%;
    }
    
    .custom-pagination-wrapper nav > div:first-child {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
</style>

@section("contenuto")

<div class="bg-light min-vh-100 py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold text-uppercase m-0" style="color: #2d3d4a; font-size: 2rem;">
                    Gestione Itinerari
                </h1>
                <p class="text-muted small m-0 mt-1">Lista di tutti gli itinerari generati.</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="text-white" style="background-color: #2d3d4a;">
                        <tr>
                            <th class="ps-4 py-3 small fw-semibold text-uppercase">Titolo</th>
                            <th class="py-3 small fw-semibold text-uppercase">Descrizione</th>
                            <th class="py-3 small fw-semibold text-uppercase">Contenuti</th>
                            <th class="py-3 small fw-semibold text-uppercase">Tempo Totale</th>
                            <th class="py-3 small fw-semibold text-uppercase">Food</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($itineraries as $itinerary)
                        <tr>
                            <td class="ps-4 fw-bold" style="color: #2d3d4a;">{{ $itinerary->title }}</td>
                            <td class="text-secondary small">{{ Str::limit($itinerary->description, 50) }}</td>
                            <td>
                                @foreach($itinerary->contents as $content)
                                    <span class="badge rounded px-2 py-1 me-1"
                                          style="background-color: {{ $content->category->color }}; font-size: 0.75rem;">
                                        {{ $content->title }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="small text-dark">
                                <i class="bi bi-clock text-muted me-1"></i>
                                {{ $itinerary->contents->sum('time_needed_visiting') }} min
                            </td>
                            <td>
                                @php $food = $itinerary->contents->whereNotNull('food_type')->first() @endphp
                                @if($food)
                                    <span class="badge bg-warning text-dark">{{ $food->title }}</span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Nessun itinerario presente.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white py-3 border-0 border-top text-muted small text-end pe-4">
                Totale itinerari: <strong style="color: #2d3d4a;">{{ $itineraries->total() }}</strong>
            </div>

            {{-- Risolto il problema di sovrapposizione qui --}}
            <div class="d-flex justify-content align-items-center py-3 px-4 bg-white border-0 custom-pagination-wrapper">
                {{ $itineraries->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
</div>

@endsection
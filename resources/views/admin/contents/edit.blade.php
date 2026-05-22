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


        <!-- CASELLA FORM----------------------- -->
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4 p-md-5 bg-white">
                


                <form action="{{ route('admin.contents.update', $content) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")



                    <div class="row mb-4">

                        <!-- TITOLO----------------------- -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="title" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Titolo del Contenuto</label>
                                <input type="text" name="title" id="title" class="form-control border-2" placeholder="Es. Chiesa Madre" required style="border-radius: 8px; height: 45px;" value={{$content->title}}>
                            </div>

                            <div class="col-md-6 mt-3 mt-md-0">
                                <label for="category_id" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Categoria</label>
                                <select name="category_id" id="category_id" class="form-select border-2" style="height: 45px; border-radius: 8px;" required>
                                    <option value="" disabled>Scegli una categoria...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $content->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    
                        {{-- Campo food_type visibile solo se categoria è Food & Drink -------------------}}
                       {{-- nascosto di default --}}
                    <div class="row mb-4" id="food_type_wrapper">
                        <div class="col-md-6 ms-auto">
                            <label for="food_type" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Tipo di cibo</label>
                            <select name="food_type" id="food_type" class="form-select border-2" style="height: 45px; border-radius: 8px;">
                                <option value="" disabled {{ !$content->food_type ? 'selected' : '' }}>Scegli il tipo...</option>
                                <option value="colazione" {{ $content->food_type == 'colazione' ? 'selected' : '' }}>☕ Colazione</option>
                                <option value="aperitivo" {{ $content->food_type == 'aperitivo' ? 'selected' : '' }}>🍹 Aperitivo</option>
                                <option value="pranzo" {{ $content->food_type == 'pranzo' ? 'selected' : '' }}>🍝 Pranzo</option>
                                <option value="cena" {{ $content->food_type == 'cena' ? 'selected' : '' }}>🍽️ Cena</option>
                                <option value="mordi e fuggi" {{ $content->food_type == 'mordi e fuggi' ? 'selected' : '' }}>🥪 Mordi e fuggi</option>
                            </select>
                        </div>
                    </div>




                    <div class="row mb-4">

                         <!-- TEMPO----------------------- -->
                        <div class="col-md-6">
                            <label for="time_needed_visiting" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Tempo attività</label>
                            <div class="input-group border-2 rounded" style="border-radius: 8px;">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-clock"></i></span>
                                <input type="number" id="time_needed_visiting" name="time_needed_visiting" class="form-control border-start-0" placeholder="Es. 30" min="1" required style="height: 45px;" value="{{$content->time_needed_visiting}}">
                                <span class="input-group-text bg-light text-muted">min</span>
                            </div>
                        </div>


                          <!-- MOOD----------------------- -->
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
                                            id="mood_{{ $mood->id }}"
                                            {{ $content->moods->contains($mood->id) ? 'checked' : '' }}>
                                        <label class="form-check-label text-uppercase fw-semibold small" for="mood_{{ $mood->id }}">
                                            {{ $mood->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>



                   <!-- DESCRIZIONE----------------------- -->
                    <div class="mb-5">
                        <label for="description" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Descrizione Estesa</label>
                        <textarea name="description" id="description" class="form-control border-2" rows="6" placeholder="Scrivi qui una descrizione dettagliata del luogo o dell'attività..." required style="border-radius: 8px; resize: none;">{{$content->description}}</textarea>
                    </div>



                    <!-- IMMAGINE----------------------- -->
                    <div class="mb-5">
                        <label for="image" class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Inserisci immagine</label>
                    <input type="file" name="image" id="image" class="form-control border-2" style="border-radius: 8px; line-height: 30px;">

                      @if($content->image)
                        <div id="post-image">
                            <img src="{{asset("storage/" . $content->image)}}" alt="{{ $content->title }}">
                        </div>
                      @endif

                    </div>

                    
                      
                    <!-- SALVA----------------------- -->
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



<script>
    function toggleFoodType(isOnLoad = false) {
        const categorySelect = document.getElementById('category_id');
        const foodWrapper = document.getElementById('food_type_wrapper');
        const selectedText = categorySelect.options[categorySelect.selectedIndex].text;

        if (selectedText === 'Food & Drink') {
            foodWrapper.style.display = 'block';
            if (!isOnLoad) {
                document.getElementById('food_type').value = '';
            }
        } else {
            foodWrapper.style.display = 'none';
            document.getElementById('food_type').value = '';
        }
    }

    document.getElementById('category_id').addEventListener('change', () => toggleFoodType(false));

    // aspetta che il DOM sia completamente caricato
    document.addEventListener('DOMContentLoaded', () => toggleFoodType(true));
</script>


@endsection
@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1>Editar Noticia</h1>
        
        @if(request()->comes_from)
            <div class="row d-flex flex-row flex-row-reverse mr-3">
                <a href="{{ route(request()->comes_from, ['id' => $news->id, 'title' => formate_title_url($news->title)]) }}" class="btn btn-outline-secondary width-fit-content me-3">
                    <i class="fas fa-arrow-left pr-1"></i>
                    Volver a la noticia
                </a>
            </div>
        @else
            <div class="row d-flex flex-row flex-row-reverse mr-3">
                <a href="{{ route('news.index') }}" class="btn btn-outline-secondary width-fit-content me-3">
                    <i class="fas fa-arrow-left pr-1"></i>
                    Volver
                </a>
            </div>
        @endif
    </div>
    
    
    <div class="container">
        <div class="card card-body">
            <form method="POST" action="{{ route('news.update', ['news' => $news->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Titulo</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $news->title }}" required autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="content" class="col-md-4 col-form-label text-md-right">Contenido</label>

                    <div class="col-md-6">
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" cols="30" required rows="10">{{ old('content') ?? $news->content }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
                    <div id="container_image_path" class="col-md-6">
                        <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" value="{{ old('image_path') }}">
                        @error('image_path')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="col-md-1 mt-1 col-sm-12" id="container_image_preview">
                        <div class="d-flex flex-row justify-content-center">
                            @if ($news->image_path)
                                @if ($news->image_path != null)
                                    <img id="news_image_saved" class="img-fluid" src="{{ route('get.image', ['filename' => $news->image_path, 'disk' => 'news']) }}">
                                @endif
                                <img id="image_path_preview" class="img-fluid rounded">
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group row mb-3 mb-0">
                    
                    @if(request()->comes_from)
                        <div class="col-md-3 offset-md-4 mb-1">
                            <input type="text" name="comes_from" value="front-news.show" hidden>
                            <button type="submit" class="btn btn-outline-success">
                                Actualizar y volver a la noticia
                            </button>
                        </div>
                    @else
                        <div class="col-md-3 offset-md-4 mb-1">
                            <button type="submit" class="btn btn-success">
                                Actualizar
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Obtener referencia al input y a la imagen

        const $seleccionArchivos = document.querySelector("#image_path"),
        $image_path_preview = document.querySelector("#image_path_preview");
        container_image_path = document.querySelector("#container_image_path");
        news_image_saved = document.querySelector("#news_image_saved");

        // Escuchar cuando cambie
        $seleccionArchivos.addEventListener("change", () => {

            // Resize container image_path
            container_image_path.classList.remove("col-md-6");
            container_image_path.classList.add("col-md-5");

            // Hide image replaced
            news_image_saved.classList.add('d-none');

            // Los archivos seleccionados, pueden ser muchos o uno
            const archivos = $seleccionArchivos.files;
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                $image_path_preview.src = "";
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            const primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            $image_path_preview.src = objectURL;
        });
    </script>
@endsection
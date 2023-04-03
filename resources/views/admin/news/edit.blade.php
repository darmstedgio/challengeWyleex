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
            <form method="POST" action="{{ route('news.update', ['news' => $news->id]) }}">
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
    
@endsection
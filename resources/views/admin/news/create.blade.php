@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1>Nueva Noticia</h1>
        <div class="row d-flex flex-row flex-row-reverse mr-3">
            <a href="{{ route('news.index') }}" class="btn btn-outline-secondary width-fit-content me-3">
                <i class="fas fa-arrow-left pr-1"></i>
                Volver
            </a>
        </div>
    </div>
    
    
    <div class="container">
        <div class="card card-body">
            <form method="POST" action="{{ route('news.store') }}">
                @csrf

                <div class="form-group row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Titulo</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

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
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" cols="30" required rows="10">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3 mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Crear
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
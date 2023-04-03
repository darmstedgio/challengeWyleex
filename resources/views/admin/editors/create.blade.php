@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1>Nuevo Editor</h1>
        <div class="row d-flex flex-row flex-row-reverse mr-3">
            <a href="{{ route('editors.index') }}" class="btn btn-outline-secondary width-fit-content me-3">
                <i class="fas fa-arrow-left pr-1"></i>
                Volver
            </a>
        </div>
    </div>
    
    
    <div class="container">
        <div class="card card-body">
            <form method="POST" action="{{ route('editors.store') }}">
                @csrf

                <div class="form-group row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre y apellido</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3 mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
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
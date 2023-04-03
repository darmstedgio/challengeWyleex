@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1>¡Bienvenido {{ Auth::user()->name }}!</h1>
        <h6>Te mostramos algunas estadisticas...</h6>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <div class="row d-flex justify-content-center">
                    <div class="card text-white bg-primary mb-3" style="width: 18rem;">
                        <div class="card-header">Cantidad de Lectores</div>
                        <div class="card-body">
                            <h2 class="card-title text-center" style="font-size: 4rem">
                                <i class="fa-solid fa-book-open-reader"></i>
                                {{ $statics['readers_qty'] }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row d-flex justify-content-center">
                    <div class="card text-white bg-secondary mb-3" style="width: 18rem;">
                        <div class="card-header">Cantidad de noticias publicadas</div>
                        <div class="card-body">
                            <h2 class="card-title text-center" style="font-size: 4rem">
                                <i class="fa-solid fa-newspaper"></i>
                                {{ $statics['news_qty'] }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Editors qty and total readed news --}}
        <div class="row">
            <div class="col-md-6">
                <div class="row d-flex justify-content-center">
                    <div class="card text-white bg-primary mb-3" style="width: 18rem;">
                        <div class="card-header">Cantidad de Redactores</div>
                        <div class="card-body">
                            <h2 class="card-title text-center" style="font-size: 4rem">
                                <i class="fa-solid fa-pen-nib"></i>
                                {{ $statics['editors_qty'] }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row d-flex justify-content-center">
                    <div class="card text-white bg-secondary mb-3" style="width: 18rem;">
                        <div class="card-header">Total de noticias leídas</div>
                        <div class="card-body">
                            <h2 class="card-title text-center" style="font-size: 4rem">
                                <i class="fa-brands fa-readme"></i>
                                {{ $statics['total_readed_news'] }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
@endsection

@section('scripts')
    
@endsection
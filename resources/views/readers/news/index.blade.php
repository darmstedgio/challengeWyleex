@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6 col-4 m-auto">
                    <img class="img-fluid" src="{{ asset('assets/images/user-1.png') }}" alt="">
                </div>
            </div>
            <h3 class="text-center">¡Bienvenido {{ Auth::user()->name }}!</h3>
            <p class="mt-5">
                Nos alegramos tenerte de vuelta.
                Tenemos todas estas noticias nuevas para vos...
            </p>
        </div>
        {{-- Preview News --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Últimas Noticias
                </div>
                <div class="card-body">
                    @forelse ($news as $item)
                    <a class="text-decoration-none text-dark " href="{{ route('front-news.show', ['id' => $item->id, 'title' => formate_title_url($item->title)]) }}">
                        <div class="card my-1 w-100 cursor-pointer mb-3 highlight-element">
                            <div class="card-body py-2">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text mb-1">
                                    {{ substr($item->content, 0, 100) }}...
                                </p>
                                <div class="row text-muted ">
                                    <div class="col-6">
                                        {{ \Carbon\Carbon::parse($item->datetime)->format('d/m/Y') }}
                                        ( {{ \Carbon\Carbon::parse($item->datetime)->diffForHumans() }} )
                                    </div>
                                    <div class="col-6 text-end">
                                        <i>
                                            Redactado por 
                                            <b>{{ $item->author }}</b>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                        
                    @empty
                        No hay noticias cargadas
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1>Lista de Lectores</h1>
        
    </div>

    <div class="container responsive-tables">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Lector</th>
                <th scope="col">Email</th>
                <th scope="col">Fecha de suscripción</th>
                <th scope="col">Noticias Leidas</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($readers as $item)
                <tr class="{{ ($loop->index % 2 != 0) ? 'bg-gray-100' : '' }} highlight-element">
                    {{-- Title --}}
                    <td>
                        {{ $item->name . ' ' . $item->reader->last_name }}
                    </td>

                    <td>
                        {{ $item->email }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                    </td>
    
                    {{-- News readed --}}
                    <td class="text-center">
                        {{ $item->reader->reader_news_qty() ? $item->reader->reader_news_qty() : 0 }}
                    </td>
                </tr>
              @endforeach
              
            </tbody>
        </table>
        {{ $readers->links() }}
    </div>
@endsection

@section('scripts')
    
@endsection
@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1>Lista de Noticias</h1>
        <div class="row d-flex flex-row flex-row-reverse mr-3">
            <a class="btn btn-primary text-end width-fit-content me-3" href="{{ route('news.create') }}">
                <i class="fas fa-plus"> </i>
                Crear Noticia
            </a>
        </div>
    </div>

    <div class="container responsive-tables">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Autor</th>
                <th scope="col">Lectores</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($news as $item)
                <tr class="{{ ($loop->index % 2 != 0) ? 'bg-gray-100' : '' }} highlight-element">
                    {{-- Title --}}
                    <td>
                        {{-- sub_string_titles: Helper substring.. from 0 to 50 --}}
                        {{ sub_string_titles($item->title) }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->datetime)->format('d/m/Y H:i') }}hs
                    </td>
    
                    {{-- Author --}}
                    <td>
                        {{ $item->author }}
                    </td>
    
                    {{-- Views --}}
                    <td class="text-center">
                        {{ $item->views_number() }}
                    </td>
    
                    {{-- Accions --}}
                    <td>
                        <div class="row">
                            <div class="col-1 mx-2">
                                <a class="btn btn-sm btn-success" href="{{ route('news.edit', ['news' => $item->id]) }}">
                                    <i class="fas fa-pencil"></i>
                                </a>
                            </div>
                            <div class="col-1 mx-2">
                                <form action="{{ route('news.destroy', ['news' => $item->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas seguro que deseas borrar la noticia: < {{ $item->title }} > ?')" >
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                    
                </tr>
              @endforeach
              
            </tbody>
        </table>
        {{ $news->links() }}
    </div>
@endsection

@section('scripts')
    
@endsection
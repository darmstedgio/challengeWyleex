@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1>Lista de Redactores</h1>
        <div class="row d-flex flex-row flex-row-reverse mr-3">
            <a class="btn btn-primary text-end width-fit-content me-3" href="{{ route('editors.create') }}">
                <i class="fas fa-plus"> </i>
                Crear Redactor
            </a>
        </div>
    </div>

    <div class="container responsive-tables">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Noticias Redactadas</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Cantidad total de veces que fueron leidas las noticias de cada redactor">
                    Lectores
                    <i class="fas fa-circle-info cursor-pointer"></i>
                </th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($editors as $item)
                <tr class="{{ ($loop->index % 2 != 0) ? 'bg-gray-100' : '' }} highlight-element">
                    {{-- Title --}}
                    <td>
                        {{ $item->name }}
                    </td>

                    <td>
                        {{ $item->email }}
                    </td>
    
                    {{-- Views --}}
                    <td class="text-center">
                        {{ $item->redacted_news() }}
                    </td>

                    {{-- Readers --}}
                    <td class="text-center">
                        {{ $item->views_number_per_editor() }}
                    </td>
    
                    {{-- Accions --}}
                    <td>
                        @if (Auth::user()->id == 1)
                            <div class="row">
                                <div class="col-1 mx-2">
                                    <a class="btn btn-sm btn-success" href="{{ route('editors.edit', ['editor' => $item->id]) }}">
                                        <i class="fas fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="col-1 mx-2">
                                    @if (Auth::user()->id != $item->id)
                                        <form action="{{ route('editors.destroy', ['editor' => $item->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas seguro que deseas borrar el editor: < {{ $item->name }} > ?')" >
                                                <i class="fas fa-trash"></i> 
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </td>
                    
                </tr>
              @endforeach
              
            </tbody>
        </table>
        {{ $editors->links() }}
    </div>
@endsection

@section('scripts')
    
@endsection
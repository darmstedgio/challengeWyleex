@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row-reverse my-3 text-end">
        @if (Auth::user()->role == 'ADMIN')
            <a href="{{ route('news.edit', ['news' => $news_selected, 'comes_from' => 'front-news.show']) }}" class="btn btn-success">
                <i class="fas fa-pencil pr-1"></i>
            </a>
        @endif
        <a href="{{ route('front-news.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left pr-1"></i>
            Volver
        </a>
    </div>
    <div class="row justify-content-center">
        {{-- Show News --}}
        <div class="col-md-9">
            <h1>
                {{ $news_selected->title }}
            </h1>
            <div class="row mt-3 mb-5">
                <div class="col-6">
                    {{ \Carbon\Carbon::parse($news_selected->datetime)->format('d/m/Y') }}
                </div>
                <div class="col-6 text-end">
                    <i>
                        Escrito por {{ $news_selected->author }} 
                    </i>
                </div>
            </div>
            {{-- Image --}}
            <div class="my-4 " id="container_image_preview">
                <div class="d-flex flex-row justify-content-center">
                    @if ($news_selected->image_path)
                        @if ($news_selected->image_path != null)
                            <img id="news_image_saved" class="img-fluid" src="{{ route('get.image', ['filename' => $news_selected->image_path, 'disk' => 'news']) }}" alt="{{ substr($news_selected->image_path, 10) }}">
                        @endif
                    @endif
                </div>
            </div>
            <p>
                {{-- Break line --}}
                <?php foreach (explode("\n", $news_selected->content) as $line) { ?>
                    {{$line}}<br />
                <?php } ?>
            </p>
        </div>

        {{-- News recomended --}}
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">También te puede interesar</div>
                <div class="card-body">
                    @foreach ($news as $item)
                        <a class="text-decoration-none text-dark" href="{{ route('front-news.show', ['id' => $item->id, 'title' => formate_title_url($item->title)]) }}">
                            <div class="card my-2 py-1 position-relative highlight-element">
                                <div class="position-absolute" style="top:5px; right:5px;">
                                    <h5 class="text-primary display-inline" >
                                        {{ ($loop->index + 1) }}
                                    </h5>
                                </div>
                                <div class="card-body py-1">
                                    {{ strlen($item->title) > 70 ? substr($item->title, 0, 70) . '...' : $item->title }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
@endsection
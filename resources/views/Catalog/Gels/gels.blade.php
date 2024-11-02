@extends('layouts.layout')
@extends('header')
@section('title', 'Гели | ShaR')
@section('content')
    {{--<img src="{{URL('./storage/img/itismuse.jpg')}}" style="width: 100%; height: 400px;" alt="...">--}}
    <div class="container">
        <nav class="mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Гели</li>
            </ol>
        </nav>
        <div class="d-flex flex-column justify-content-around align-items-center mt-5 mb-4 wrap-md-4">
            <div class="card mb-3" style="max-width: 1040px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://avatars.mds.yandex.net/i?id=5dfac37c5c2fccdb98c4c4bdb5dbc5cd_l-8495786-images-thumbs&n=13" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <p class="card-text">Это более широкая карточка с вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту. Этот контент немного длиннее.</p>
                            <p class="card-text"><small class="text-body-secondary">Последнее обновление 3 мин. назад</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-around align-items-center mt-5 mb-4 wrap-md-4">
            @foreach($data as $gels)
                <div class="card h-100 mb-4" style="width: 19rem;">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $gels['image'] }}" class="card-img-top w-50" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$gels['name']}}</h5>
                        <div class="text-truncate text-wrap" style="height: 5rem;">
                            <p class="card-text">{{$gels['description']}}</p>
                        </div>
                        <p class="card-text">Цена: {{$gels['price']}} руб.</p>
                        <a href="{{ url('catalog/gels') }}/{{ $gels['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@extends('footer')

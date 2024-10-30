@extends('layouts.layout')
@extends('header')
@section('title', 'Musses page')
@section('content')
    <img src="{{URL('./storage/img/itismuse.jpg')}}" style="width: 100%; height: 400px;" alt="...">
    <div class="container">
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
            @foreach($muses as $muse => $key)
                <div class="card h-100 mb-4" style="width: 19rem;">
                    <img src="https://avatars.mds.yandex.net/i?id=5dfac37c5c2fccdb98c4c4bdb5dbc5cd_l-8495786-images-thumbs&n=13" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$key['name']}}</h5>
                        <div style="height: 5rem;">
                            <p class="card-text">{{$key['description']}}</p>
                        </div>
                        <p class="card-text">Цена: {{$key['price']}} руб.</p>
                        <a href="{{ url('catalog/musses') }}/{{ $key['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
@extends('footer')

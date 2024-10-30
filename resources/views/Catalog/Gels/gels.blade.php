@extends('layouts.layout')
@extends('header')
@section('title', 'Gels page')
@section('content')
    <div class="d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4">
        @foreach($gels as $gel => $key)
            <div class="card" style="width: 18rem;">
                <img src="https://avatars.mds.yandex.net/i?id=5dfac37c5c2fccdb98c4c4bdb5dbc5cd_l-8495786-images-thumbs&n=13" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$key['name']}}</h5>
                    <p class="card-text">{{$key['description']}}</p>
                    <p class="card-text">Цена: {{$key['price']}} руб.</p>
                    <a href="#" class="btn btn-outline-danger">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@extends('footer')

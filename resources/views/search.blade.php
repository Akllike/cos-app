@extends('layouts.layout')
@extends('header')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="container d-flex flex-wrap mt-5">
            <h6>⚫ Результаты поиска</h6>
        </div>
        <div class="d-flex flex-wrap justify-content-around align-items-center mt-5 mb-4 wrap-md-4">
            @foreach($muses as $muse)
                <div class="card h-100 mb-4" style="width: 19rem;">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $muse['image'] }}" class="card-img-top w-50" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$muse['name']}}</h5>
                        <div class="text-truncate text-wrap" style="height: 5rem;">
                            <p class="card-text">{{$muse['description']}}</p>
                        </div>
                        <p class="card-text">Цена: {{$muse['price']}} руб.</p>
                        <a href="{{ url('catalog/gels') }}/{{ $muse['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                    </div>
                </div>
            @endforeach
            @foreach($gels as $gel)
                <div class="card h-100 mb-4" style="width: 19rem;">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $gel['image'] }}" class="card-img-top w-50" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$gel['name']}}</h5>
                        <div class="text-truncate text-wrap" style="height: 5rem;">
                            <p class="card-text">{{$gel['description']}}</p>
                        </div>
                        <p class="card-text">Цена: {{$gel['price']}} руб.</p>
                        <a href="{{ url('catalog/gels') }}/{{ $gel['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                    </div>
                </div>
            @endforeach
                @foreach($scrabs as $scrab)
                <div class="card h-100 mb-4" style="width: 19rem;">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $scrab['image'] }}" class="card-img-top w-50" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$scrab['name']}}</h5>
                        <div class="text-truncate text-wrap" style="height: 5rem;">
                            <p class="card-text">{{$scrab['description']}}</p>
                        </div>
                        <p class="card-text">Цена: {{$scrab['price']}} руб.</p>
                        <a href="{{ url('catalog/gels') }}/{{ $scrab['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

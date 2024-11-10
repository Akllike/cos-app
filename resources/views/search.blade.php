@extends('layouts.layout')
@extends('header')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="container d-flex flex-wrap mt-5">
            <h6>⚫ Результаты поиска</h6>
        </div>
        <div class="d-flex flex-wrap justify-content-around align-items-center mt-5 mb-4 wrap-md-4">
            @foreach($products as $item)
                <div class="card h-100 mb-4" style="width: 19rem;">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $item['image'] }}" class="card-img-top w-50" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$item['name']}}</h5>
                        <div class="text-truncate text-wrap" style="height: 5rem;">
                            <p class="card-text">{{$item['description']}}</p>
                        </div>
                        <p class="card-text">Цена: {{$item['price']}} руб.</p>
                        @if($item['category'] === 'muse')
                            <a href="{{ url('catalog/musses') }}/{{ $item['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                        @elseif($item['category'] === 'gel')
                            <a href="{{ url('catalog/gels') }}/{{ $item['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                        @elseif($item['category'] === 'scrab')
                            <a href="{{ url('catalog/scrabs') }}/{{ $item['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                        @elseif($item['category'] === 'oil')
                            <a href="{{ url('catalog/oils') }}/{{ $item['id'] }}" class="btn btn-outline-danger">Подробнее</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

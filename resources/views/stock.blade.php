@extends('layouts.layout')
@extends('header')
@section('title', 'В наличии | ShaR')
@section('content')
    <div class="container">
        <div class="container d-flex flex-wrap mt-4">
            <h6>⚫ Товар в наличии</h6>
        </div>
        <div class="container d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4 wrap-md-4">
            @if(sizeof($data) != 0)
                @foreach($data as $item)
                    <div class="card h-100 mb-4 shadow" data-id="{{$item['id']}}" style="width: 17rem;">
                        <div class="d-flex justify-content-center">
                            <img src="{{ $item['image'] }}" class="card-img-top w-50" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="height: 4rem;">{{$item['name']}}</h5>
                            <div class="text-truncate text-wrap" style="height:2rem;">
                                <p class="description text-truncate" style="font-size: 12px;" data-container="body" data-toggle="popover" data-placement="top" data-content="Lorem ipsum dolor sit amet. Suscipit laboriosam, nisi ut perspiciatis.">
                                    {{$item['description']}}</p>
                            </div>
                            <p class="card-text text-secondary mt-1">{{$item['price']}} руб. / {{ $item['volume'] }} мл</p>
                            <div class="d-flex justify-content-center">
                                @if($item['category'] === 'hair')
                                    <a href="{{ url('catalog/hairs') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
                                @elseif($item['category'] === 'face')
                                    <a href="{{ url('catalog/faces') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
                                @elseif($item['category'] === 'body')
                                    <a href="{{ url('catalog/bodies') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
                                @endif
                                <div class="m-1">
                                    <button type="button" class="btn btn-outline-dark border-2 add-cart" style="font-size: 14px">
                                        В корзину
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>К сожалению, на данный момент нет в наличии.</p>
            @endif
        </div>
    </div>
@endsection
@extends('modals')
@extends('footer')

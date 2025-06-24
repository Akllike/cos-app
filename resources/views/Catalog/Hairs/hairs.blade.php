@extends('layouts.layout')
@extends('header')
@section('title', 'Косметика для волос | ShaR')
@section('meta_description', 'Линейки косметики для ухаживания за волосами.')
@section('meta_url', route('hair.show'))
@section('link_canonical', route('hair.show'))
@section('content')
    {{--<img src="{{URL('./storage/img/itismuse.jpg')}}" style="width: 100%; height: 400px;" alt="...">--}}
    <div class="container">
        <nav class="mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="#">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Для волос</li>
            </ol>
        </nav>
        <div class="d-flex flex-wrap justify-content-around align-items-center mt-5 mb-4 wrap-md-4">
            @if(sizeof($data) != 0)
                @foreach($data as $item)
                    <div class="card h-100 mb-4 shadow" data-id="{{$item['id']}}" style="width: 17rem;">
                        <div class="d-flex justify-content-center">
                            <img src="{{ url($item['image']) }}" class="card-img-top w-75" style="height: 270px; object-fit: cover;" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="height: 4rem;"><a style="text-decoration: none; color: inherit;" href="{{ url('catalog/product') }}/{{ $item['id'] }}">{{$item['name']}}</a></h5>
                            <div class="text-truncate text-wrap" style="height:2rem;">
                                <p class="description text-truncate" style="font-size: 12px;" data-container="body" data-toggle="popover" data-placement="top" data-content="Lorem ipsum dolor sit amet. Suscipit laboriosam, nisi ut perspiciatis.">
                                    {{$item['description']}}</p>
                            </div>
                            <p class="card-text text-secondary mt-1">{{$item['price']}} руб. / {{ $item['volume'] }} мл</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ url('catalog/product') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
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

    <style>
        .overlay {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 15px;
            background-image: url({{ url('storage/img/hairs.webp') }});
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .overlay:before {
            content: '';
            border-radius: 15px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .text {
            position: relative;
            color: white;
            text-align: center;
            padding: 20px;
            z-index: 1;
        }
    </style>
@endsection
@extends('modals')
@extends('footer')

@extends('layouts.layout')
@extends('header')
@section('title', 'Гели | ShaR')
@section('content')
    {{--<img src="{{URL('./storage/img/itismuse.jpg')}}" style="width: 100%; height: 400px;" alt="...">--}}
    <div class="container">
        <nav class="mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="#">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Для лица</li>
            </ol>
        </nav>
        <div class="overlay" style="border-radius: 15px;">
            <div class="text" style="text-align: center">
                <h1 style="margin: 10px">Косметика для лица</h1>
                <p>Косметика для лица способствует улучшению внешнего вида и здоровья кожи, решая множество проблем, таких как сухость, жирность и воспаления. Увлажняющие средства помогают поддерживать оптимальный уровень влаги, а кремы с SPF защищают от вредного воздействия ультрафиолетовых лучей. Пилинги и маски способствуют удалению мертвых клеток и улучшают текстуру кожи, делая ее более гладкой и сияющей. Сыворотки и эссенции с активными ингредиентами целенаправленно борются с возрастными изменениями, пигментацией и другими несовершенствами.</p>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-around align-items-center mt-5 mb-4 wrap-md-4">
            @if(sizeof($data) != 0)
                @foreach($data as $item)
                    <div class="card h-100 mb-4" style="width: 19rem;" data-id="{{$item['id']}}">
                        <div class="d-flex justify-content-center">
                            <img src="{{ url($item['image']) }}" class="card-img-top w-50" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$item['name']}}</h5>
                            <div class="text-truncate text-wrap" style="height: 5rem;">
                                <p class="card-text">{{$item['description']}}</p>
                            </div>
                            <p class="card-text text-secondary mt-1">{{$item['price']}} руб. / {{ $item['volume'] }} мл</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ url('catalog/bodies') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
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
            background-image: url({{ url('storage/img/faces.jpg') }}); /* Укажите ваш URL изображения */
            background-size: cover;
            background-position: center;
            display: flex; /* Используем flexbox */
            justify-content: center; /* Центрируем по горизонтали */
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
            background-color: rgba(0, 0, 0, 0.5); /* Затемнение */
        }
        .text {
            position: relative;
            color: white; /* Цвет текста */
            text-align: center;
            padding: 20px;
            z-index: 1; /* Поверхность текста над затемнением */
        }
    </style>
@endsection
@extends('modals')
@extends('footer')

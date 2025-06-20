@extends('layouts/layout')
@extends('header')
@section('title', 'ShaR - Красота и Здоровье')
@section('content')
    <div class="container d-flex flex-column rounded-3" style="background-image: url({{ url('storage/img/bg-header.webp') }}); background-size: cover; background-position: center;">
        <div class="container mt-4 p-1 d-flex flex-wrap justify-content-between" style="height: 50vh;">
            <div class="d-flex">
                <a href="{{ url('catalog/hairs') }}" class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="{{ url('storage/img/11.jpg') }}" alt="">
                    <p class="badge" style="color: white">Волосы</p>
                </a>
                <a href="{{ url('catalog/faces') }}" class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="{{ url('storage/img/22.jpg') }}" alt="">
                    <p class="badge" style="color: white">Лицо</p>
                </a>
                <a href="{{ url('catalog/bodies') }}" class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="{{ url('storage/img/33.jpg') }}" alt="">
                    <p class="badge" style="color: white">Тело</p>
                </a>
                <a class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="{{ url('storage/img/44.webp') }}" alt="">
                    <p class="badge" style="color: white">Подборки</p>
                </a>
            </div>
            <div class="d-flex">
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="{{ url('storage/img/55.webp') }}" alt="">
                    <p class="badge" style="color: white">Скрабы</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="{{ url('storage/img/66.jpg') }}" alt="">
                    <p class="badge" style="color: white">Масла</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="{{ url('storage/img/77.webp') }}" alt="">
                    <p class="badge" style="color: white">Гели</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="{{ url('storage/img/88.png') }}" alt="">
                    <p class="badge" style="color: white">Муссы</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column m-2">
            <p class="mt-4 p-1" style="margin: 0; font-size: 14px; color: white">Мы заботимся о вас и вашей коже ❤</p>
            <h1 class="p-1" style="color: white">КОСМЕТИКА ВО <u>БЛАГО</u> КОЖЕ</h1>
        </div>
    </div>

    <div class="container d-flex flex-wrap mt-5">
        <h2>⚫ Популярные товары</h2>
    </div>

    <div class="container d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4 wrap-md-4">
        @foreach($data as $item)
            <div class="card h-100 mb-4 shadow" data-id="{{$item['id']}}" style="width: 17rem;">
                <div class="d-flex justify-content-center">
                    <img src="{{ url($item['image']) }}" class="card-img-top w-75" style="height: 270px; object-fit: cover;" alt="...">
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
    </div>

    <div class="container d-flex flex-wrap mt-4">
        <h2>⚫ Наши подборки по типу кожи</h2>
    </div>

    <div class="container d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4 wrap-md-4">
        <div class="card mb-4 p-2 border-0 d-flex flex-column justify-content-end shadow" style="width: 17rem; height: 21rem; background-image: url('{{ url('storage/img/111.jpg') }}'); background-size: cover; background-position: center;">
            <h5 style="color: white">Проблемная кожа</h5>
            <a href="#" class="btn btn-light btn-sm border-1 w-50">Подробнее</a>
        </div>
        <div class="card mb-4 p-2 border-0 d-flex flex-column justify-content-end shadow" style="width: 17rem; height: 19rem;  background-image: url('{{ url('storage/img/222.jpg') }}'); background-size: cover; background-position: center;">
            <h5 style="color: white">Сухая кожа</h5>
            <a href="#" class="btn btn-light btn-sm border-1 w-50">Подробнее</a>
        </div>
        <div class="card mb-4 p-2 border-0 d-flex flex-column justify-content-end shadow" style="width: 17rem; height: 21rem;  background-image: url('{{ url('storage/img/333.webp') }}'); background-size: cover; background-position: center;">
            <h5 style="color: white">Возрастная кожа</h5>
            <a href="#" class="btn btn-light btn-sm border-1 w-50">Подробнее</a>
        </div>
        <div class="card mb-4 p-2 border-0 d-flex flex-column justify-content-end shadow" style="width: 17rem; height: 19rem;  background-image: url('{{ url('storage/img/444.jpg') }}'); background-size: cover; background-position: center;">
            <h5 style="color: white">Пигменция</h5>
            <a href="#" class="btn btn-light btn-sm border-1 w-50">Подробнее</a>
        </div>
    </div>

    <div class="container d-flex flex-wrap mt-4">
        <h2>⚫ О нас</h2>
    </div>

    <div class="container d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4 wrap-md-4">
        <div class="d-flex">
            <div class="row">
                <div class="col-sm-6 mb-2">
                    <div class="card border border-dark">
                        <div class="card-body">
                            <h4 class="card-title w-75" style="height: 12vh">Улучшаем качество жизни через уход и любовь к себе</h4>
                            <p class="card-text w-75 mt-4 mb-0" style="height: 16vh; font-size: 14px;">Это пространство эффективных средств широкого действия, которые могут решить эстетичные проблемы кожи лица , тела и волос.</p>
                            <a href="#" class="btn btn-outline-dark border-2 rounded-pill">Подробнее</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-2">
                    <div class="card border border-dark">
                        <div class="card-body">
                            <h4 class="card-title w-75" style="height: 12vh">На полках магазина не появляются неожиданно быстро новые тренды</h4>
                            <p class="card-text w-75 mt-4 mb-0" style="height: 16vh; font-size: 14px;">Мы всей командой тестируем все средства: состав, сочетаемость, текстуры и эффективность, которая подтверждена клиническими испытаниями.</p>
                            <a href="#" class="btn btn-outline-dark border-2 rounded-pill">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-around flex-wrap">
            <div class="d-flex flex-column">
                <div class="mb-sm-2">
                    <div class="card text-center shadow mb-2" style="height: 200px; width: 350px;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title">Натуральные ингредиенты</h5>
                            <p class="card-text">Продукция изготовлена из высококачественных натуральных веществ, что обеспечивает безопасность и здоровье как для кожи, так и для волос.</p>
                        </div>
                    </div>
                </div>
                <div class="mb-sm-2">
                    <div class="card text-center shadow mb-2" style="height: 250px; width: 350px;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title">Широкий ассортимент</h5>
                            <p class="card-text">С более чем 100 единицами продукции, ваша компания предлагает разнообразие товаров для ухода за волосами, лицом и телом.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column">
                <div class="mb-sm-2">
                    <div class="card text-center shadow mb-2" style="height: 250px; width: 350px;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title">Экологическая устойчивость и этика</h5>
                            <p class="card-text">Использование натуральных компонентов способствует сохранению окружающей среды, так как такие ингредиенты, как правило, поддаются биологическому разложению и не наносят вреда экосистеме.</p>
                        </div>
                    </div>
                </div>
                <div class="mb-sm-2">
                    <div class="card text-center shadow mb-2" style="height: 200px; width: 350px;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title">Поддержка здоровья кожи и волос</h5>
                            <p class="card-text">Натуральная косметика обеспечивает глубокое питание и увлажнение, помогает улучшить состояние кожи и волос, сохраняя их красоту и здоровье.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center gradient-advanced shadow" style="height: 458px; width: 350px">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title">Улучшаем качество жизни через уход и любовь к себе</h5>
                        <p class="card-text">Это пространство эффективных средств широкого действия, которые могут решить эстетичные проблемы кожи лица , тела и волос. Мы всей командой тестируем все средства: состав, сочетаемость, текстуры и эффективность, которая подтверждена клиническими испытаниями.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade-in-down" style="background-color: white; modal-show-transform: scale(.8);" id="myModal">
        <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
            <div class="modal-dialog modal-fullscreen-sm-down" role="document">
                <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                    <div>
                        <div class="spinner-border text-dark" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Загрузка...</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <h6 style="color: black">Загрузка...</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        a {
            text-decoration: none;
        }

        h2 {
            font-size: 16px;
        }

        .gradient-advanced {
            background: radial-gradient(50% 123.47% at 50% 50%, #00ff94 0%, #720059 100%),
            linear-gradient(121.28deg, #669600 0%, #ff0000 100%),
            linear-gradient(360deg, #0029ff 0%, #8fff00 100%),
            radial-gradient(100% 164.72% at 100% 100%, #6100ff 0%, #00ff57 100%),
            radial-gradient(100% 148.07% at 0% 0%, #fff500 0%, #51d500 100%);
            background-blend-mode: screen, color-dodge, overlay, difference, normal;
        }
    </style>

    {{--<script type="text/javascript">
        $(window).on('load',function() {

            let delayMs = 1;
            setTimeout(function(){
                $('#myModal').modal('show');
            }, delayMs);
        });

        setTimeout(function() {
            $('#myModal').modal('toggle');
        }, 1000);
        $('#myModal').css("display", "block");
    </script>--}}
@endsection
@extends('modals')
@extends('footer')

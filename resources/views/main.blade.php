@extends('layouts/layout')
@extends('header')
@section('title', 'ShaR - Красота и Здоровье')
@section('content')
    <div class="container d-flex flex-column rounded-3" style="background-image: url({{ url('storage/img/bg-header.jpg') }}); background-size: cover; background-position: center;">
        <div class="container mt-4 p-1 d-flex flex-wrap justify-content-between" style="height: 50vh;">
            <div class="d-flex">
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="https://sun1-21.userapi.com/s/v1/if1/rMm-6u0GoPTLNsjTHMsj1HBwjoTBNt0Jex6Hdvaz9y3_eqtlDg9aqWqiUpG-k1GS6A3Hwyfy.jpg?size=100x100&quality=96&crop=9,0,453,453&ava=1" alt="">
                    <p class="badge" style="color: white">Волосы</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="https://sun6-23.userapi.com/s/v1/ig2/Q4JpwR8LylYMlTJW2KAi20EHX5-DJF0-QgzXW8GDoEBXyYrGaTqdbohw-nDeL35DYb0UZQ5FXdEZZLXTuZ8k001R.jpg?size=100x100&quality=96&crop=0,0,735,735&ava=1" alt="">
                    <p class="badge" style="color: white">Лицо</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="https://sun9-12.userapi.com/c11073/u171156377/d_56da7093.jpg" alt="">
                    <p class="badge" style="color: white">Тело</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="https://avatars.mds.yandex.net/i?id=0edae5e99bc3f992433dcd0f4bec976d_sr-9666026-images-thumbs&n=13" alt="">
                    <p class="badge" style="color: white">Подборки</p>
                </div>
            </div>
            <div class="d-flex">
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="https://avatars.mds.yandex.net/i?id=655a45f8b79aac3a201985b7306b4a5a_sr-10812288-images-thumbs&n=13" alt="">
                    <p class="badge" style="color: white">Скрабы</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="https://sun1-54.userapi.com/s/v1/if2/URD9UDbgjML5EBiOa6AflIdIRCQo32uneeIK37xAFpc6eJZW3doCpmk2u6srhKMMARz26qWX9oW9eo3BxL5KLkZW.jpg?quality=96&crop=1,99,932,932&as=50x50,100x100,200x200,400x400&ava=1&u=UCsgkEZ1SBhNs-cXHy9rppzNl8uchGTv-2zX_zP8BVE&cs=100x100" alt="">
                    <p class="badge" style="color: white">Масла</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="https://avatars.mds.yandex.net/i?id=2af6d7b407c08a98d54b3e18251bd91f_sr-4078232-images-thumbs&n=13" alt="">
                    <p class="badge" style="color: white">Гели</p>
                </div>
                <div class="w-10 d-flex flex-column align-items-center">
                    <img class="m-2 rounded-circle" style="width: 75px" src="https://soodring.ch/wp-content/uploads/2020/05/Mousse-au-Chaucolate-100x100.png" alt="">
                    <p class="badge" style="color: white">Муссы</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column m-2">
            <p class="mt-4 p-1" style="margin: 0; font-size: 14px; color: white">Мы заботимся о вас и вашей коже ❤</p>
            <h1 class="p-1" style="color: white">КОСМЕТИКА ДЛЯ <u>ТВОЕЙ</u> ЖИЗНИ</h1>
        </div>
    </div>

    <div class="container d-flex flex-wrap mt-5">
        <h6>⚫ Популярные товары</h6>
    </div>

    <div class="container d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4 wrap-md-4">
        @foreach($data as $item)
            <div class="card h-100 mb-4" style="width: 17rem;">
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
                        @if($item['category'] === 'muse')
                            <a href="{{ url('catalog/musses') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
                        @elseif($item['category'] === 'gel')
                            <a href="{{ url('catalog/gels') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
                        @elseif($item['category'] === 'scrab')
                            <a href="{{ url('catalog/scrabs') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
                        @elseif($item['category'] === 'oil')
                            <a href="{{ url('catalog/oils') }}/{{ $item['id'] }}" class="btn btn-dark border-2 m-1" style="font-size: 14px">Подробнее</a>
                        @endif

                        <form action="{{ route('cart.add') }}" method="post" class="m-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                            <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 70px; display: none;">
                            <input type="text" name="category" value="{{ $item['category'] }}" class="form-control" style="width: 70px; display: none;">
                            <button type="submit" class="btn btn-outline-dark border-2" style="font-size: 14px">
                                В корзину
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container d-flex flex-wrap mt-4">
        <h6>⚫ Наши подборки по типу кожи</h6>
    </div>

    <div class="container d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4 wrap-md-4">
        <div class="card mb-4 p-2 border-0 d-flex flex-column justify-content-end" style="width: 17rem; height: 21rem; background-image: url('https://i.pinimg.com/originals/30/b9/80/30b980a6eb54ed73b399458465328b64.jpg'); background-size: cover; background-position: center;">
            <h5 style="color: white">Проблемная кожа</h5>
            <a href="#" class="btn btn-light btn-sm border-1 w-50">Подробнее</a>
        </div>
        <div class="card mb-4 p-2 border-0 d-flex flex-column justify-content-end" style="width: 17rem; height: 19rem;  background-image: url('https://i.pinimg.com/736x/d0/5a/af/d05aaf7b2eb3e3345dc1d3b631bff18b.jpg'); background-size: cover; background-position: center;">
            <h5 style="color: white">Сухая кожа</h5>
            <a href="#" class="btn btn-light btn-sm border-1 w-50">Подробнее</a>
        </div>
        <div class="card mb-4 p-2 border-0 d-flex flex-column justify-content-end" style="width: 17rem; height: 21rem;  background-image: url('https://avatars.mds.yandex.net/i?id=e04c502a742316928a18830259f5895f_l-4120244-images-thumbs&n=13'); background-size: cover; background-position: center;">
            <h5 style="color: white">Возрастная кожа</h5>
            <a href="#" class="btn btn-light btn-sm border-1 w-50">Подробнее</a>
        </div>
        <div class="card mb-4 p-2 border-0 d-flex flex-column justify-content-end" style="width: 17rem; height: 19rem;  background-image: url('https://img.the-village.kz/the-village.com.kz/post_image-image/P94I1oxWXVZ6hv-I8HdSIw.jpg'); background-size: cover; background-position: center;">
            <h5 style="color: white">Пигменция</h5>
            <a href="#" class="btn btn-light btn-sm border-1 w-50">Подробнее</a>
        </div>
    </div>

    <div class="container d-flex flex-wrap mt-4">
        <h6>⚫ О нас</h6>
    </div>

    <div class="container d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4 wrap-md-4">
        <div class="d-flex">
            <div class="row">
                <div class="col-sm-6 mb-2">
                    <div class="card border border-dark">
                        <div class="card-body">
                            <h4 class="card-title w-75" style="height: 12vh">Улучшаем качество жизни через уход и любовь к себе</h4>
                            <p class="card-text w-75" style="height: 16vh; font-size: 14px;">Это пространство эффективных средств широкого действия, которые могут решить эстетичные проблемы кожи лица , тела и волос.</p>
                            <a href="#" class="btn btn-outline-dark border-2 rounded-pill">Подробнее</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-2">
                    <div class="card border border-dark">
                        <div class="card-body">
                            <h4 class="card-title w-75" style="height: 12vh">На полках магазина не появляются неожиданно быстро новые тренды</h4>
                            <p class="card-text w-75" style="height: 16vh; font-size: 14px;">Мы всей командой тестируем все средства: состав, сочетаемость, текстуры и эффективность, которая подтверждена клиническими испытаниями.</p>
                            <a href="#" class="btn btn-outline-dark border-2 rounded-pill">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 mb-4 p-4 border-0 d-flex justify-content-evenly rounded-3" style="height: 30rem; background-image: url('https://i.pinimg.com/originals/0d/a5/93/0da593203807e2d57fb98bd877eb0a53.jpg'); background-size: cover; background-position: center;">
            {{--<div class="d-flex flex-column"><p>1</p></div>
            <div class="d-flex flex-column">
                <h1 style="color: white">12312312</h1>
                <p class="text-wrap" style="color: white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus assumenda atque debitis, deserunt dicta earum eos excepturi impedit incidunt ipsum itaque neque nesciunt nisi numquam placeat possimus quisquam reprehenderit sequi?</p>
            </div>--}}
        </div>
    </div>

    <style>
        .line-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px; /* Отступы для красоты */
        }

        .dot {
            width: 10px; /* Ширина точки */
            height: 10px; /* Высота точки */
            border-radius: 50%; /* Закругление для получения круга */
            background-color: black; /* Цвет точки */
        }

        .line {
            flex-grow: 1; /* Линия занимает оставшееся пространство */
            height: 2px; /* Высота линии */
            background-color: black; /* Цвет линии */
            max-width: 130px;
        }

        @media (min-width: 768px) {
            .line {
                flex-grow: 1; /* Линия занимает оставшееся пространство */
                height: 2px; /* Высота линии */
                background-color: black; /* Цвет линии */
                max-width: 1030px;
            }
        }
    </style>

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

    <script type="text/javascript">
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
    </script>
@endsection
@extends('footer')

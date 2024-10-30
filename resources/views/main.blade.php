@extends('layouts/layout')
@extends('header')
@section('title', 'Home page')
@section('content')
    <div id="carouselExampleCaptions" class="carousel carousel-dark slide carousel-fade">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{URL('./storage/img/1026963929.jpg')}}" style="width: 100%;" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Метка первого слайда</h5>
                    <p>Некоторый репрезентативный заполнитель для первого слайда.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{URL('./storage/img/1026963929.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Метка второго слайда</h5>
                    <p>Некоторый репрезентативный заполнитель для второго слайда.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{URL('./storage/img/1026963929.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Метка третьего слайда</h5>
                    <p>Некоторый репрезентативный заполнитель для третьего слайда.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </div>
    <div class="container d-flex flex-wrap flex-column align-items-center mt-4">
        <hr class="bg-danger border-2 border-top border-danger mt-4" />
        <h1>Популярные товары</h1>
        <hr class="bg-danger border-2 border-top border-danger" />
    </div>

    <div class="container d-flex flex-wrap flex-column align-items-center mt-4 bg-danger-subtle">
        <div class="d-flex flex-wrap justify-content-around mb-3 mt-4"  style="width: 100%;">
            <div class="card mb-3" style="width: 18rem;">
                <img src="https://avatars.mds.yandex.net/i?id=5dfac37c5c2fccdb98c4c4bdb5dbc5cd_l-8495786-images-thumbs&n=13" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Заголовок карточки</h5>
                    <p class="card-text">Небольшой пример текста, который должен основываться на названии карточки и составлять основную часть содержимого карты.</p>
                    <a href="#" class="btn btn-danger">Подробнее</a>
                </div>
            </div>
            <div class="card mb-3" style="width: 18rem;">
                <img src="https://avatars.mds.yandex.net/i?id=5dfac37c5c2fccdb98c4c4bdb5dbc5cd_l-8495786-images-thumbs&n=13" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Заголовок карточки</h5>
                    <p class="card-text">Небольшой пример текста, который должен основываться на названии карточки и составлять основную часть содержимого карты.</p>
                    <a href="#" class="btn btn-danger">Подробнее</a>
                </div>
            </div>
            <div class="card mb-3" style="width: 18rem;">
                <img src="https://avatars.mds.yandex.net/i?id=5dfac37c5c2fccdb98c4c4bdb5dbc5cd_l-8495786-images-thumbs&n=13" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Заголовок карточки</h5>
                    <p class="card-text">Небольшой пример текста, который должен основываться на названии карточки и составлять основную часть содержимого карты.</p>
                    <a href="#" class="btn btn-danger">Подробнее</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-flex flex-column align-items-center mt-4">
        <div class="d-flex flex-wrap justify-content-around mb-3 mt-4"  style="width: 100%;">
            <div class="d-flex flex-column justify-content-center" style="width: 45%;">
                <img src="https://avatars.mds.yandex.net/i?id=5dfac37c5c2fccdb98c4c4bdb5dbc5cd_l-8495786-images-thumbs&n=13" class="img-fluid" alt="...">
            </div>
            <div class="d-flex flex-column justify-content-center align-items-end" style="width: 45%;">
                <h2>LE MOUSSE</h2>
                <p class="mb-0" style="text-align: end">невероятные текстуры, ароматы и эстетическое удовольствие в сочетании с мощными активными компонентами.</p>
            </div>
        </div>
        <div class="d-flex flex-row-reverse flex-wrap justify-content-around mb-3 mt-4 bg-danger-subtle"  style="width: 100%;">
            <div class="d-flex flex-column justify-content-center" style="width: 45%;">
                <img src="https://avatars.mds.yandex.net/i?id=72506d7b73094365312885e9f21c1d9d_l-4080348-images-thumbs&n=13" class="img-fluid" alt="...">
            </div>
            <div class="d-flex flex-column justify-content-center" style="width: 45%;">
                <h2>LE MOUSSE</h2>
                <p class="mb-0">невероятные текстуры, ароматы и эстетическое удовольствие в сочетании с мощными активными компонентами.</p>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-around mb-3 mt-4"  style="width: 100%;">
            <div class="d-flex flex-column justify-content-center" style="width: 45%;">
                <img src="https://avatars.mds.yandex.net/i?id=5dfac37c5c2fccdb98c4c4bdb5dbc5cd_l-8495786-images-thumbs&n=13" class="img-fluid" alt="...">
            </div>
            <div class="d-flex flex-column justify-content-center align-items-end" style="width: 45%;">
                <h2>LE MOUSSE</h2>
                <p class="mb-0" style="text-align: end">невероятные текстуры, ароматы и эстетическое удовольствие в сочетании с мощными активными компонентами.</p>
            </div>
        </div>
    </div>

    <div class="container d-flex flex-wrap flex-column align-items-center mt-4">
        <hr class="bg-danger border-2 border-top border-danger mt-4" />
        <h1>Что-то ещё</h1>
        <hr class="bg-danger border-2 border-top border-danger" />
    </div>

    <div class="container d-flex flex-column align-items-center mt-4">
        <p>Невероятные текстуры, ароматы и эстетическое удовольствие в сочетании с мощными активными компонентами.
            Невероятные текстуры, ароматы и эстетическое удовольствие в сочетании с мощными активными компонентами.</p>
        <img src="{{URL('./storage/img/1026963929.jpg')}}" class="d-block w-100" alt="...">
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

    <script type="text/javascript">
        $(window).on('load',function(){
            var delayMs = 1; // delay in milliseconds

            setTimeout(function(){
                $('#myModal').modal('show');
            }, delayMs);
        });

        setTimeout(function(){
            $('#myModal').modal('toggle');
        }, 1000);
        $('#myModal').css("display", "block");
    </script>

    <style>

        .carousel-inner img {
            height: 500px;
            width: 100%;
        }

        .carousel-fade .item {
            transition: opacity ease-out .7s;
        }

        hr {
            width: 200px;
            margin: 0;
            color: inherit;
            background-color: currentColor;
            border: 0;
            opacity: 0.25;
        }
    </style>
@endsection
@extends('footer')

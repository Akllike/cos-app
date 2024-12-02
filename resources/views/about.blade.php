@extends('layouts.layout')
@extends('header')
@section('title', 'О нас | ShaR')
@section('content')
    <div class="container">
        <div class="container d-flex flex-wrap mt-4">
            <h2>⚫ О нас</h2>
        </div>

        <div class="d-flex justify-content-around flex-wrap">
            <div class="d-flex flex-column">
                <div class="mb-sm-2">
                    <div class="card text-center shadow overlay" style="height: 400px; width: 340px; background-image: url('https://sun9-27.userapi.com/impg/H8enJKgtDVZZ5PsU6e41avkne2er6qGOjWhyQw/ztJX1mPMrrM.jpg?size=403x604&quality=96&sign=83af092981807bd19cd5cbf6c3e0527c&c_uniq_tag=nFpLM_4476gcrG7xvXFdp-ifra2JDMs-mJzTZgLtNXE&type=album'); background-size: cover; background-position: center;">
                        <div class="card-body d-flex flex-column justify-content-center text">
                            <h5 class="card-title">Натуральные ингредиенты</h5>
                            <p class="card-text">Продукция изготовлена из высококачественных натуральных веществ, что обеспечивает безопасность и здоровье как для кожи, так и для волос.</p>
                        </div>
                    </div>
                </div>
                <div class="mb-sm-2">
                    <div class="card text-center shadow overlay" style="height: 550px; width: 340px; background-image: url('https://i.pinimg.com/originals/e0/29/2d/e0292d0d6dd24be7d241a972e2543b40.jpg'); background-size: cover; background-position: center;">
                        <div class="card-body d-flex flex-column justify-content-center text">
                            <h5 class="card-title">Широкий ассортимент</h5>
                            <p class="card-text">С более чем 100 единицами продукции, ваша компания предлагает разнообразие товаров для ухода за волосами, лицом и телом.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column">
                <div class="mb-sm-2">
                    <div class="card text-center shadow overlay" style="height: 550px; width: 340px; background-image: url('https://miro.medium.com/v2/resize:fit:2400/1*O5grueT3VW8Pyj4e-houUQ.jpeg'); background-size: cover; background-position: center;">
                        <div class="card-body d-flex flex-column justify-content-center text">
                            <h5 class="card-title">Экологическая устойчивость и этика</h5>
                            <p class="card-text">Использование натуральных компонентов способствует сохранению окружающей среды, так как такие ингредиенты, как правило, поддаются биологическому разложению и не наносят вреда экосистеме.</p>
                        </div>
                    </div>
                </div>
                <div class="mb-sm-2">
                    <div class="card text-center shadow overlay" style="height: 400px; width: 340px; background-image: url('https://i.pinimg.com/736x/b0/bb/0e/b0bb0e173a53080aab35fd87935a27fc.jpg'); background-size: cover; background-position: center;">
                        <div class="card-body d-flex flex-column justify-content-center text">
                            <h5 class="card-title">Поддержка здоровья кожи и волос</h5>
                            <p class="card-text">Натуральная косметика обеспечивает глубокое питание и увлажнение, помогает улучшить состояние кожи и волос, сохраняя их красоту и здоровье.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center gradient-advanced shadow overlay" style="height: 957px; width: 390px; background-image: url('https://i.pinimg.com/736x/ef/6b/7c/ef6b7c60605a8e32c500401f007b5dcc.jpg'); background-size: cover; background-position: center;">
                    <div class="card-body d-flex flex-column justify-content-center text">
                        <h5 class="card-title">Улучшаем качество жизни через уход и любовь к себе</h5>
                        <p class="card-text">Это пространство эффективных средств широкого действия, которые могут решить эстетичные проблемы кожи лица , тела и волос. Мы всей командой тестируем все средства: состав, сочетаемость, текстуры и эффективность, которая подтверждена клиническими испытаниями.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        h2 {
            font-size: 16px;
        }

        .overlay {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 15px;
            background-image: url({{ url('storage/img/bodies.jpg') }}); /* Укажите ваш URL изображения */
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
@extends('footer')

@section('sidebar')
    <div class="container p-0 sticky-top">
        <nav class="navbar sticky-top navbar-expand-lg" style="background-color: #ffffff;" id="myTab" role="tablist">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Переключатель навигации">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ url('storage/img/navbar.jpg') }}" alt="Logo" width="36" height="32" class="d-inline-block align-text-top">
                    <h6>ShaR</h6>
                </a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('stock') }}">В наличии</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Каталог
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('hair.show') }}"><img style="margin-right: 5px;" width="18" height="18" src="https://img.icons8.com/carbon-copy/100/womans-hair.png" alt="womans-hair"/>Для волос</a></li>
                                <li><a class="dropdown-item" href="{{ route('face.show') }}"><img style="margin-right: 5px;" width="18" height="18" src="https://img.icons8.com/ios/50/bavarian-girl.png" alt="bavarian-girl"/>Для лица</a></li>
                                <li><a class="dropdown-item" href="{{ route('body.show') }}"><img style="margin-right: 5px;" width="18" height="18" src="https://img.icons8.com/ios/50/female-back.png" alt="female-back"/>Для тела</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('about') }}">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('delivery') }}">Оплата и доставка</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('cart.index') }}">
                                Корзина
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <form action="{{ url('search/result') }}" method="POST" class="d-flex">
                        @csrf
                        <input class="form-control me-2" type="text" name="name" placeholder="Поиск" aria-label="Поиск">
                        <button class="btn btn-outline-dark border-2" type="submit">Поиск</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
@endsection

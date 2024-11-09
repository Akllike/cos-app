@section('sidebar')
    <div class="container p-0">
        <nav class="navbar sticky-top navbar-expand-lg" style="background-color: #ffffff;" id="myTab" role="tablist">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Переключатель навигации">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="{{ url('storage/img/navbar.jpg') }}" alt="Logo" width="36" height="32" class="d-inline-block align-text-top">
                    <h6>ShaR</h6>
                </a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Главная</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Каталог
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('muse.show') }}">Муссы</a></li>
                                <li><a class="dropdown-item" href="{{ route('gel.show') }}">Гели</a></li>
                                <li><a class="dropdown-item" href="{{ route('scrab.show') }}">Скрабы</a></li>
                                <li><a class="dropdown-item" href="{{ route('oil.show') }}">Масла</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">Оплата и доставка</a>
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

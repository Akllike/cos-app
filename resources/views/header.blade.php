@section('sidebar')
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary" id="myTab" role="tablist">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Переключатель навигации">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">ShaR</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Главная</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Каталог
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('catalog/musses') }}">Муссы</a></li>
                            <li><a class="dropdown-item" href="{{ url('catalog/gels') }}">Гели</a></li>
                            <li><a class="dropdown-item" href="{{ url('catalog/scrabs') }}">Скрабы</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Оплата и доставка</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                    <button class="btn btn-outline-danger" type="submit">Поиск</button>
                </form>
            </div>
        </div>
    </nav>
@endsection

@section('footer')
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="{{ route('index') }}" class="nav-link px-2 text-muted">Главная</a></li>
            <li class="nav-item"><a href="{{ route('catalog') }}" class="nav-link px-2 text-muted">Каталог</a></li>
            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link px-2 text-muted">О нас</a></li>
            <li class="nav-item"><a href="{{ route('delivery') }}" class="nav-link px-2 text-muted">Оплата и доставка</a></li>
        </ul>
        <p class="text-center text-muted">© 2025 ShaR</p>
    </footer>
@endsection

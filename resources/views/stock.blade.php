@extends('layouts.layout')
@extends('header')
@section('title', 'В наличии | ShaR')
@section('content')
    <div class="container">
        <div class="container d-flex flex-wrap mt-4">
            <nav class="mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Товар в наличии</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <!-- Фильтр товаров -->
            <div class="col-md-3">
                <div class="card shadow-sm mb-4 mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Фильтры</h5>

                        <!-- Фильтр по цене -->
                        <div class="mb-3">
                            <label for="priceRange" class="form-label">Цена, руб.</label>
                            <div class="d-flex justify-content-between">
                                <input type="number" id="minPrice" class="form-control form-control-sm" placeholder="От" style="width: 45%">
                                <input type="number" id="maxPrice" class="form-control form-control-sm" placeholder="До" style="width: 45%">
                            </div>
                        </div>

                        <!-- Фильтр по категории -->
                        <div class="mb-3">
                            <label class="form-label">Категория</label>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox" value="face" id="face">
                                <label class="form-check-label" for="face">Для лица</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox" value="hair" id="hair">
                                <label class="form-check-label" for="hair">Для волос</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox" value="body" id="body">
                                <label class="form-check-label" for="body">Для тела</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox" value="oil" id="oil">
                                <label class="form-check-label" for="body">Масла</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox" value="certificate" id="certificate">
                                <label class="form-check-label" for="body">Сертификаты</label>
                            </div>
                        </div>

                        <!-- Фильтр по объему -->
                        <div class="mb-3">
                            <label class="form-label">Объем, мл</label>
                            <div class="form-check">
                                <input class="form-check-input volume-filter" type="checkbox" value="40" id="vol50">
                                <label class="form-check-label" for="vol50">40 мл</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input volume-filter" type="checkbox" value="50" id="vol100">
                                <label class="form-check-label" for="vol100">50 мл</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input volume-filter" type="checkbox" value="100" id="vol200">
                                <label class="form-check-label" for="vol200">100 мл</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input volume-filter" type="checkbox" value="150" id="vol500">
                                <label class="form-check-label" for="vol500">150 мл</label>
                            </div>
                        </div>

                        <button id="resetFilters" class="btn btn-outline-secondary btn-sm">Сбросить фильтры</button>
                    </div>
                </div>
            </div>

            <!-- Список товаров -->
            <div class="col-md-9">
                <div class="container d-flex flex-wrap justify-content-around align-items-center mt-4 mb-4 wrap-md-4" id="productsContainer">
                    @if(sizeof($data) != 0)
                        @foreach($data as $item)
                            <div class="card h-100 mb-4 shadow product-card"
                                 data-id="{{$item['id']}}"
                                 data-price="{{$item['price']}}"
                                 data-category="{{$item['category'] ?? 'face'}}"
                                 data-volume="{{$item['volume']}}"
                                 style="width: 17rem;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ $item['image'] }}" class="card-img-top w-75" style="height: 270px; object-fit: cover;" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title" style="height: 4rem;"><a style="text-decoration: none; color: inherit;" href="{{ route('product.card', $item['id']) }}">{{$item['name']}}</a></h5>
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
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Элементы фильтров
            const minPriceInput = document.getElementById('minPrice');
            const maxPriceInput = document.getElementById('maxPrice');
            const categoryFilters = document.querySelectorAll('.category-filter');
            const volumeFilters = document.querySelectorAll('.volume-filter');
            const resetFiltersBtn = document.getElementById('resetFilters');
            const productCards = document.querySelectorAll('.product-card');

            // Функция фильтрации товаров
            function filterProducts() {
                const minPrice = parseFloat(minPriceInput.value) || 0;
                const maxPrice = parseFloat(maxPriceInput.value) || Infinity;

                const selectedCategories = Array.from(categoryFilters)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                const selectedVolumes = Array.from(volumeFilters)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                productCards.forEach(card => {
                    const price = parseFloat(card.dataset.price);
                    const category = card.dataset.category;
                    const volume = card.dataset.volume;

                    // Проверяем соответствие всем критериям
                    const priceMatch = price >= minPrice && price <= maxPrice;
                    const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(category);
                    const volumeMatch = selectedVolumes.length === 0 || selectedVolumes.includes(volume);

                    if (priceMatch && categoryMatch && volumeMatch) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Проверяем, есть ли видимые товары
                const visibleProducts = document.querySelectorAll('.product-card[style="display: block;"]');
                const noProductsMessage = document.querySelector('#productsContainer p');

                if (visibleProducts.length === 0 && noProductsMessage === null) {
                    const message = document.createElement('p');
                    message.textContent = 'По вашему запросу ничего не найдено.';
                    document.getElementById('productsContainer').appendChild(message);
                } else if (visibleProducts.length > 0 && noProductsMessage) {
                    noProductsMessage.remove();
                }
            }

            // События для автоматического применения фильтров
            minPriceInput.addEventListener('input', filterProducts);
            maxPriceInput.addEventListener('input', filterProducts);

            categoryFilters.forEach(checkbox => {
                checkbox.addEventListener('change', filterProducts);
            });

            volumeFilters.forEach(checkbox => {
                checkbox.addEventListener('change', filterProducts);
            });

            // Сброс фильтров
            resetFiltersBtn.addEventListener('click', function() {
                minPriceInput.value = '';
                maxPriceInput.value = '';

                categoryFilters.forEach(checkbox => {
                    checkbox.checked = false;
                });

                volumeFilters.forEach(checkbox => {
                    checkbox.checked = false;
                });

                filterProducts();
            });

            // Инициализация фильтра при загрузке
            filterProducts();
        });
    </script>
@endsection
@extends('modals')
@extends('footer')

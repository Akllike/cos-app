@extends('layouts.layout')
@extends('header')
@section('content')
    {{--<img src="{{URL('./storage/img/itismuse.jpg')}}" style="width: 100%; height: 400px;" alt="...">--}}
    <div class="container my-5">
        <div class="row">
            @foreach($data['card'] as $item)
                @section('title', $item['name'] . ' | ShaR')
                @section('meta_description', $item['description'])
                @section('meta_image', url($item['image']))
                @section('meta_url', route('product.card', $item['id']))
                @section('meta_product_price', $item['price'])
                @section('meta_product_currency', 'RUB')
                @section('meta_product_image', url($item['image']))
                @section('link_canonical', route('product.card', $item['id']))
                <div class="col-md-5">
                    <div class="main-img d-flex justify-content-center mb-5">
                        <img class="img-fluid w-50 zoomable-image" src="{{ url($item['image']) }}" alt="ProductS">
                    </div>
                </div>
                <div class="col-md-7" data-id="{{ $item['id'] }}">
                    <div class="main-description px-2">
                        <div class="category text-bold">
                            @if(strcmp($item['category'], 'hair') == 0)
                                Категория: Для волос
                            @elseif(strcmp($item['category'], 'face') == 0)
                                Категория: Для лица
                            @elseif(strcmp($item['category'], 'body') == 0)
                                Категория: Для тела
                            @elseif(strcmp($item['category'], 'oil') == 0)
                                Категория: Масла
                            @elseif(strcmp($item['category'], 'certificate') == 0)
                                Категория: Сертификаты
                            @endif
                        </div>
                        @if($item['popular'] > 0)
                            <div class="category text-bold">
                                <img src="{{ url('storage/img/success.png') }}" width="25px" alt="">
                                В наличии
                            </div>
                        @endif
                        <div class="product-title text-bold my-3">
                            <p class="display-5">{{ $item['name'] }}</p>
                        </div>

                        <div class="price-area my-4">
                            {{--<p class="old-price mb-1"><del>$100</del> <span class="old-price-discount text-danger">(20% off)</span></p>--}}
                            <h4 class="new-price text-bold mb-1">{{ $item['price'] }} руб.</h4>
                            <p class="text-secondary mb-1">Объем: {{ $item['volume'] }} мл</p>
                        </div>

                        <div class="quantity-block" style="display: flex">
                            <button class="btn quantity-minus" style="margin: 2px; width: 30px; height: 30px;">-</button>
                            <p class="quantity" style="margin: 2px; font-size: 25px;">1</p>
                            <button class="btn quantity-plus" style="margin: 2px; width: 30px; height: 30px;">+</button>
                        </div>
                        <!-- <input type="text" class="form-control quantity" placeholder="Количество" value="1"> -->
                        <button type="submit" class="btn btn-outline-dark border-2 m-1 shadow add-cart">
                            В корзину
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="product-details my-4 px-2">
                        <h6 class="details-title text-color mb-1">Описание:</h6>
                        <p id="text-desc" class="description text-truncate">{{ $item['description'] }}</p>
                        <button id="desc-button" class="btn btn-light">Подробнее...</button>
                    </div>

                    <div class="row questions bg-light p-3">

                        <div class="col-md-11 text mb-2">
                            <h6>Состав:</h6>
                        </div>
                        <div class="col-md-11 text">
                            <p class="fst-bold fst-italic">{{ $item['composition'] }}</p>
                        </div>
                    </div>

                    <div class="delivery my-4">
                        <p class="font-weight-bold mb-0">
                            <span>
                                <svg class="svg-inline--fa fa-truck" style="width: 3%;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="truck" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM208 416c0 26.5-21.5 48-48 48s-48-21.5-48-48s21.5-48 48-48s48 21.5 48 48zm272 48c-26.5 0-48-21.5-48-48s21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48z"></path>
                                </svg>
                            </span> <b>Заказывайте товары на Wildberries и Ozon</b> </p>
                        <p class="text-secondary">Доставку можно оформить как до пункта выдачи, так и до двери</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Блок "Оставить отзыв" -->
            <div class="col-lg-6 col-12 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-black text-white">
                        <h5 class="m-0 category fw-bold">Оставить отзыв</h5>
                    </div>
                    <div class="card-body">
                        @foreach($data['card'] as $item)
                            <form action="{{ route('product.comment.add', $item['id']) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <input type="hidden" name="rating" id="rating-value" value="5"> <!-- Скрытое поле для значения рейтинга -->

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Ваше имя</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Оценка</label>
                                    <div class="rating-stars">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{$i}}" name="rating-radio" value="{{$i}}" {{ $i == 5 ? 'checked' : '' }}>
                                            <label for="star{{$i}}" title="{{$i}} звезд">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="comment" class="form-label">Комментарий</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-dark border-2 m-1">Отправить отзыв</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Блок "Отзывы о товаре" -->
            @if(sizeof($comments) != 0)
                <div class="col-lg-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="m-0 category fw-bold">Отзывы о товаре</h5>
                        </div>
                        <div class="card-body p-0 d-flex flex-column">
                            @if(is_string($comments))
                                <div class="p-3 flex-grow-1">
                                    <p class="text-muted m-0">{{ $comments }}</p>
                                </div>
                            @else
                                <div style="max-height: 350px; overflow-y: auto;" class="flex-grow-1">
                                    <div class="p-3">
                                        @foreach($comments as $comment)
                                            <div class="mb-4 pb-3 border-bottom">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <h6 class="mb-0">{{ $comment->name }}</h6>
                                                    <small class="text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                                                </div>
                                                <div class="mb-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $comment->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p class="mb-0">{{ $comment->comment }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="m-0 category fw-bold">Отзывы о товаре</h5>
                        </div>
                        <p class="p-2 text-center">Оставь комментарий первым!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#desc-button').click(function(e) {
                // Stop form from sending request to server
                $(".description").toggleClass("text-truncate"); return false;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const ratingStars = document.querySelectorAll('.rating-stars input');
            const ratingValue = document.getElementById('rating-value');

            ratingStars.forEach(star => {
                star.addEventListener('change', function() {
                    ratingValue.value = this.value;
                });
            });
        });
    </script>

    <style>
        .bg-color-wb {
            background-color: #712cf9;
            color: #fff;
        }

        .bg-color-wb:hover {
            background-color: #4b13bf;
            color: #fff;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .rating-stars input {
            display: none;
        }
        .rating-stars label {
            color: #ddd;
            font-size: 1.5rem;
            padding: 0 3px;
            cursor: pointer;
        }
        .rating-stars input:checked ~ label,
        .rating-stars input:hover ~ label {
            color: #ffc107;
        }
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #ffc107;
        }

        .zoomable-image {
            transition: transform 0.3s ease-in-out;
            cursor: zoom-in;
            transform-origin: center;
        }

        .zoomable-image:hover {
            transform: scale(1.25);
        }
    </style>
@endsection
@extends('modals')
@extends('footer')

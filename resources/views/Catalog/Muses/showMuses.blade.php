@extends('layouts.layout')
@extends('header')
@section('content')
    <img src="{{URL('./storage/img/itismuse.jpg')}}" style="width: 100%; height: 400px;" alt="...">
    <div class="container my-5">
        <div class="row">
            @foreach($data['card'] as $item)
                @section('title', $item['name'])
                <div class="col-md-5">
                    <div class="main-img d-flex justify-content-center mb-5">
                        <img class="img-fluid w-50" src="{{ $item['image'] }}" alt="ProductS">
                        {{--<div class="row my-3 previews">
                            <div class="col-md-3">
                                <img class="w-100" src="https://avatars.mds.yandex.net/get-mpic/1884605/img_id6153070894882640580.png/600x800" alt="Sale">
                            </div>
                            <div class="col-md-3">
                                <img class="w-100" src="https://avatars.mds.yandex.net/get-mpic/1884605/img_id6153070894882640580.png/600x800" alt="Sale">
                            </div>
                            <div class="col-md-3">
                                <img class="w-100" src="https://avatars.mds.yandex.net/get-mpic/1884605/img_id6153070894882640580.png/600x800" alt="Sale">
                            </div>
                            <div class="col-md-3">
                                <img class="w-100" src="https://avatars.mds.yandex.net/get-mpic/1884605/img_id6153070894882640580.png/600x800" alt="Sale">
                            </div>
                        </div>--}}
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="main-description px-2">
                        <div class="category text-bold">
                            Категория: Муссы
                        </div>
                        <div class="product-title text-bold my-3">
                            <p class="display-5">{{ $item['name'] }}</p>
                        </div>


                        <div class="price-area my-4">
                            {{--<p class="old-price mb-1"><del>$100</del> <span class="old-price-discount text-danger">(20% off)</span></p>--}}
                            <h4 class="new-price text-bold mb-1">{{ $item['price'] }} руб.</h4>
                            <p class="text-secondary mb-1">Объем: {{ $item['volume'] }} мл</p>
                        </div>


                        <div class="buttons d-flex my-5">
                            <div class="block" style="margin-right: 15px;">
                                <a href="#" class="shadow btn bg-color-wb">Заказать на WB</a>
                            </div>
                            <div class="block" style="margin-right: 15px;">
                                <a href="#" class="shadow btn btn-primary">Заказать на OZON</a>
                            </div>
                        </div>
                    </div>

                    <div class="product-details my-4 px-2">
                        <h6 class="details-title text-color mb-1">Описание:</h6>
                        <p class="description">{{ $item['description'] }}</p>
                    </div>

                    <div class="row questions bg-light p-3">

                        <div class="col-md-11 text mb-2">
                            <h6>Состав:</h6>
                        </div>
                        <div class="col-md-11 text">
                            {{ $item['composition'] }}
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
                    {{--<div class="delivery-options my-4">
                        <p class="font-weight-bold mb-0">
                            <span>
                                <svg class="svg-inline--fa fa-filter" style="width: 3%;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="filter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"></path>
                                </svg>
                            </span><b>Delivery options</b> </p>
                        <p class="text-secondary">View delivery options here</p>
                    </div>--}}
                </div>
            @endforeach
        </div>
    </div>



    <div class="container similar-products my-4">
        <hr>
        <p class="display-5" style="text-align: center">Похожие товары</p>

        <div class="row">
            @foreach($data['cards'] as $card)
                <div class="col-md-3">
                    <div class="similar-product d-flex flex-column align-items-center">
                        <img class="w-50" src="https://avatars.mds.yandex.net/get-mpic/1884605/img_id6153070894882640580.png/600x800" alt="Preview">
                        <p class="title">{{ $card['name'] }}</p>
                        <p class="price">{{ $card['price'] }} руб.</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .bg-color-wb {
            background-color: #712cf9;
            color: #fff;
        }

        .bg-color-wb:hover {
            background-color: #4b13bf;
            color: #fff;
        }
    </style>
@endsection
@extends('footer')

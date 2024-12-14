@extends('layouts.layout')
@extends('header')
@section('title', 'Корзина | ShaR')
@section('content')
    <div class="container">
        <h1>Корзина</h1>

        @if(count($cart) > 0)
            <table class="table cart">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Кол-во</th>
                    <th>Сумма</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $item)
                    <tr data-id="{{$item['product_id']}}">
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>
                            <button class="btn btn-sm cart-minus">-</button>
                            {{ $item['quantity'] }}
                            <button class="btn btn-sm cart-plus">+</button>
                        </td>
                        <td>{{ $item['price'] * $item['quantity'] }}</td>
                        <td>
                            <!-- <form action="{{ route('cart.remove') }}" method="post">
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}"> -->
                                <button type="submit" class="btn btn-danger remove-cart" data->Удалить</button>
                            <!-- </form> -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Корзина пуста</p>
        @endif

        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Оформление заказа</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <form action="{{ route('cart.tg') }}" method="post" class="m-1">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Ваше имя</label>
                                <input type="text" class="form-control" name="number" id="number" placeholder="Иван" required oninvalid="this.setCustomValidity('Пожалуйста, введите свое имя!')" oninput="this.setCustomValidity('')">
                                <label class="form-label">Ваш номер телефона</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="+79111233321" required oninvalid="this.setCustomValidity('Пожалуйста, введите свой номер телефона!')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Пожелания к заказу</label>
                                <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-dark border-2 remove-cart">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Модалка 2</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        Скройте это модальное окно и покажите первое с помощью кнопки ниже.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Вернуться к первому</button>
                    </div>
                </div>
            </div>
        </div>
        @if(count($cart) > 0)
            <button class="btn btn-outline-dark border-2 remove-cart" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Заказать</button>
        @else
            <button class="btn btn-outline-dark disabled border-2 remove-cart" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Заказать</button>
        @endif

        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Успешно!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('error') ?? session('error') }}</p>
                        <p>{{ session('success') ?? session('success') }}</p>
                        <p><br>В ближайшее время с вами свяжется менеджер и уточнит данные заказа и способы оплаты. </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                @if(session('success') || session('error'))
                $('#confirmationModal').modal('show');
                @endif
            });
        </script>
    </div>
    @csrf
@endsection

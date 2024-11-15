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
                        <td>{{ $item['quantity'] }}</td>
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

        <form action="{{ route('cart.tg') }}" method="post" class="m-1">
            @csrf
            <div class="mb-3">
                <label class="form-label">Адрес электронной почты</label>
                <input type="text" class="form-control" name="number" id="number" placeholder="123">
                <input type="text" class="form-control" name="name" id="name" placeholder="123">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Пример текстового поля</label>
                <textarea class="form-control" name="message" id="message" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Отправить</button>
        </form>
    </div>
    @csrf
@endsection

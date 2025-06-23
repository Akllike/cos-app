@extends('layouts.layout')
@extends('header')
@section('title', 'Корзина | ShaR')
@section('content')
    <div class="container py-4 bg-white">
        <h1 class="text-dark mb-4 font-weight-bold">Корзина</h1>

        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-hover rounded border">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3">Название</th>
                        <th class="py-3">Цена</th>
                        <th class="py-3">Кол-во</th>
                        <th class="py-3">Сумма</th>
                        <th class="py-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $item)
                        <tr data-id="{{$item['product_id']}}" class="align-middle">
                            <td class="text-dark">{{ $item['name'] }}</td>
                            <td class="text-dark">{{ number_format($item['price'], 0, '', ' ') }} руб.</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-outline-dark btn-sm cart-minus px-3">-</button>
                                    <span class="mx-2 text-dark">{{ $item['quantity'] }} шт.</span>
                                    <button class="btn btn-outline-dark btn-sm cart-plus px-3">+</button>
                                </div>
                            </td>
                            <td class="text-dark">{{ number_format($item['price'] * $item['quantity'], 0, '', ' ') }} руб.</td>
                            <td class="text-end">
                                <button class="btn btn-outline-danger btn-sm remove-cart">
                                    <i class="bi bi-trash"></i> Удалить
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="bg-light">
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Итого:</td>
                        <td class="fw-bold">{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 0, '', ' ') }} руб.</td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="/" class="btn btn-outline-dark px-4 py-2 me-3">Продолжить покупки</a>
                <button class="btn btn-dark px-4 py-2" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Оформить заказ</button>
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                </div>
                <h3 class="text-dark mb-3">Ваша корзина пуста</h3>
                <a href="/" class="btn btn-dark px-4">Вернуться к покупкам</a>
            </div>
        @endif
    </div>

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

        <style>
            td {
                body {
                    background-color: white;
                }
                .table {
                    background-color: white;
                    border-color: #dee2e6;
                }
                .table-hover tbody tr:hover {
                    background-color: rgba(0, 0, 0, 0.02);
                }
                .rounded {
                    border-radius: 8px !important;
                    overflow: hidden;
                }
                .btn-outline-dark:hover {
                    background-color: rgba(0, 0, 0, 0.05);
                }
                .bg-light {
                    background-color: #f8f9fa !important;
                }
            }
        </style>

        <script>
            $(document).ready(function() {
                @if(session('success') || session('error'))
                $('#confirmationModal').modal('show');
                @endif
                localStorage.clear();
            });
        </script>

    @csrf
@endsection

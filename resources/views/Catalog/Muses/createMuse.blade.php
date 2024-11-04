@extends('layouts.layout')
@extends('header')
@section('title', 'Муссы - Добавить мусс | ShaR')
@section('content')
        <div class="container mt-5" style="max-width: 600px">
            <div class="card-header mb-4">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="false" href="#">Добавить</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Изменить</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Удалить</a>
                    </li>
                </ul>
            </div>
            <form action="{{ url('create/musses/add') }}" method="POST" class="row g-3 needs-validation">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Заголовок</span>
                    <input type="text" name="name" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Описание</span>
                    <input type="text" name="description" class="form-control" placeholder="Описание товара" aria-label="Описание товара">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Состав</span>
                    <input type="text" name="composition" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Цена</span>
                        <input type="text" name="price" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Объем</span>
                        <input type="text" name="volume" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="basic-url" class="form-label">Название фото</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>
                        <input type="text" name="image" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                    </div>
                    <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Добавить</button>
                </div>
            </form>
        </div>
@endsection

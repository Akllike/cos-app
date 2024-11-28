@extends('layouts.app')

@section('content')
<div class="container w-75">
    <button id="btn-create-card" class="btn btn-primary m-2">Добавить карточку</button>
    <div id="create-card" style="display: none;">
        <div class="mt-2 mb-4 p-2 d-flex align-items-center justify-content-between border">
            <form action="{{ url('admin/create/') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                @csrf
                <div class="input-group mb-3">
                    <select class="form-select m-4" name="group-name" aria-label="Пример выбора по умолчанию">
                        <option selected>Выберите группу карточки</option>
                        <option value="hair">Для волос</option>
                        <option value="face">Для лица</option>
                        <option value="body">Для тела</option>
                    </select>
                </div>

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
                    <label for="basic-url" class="form-label">Загрузить фото карточки</label>
                    <div class="input-group mb-3">
                        <input type="file" name="photo" id="photo" class="form-control" required>
                    </div>
                    <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                </div>
                <div class="col-12 m-2">
                    <button id="btn-create-card" class="btn btn-primary" type="submit">Добавить</button>
                </div>
            </form>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li id="tag-muse" class="nav-item">
            <a id="src-muse" class="nav-link active" href="#">Для волос</a>
        </li>
        <li id="tag-gel" class="nav-item">
            <a id="src-gel" class="nav-link" href="#">Для лица</a>
        </li>
        <li id="tag-scrab" class="nav-item">
            <a id="src-scrab" class="nav-link" href="#">Для тела</a>
        </li>
        <li class="nav-item">
            <a id="src-muse" class="nav-link disabled" href="#">Другое</a>
        </li>
    </ul>

    <div id="list-muses" class="mt-4 d-flex flex-column">
        @foreach($hairs as $item)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="height: 50px">
                <div class="d-flex flex-row">
                    <p class="m-2">id: {{ $item['id'] }}</p> <p class="m-2">{{ $item['name'] }}</p>
                    <p class="m-2">({{ $item['volume'] }} мл)</p>
                </div>

                <div class="d-flex flex-wrap align-items-center">
                    <div class="toggle-container">
                        <input type="checkbox" id="toggle-btn-{{ $item['id'] }}" data-id="{{ $item['id'] }}" class="toggle-btn">
                        <label for="toggle-btn-{{ $item['id'] }}" class="toggle-label"></label>
                    </div>
                    <button id="btn-edit-muse-{{ $item['id'] }}" class="btn btn-primary m-1">Редактировать</button>
                    <form action="{{ url('admin/delete/') }}" method="POST" class="m-1">
                        @csrf
                        <input type="hidden" name="group-name" value="1">
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
            <div id="toggle-muse-{{ $item['id'] }}" style="display: none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Группа</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $item['category'] }}" name="group-name"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">id</span>
                            <input class="form-control" type="text" id="id" value="{{ $item['id'] }}" name="id"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Заголовок</span>
                            <input type="text" name="name" value="{{ $item['name'] }}" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Описание</span>
                            <input type="text" name="description" value="{{ $item['description'] }}" class="form-control" placeholder="Описание товара" aria-label="Описание товара">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <input type="text" name="composition" value="{{ $item['composition'] }}" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Цена</span>
                                <input type="text" name="price" value="{{ $item['price'] }}" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Объем</span>
                                <input type="text" name="volume" value="{{ $item['volume'] }}" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        {{--<div class="mb-3">
                            <label for="basic-url" class="form-label">Название фото</label>
                            <div class="input-group">
                                --}}{{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}{{--
                                <input type="text" name="image" value="{{ $muse['image'] }}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                        </div>--}}
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div id="list-gels" class="mt-4 d-none flex-column">
        @foreach($faces as $item)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="height: 50px">
                <div class="d-flex flex-row">
                    <p class="m-2">id: {{ $item['id'] }}</p> <p class="m-2">{{ $item['name'] }}</p>
                    <p class="m-2">({{ $item['volume'] }} мл)</p>
                </div>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="toggle-container">
                        <input type="checkbox" id="toggle-btn-{{ $item['id'] }}" data-id="{{ $item['id'] }}" class="toggle-btn">
                        <label for="toggle-btn-{{ $item['id'] }}" class="toggle-label"></label>
                    </div>
                    <button id="btn-edit-gel-{{ $item['id'] }}" class="btn btn-primary m-1">Редактировать</button>
                    <form action="{{ url('admin/delete/') }}" method="POST" class="m-1">
                        @csrf
                        <input type="hidden" name="group-name" value="2">
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
            <div id="toggle-gel-{{ $item['id'] }}" style="display: none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Группа</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $item['category'] }}" name="group-name"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">id</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $item['id'] }}" name="id"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Заголовок</span>
                            <input type="text" name="name" value="{{ $item['name'] }}" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Описание</span>
                            <input type="text" name="description" value="{{ $item['description'] }}" class="form-control" placeholder="Описание товара" aria-label="Описание товара">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <input type="text" name="composition" value="{{ $item['composition'] }}" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Цена</span>
                                <input type="text" name="price" value="{{ $item['price'] }}" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Объем</span>
                                <input type="text" name="volume" value="{{ $item['volume'] }}" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        {{--<div class="mb-3">
                            <label for="basic-url" class="form-label">Название фото</label>
                            <div class="input-group">
                                --}}{{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}{{--
                                <input type="text" name="image" value="{{ $gel['image'] }}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                        </div>--}}
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div id="list-scrabs" class="mt-4 d-none flex-column">
        @foreach($bodies as $item)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="height: 50px">
                <div class="d-flex flex-row">
                    <p class="m-2">id: {{ $item['id'] }}</p> <p class="m-2">{{ $item['name'] }}</p>
                    <p class="m-2">({{ $item['volume'] }} мл)</p>
                </div>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="toggle-container">
                        <input type="checkbox" id="toggle-btn-{{ $item['id'] }}" data-id="{{ $item['id'] }}" class="toggle-btn">
                        <label for="toggle-btn-{{ $item['id'] }}" class="toggle-label"></label>
                    </div>
                    <button id="btn-edit-scrab-{{ $item['id'] }}" class="btn btn-primary m-1">Редактировать</button>
                    <form action="{{ url('admin/delete/') }}" method="POST" class="m-1">
                        @csrf
                        <input type="hidden" name="group-name" value="3">
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
            <div id="toggle-scrab-{{ $item['id'] }}" style="display: none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Группа</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $item['category'] }}" name="group-name"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">id</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $item['id'] }}" name="id"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Заголовок</span>
                            <input type="text" name="name" value="{{ $item['name'] }}" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Описание</span>
                            <input type="text" name="description" value="{{ $item['description'] }}" class="form-control" placeholder="Описание товара" aria-label="Описание товара">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <input type="text" name="composition" value="{{ $item['composition'] }}" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Цена</span>
                                <input type="text" name="price" value="{{ $item['price'] }}" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Объем</span>
                                <input type="text" name="volume" value="{{ $item['volume'] }}" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1">
                            </div>
                        </div>

                       {{-- <div class="mb-3">
                            <label for="basic-url" class="form-label">Название фото</label>
                            <div class="input-group">
                                --}}{{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}{{--
                                <input type="text" name="image" value="{{ $scrab['image'] }}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                        </div>--}}
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    {{--<div id="list-oils" class="mt-4 d-none flex-column">
        @foreach($oils as $oil)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="height: 50px">
                <div class="d-flex flex-row">
                    <p class="m-2">id: {{ $oil['id'] }}</p> <p class="m-2">{{ $oil['name'] }}</p>
                    <p class="m-2">({{ $oil['volume'] }} мл)</p>
                </div>
                <div class="d-flex">
                    <button id="btn-edit-oil-{{ $oil['id'] }}" class="btn btn-primary m-1">Редактировать</button>
                    <form action="{{ url('admin/delete/') }}" method="POST" class="m-1">
                        @csrf
                        <input type="hidden" name="group-name" value="4">
                        <input type="hidden" name="id" value="{{ $oil['id'] }}">
                        <button class="btn btn-primary">Удалить</button>
                    </form>
                </div>
            </div>
            <div id="toggle-oil-{{ $oil['id'] }}" style="display: none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Группа</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $oil['category'] }}" name="group-name"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">id</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $oil['id'] }}" name="id"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Заголовок</span>
                            <input type="text" name="name" value="{{ $oil['name'] }}" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Описание</span>
                            <input type="text" name="description" value="{{ $oil['description'] }}" class="form-control" placeholder="Описание товара" aria-label="Описание товара">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <input type="text" name="composition" value="{{ $oil['composition'] }}" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Цена</span>
                                <input type="text" name="price" value="{{ $oil['price'] }}" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Объем</span>
                                <input type="text" name="volume" value="{{ $oil['volume'] }}" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        --}}{{--<div class="mb-3">
                            <label for="basic-url" class="form-label">Название фото</label>
                            <div class="input-group">
                                --}}{{----}}{{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}{{----}}{{--
                                <input type="text" name="image" value="{{ $oil['image'] }}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                        </div>--}}{{--
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>--}}
</div>

<style>
    .toggle-container {
        position: relative;
    }

    .toggle-btn {
        display: none;
    }

    .toggle-label {
        background: #ccc;
        border-radius: 20px;
        cursor: pointer;
        display: block;
        height: 30px;
        width: 60px;
        position: relative;
    }

    .toggle-label:before {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        height: 26px;
        width: 26px;
        background: white;
        border-radius: 50%;
        transition: 0.3s;
    }

    .toggle-btn:checked + .toggle-label {
        background: #4caf50;
    }

    .toggle-btn:checked + .toggle-label:before {
        transform: translateX(30px);
    }
</style>

    <script>
        @foreach($hairs as $item)
            @if($item['popular'] == 0)
                $('[data-id="{{ $item['id'] }}"].toggle-btn').prop("checked", false);
            @else
                $('[data-id="{{ $item['id'] }}"].toggle-btn').prop("checked", true);
            @endif
        @endforeach

        @foreach($faces as $item)
            @if($item['popular'] == 0)
                $('[data-id="{{ $item['id'] }}"].toggle-btn').prop("checked", false);
            @else
                $('[data-id="{{ $item['id'] }}"].toggle-btn').prop("checked", true);
            @endif
        @endforeach

        @foreach($bodies as $item)
            @if($item['popular'] == 0)
                $('[data-id="{{ $item['id'] }}"].toggle-btn').prop("checked", false);
            @else
                $('[data-id="{{ $item['id'] }}"].toggle-btn').prop("checked", true);
            @endif
        @endforeach
    </script>

    <script>
        $("#btn-create-card").on("click", function() {
            $("#create-card").toggle();
        });
    </script>

    <script>
        @foreach($hairs as $item)
            $("#btn-edit-muse-{{ $item['id'] }}").on("click", function() {
                $("#toggle-muse-{{ $item['id'] }}").toggle();
            });
        @endforeach

        @foreach($faces as $item)
        $("#btn-edit-gel-{{ $item['id'] }}").on("click", function() {
            $("#toggle-gel-{{ $item['id'] }}").toggle();
        });
        @endforeach

        @foreach($bodies as $item)
        $("#btn-edit-scrab-{{ $item['id'] }}").on("click", function() {
            $("#toggle-scrab-{{ $item['id'] }}").toggle();
        });
        @endforeach
    </script>

    <script>
        $('#tag-muse').click(function(){
            $('#list-oils').attr('class', 'mt-4 d-none flex-column');
            $('#list-gels').attr('class', 'mt-4 d-none flex-column');
            $('#list-scrabs').attr('class', 'mt-4 d-none flex-column');
            $('#list-muses').attr('class', 'mt-4 d-flex flex-column');

            $('#src-oil').attr('class', 'nav-link');
            $('#src-gel').attr('class', 'nav-link');
            $('#src-scrab').attr('class', 'nav-link');
            $('#src-muse').attr('class', 'nav-link active');
        });

        $('#tag-gel').click(function(){
            $('#list-oils').attr('class', 'mt-4 d-none flex-column');
            $('#list-scrabs').attr('class', 'mt-4 d-none flex-column');
            $('#list-muses').attr('class', 'mt-4 d-none flex-column');
            $('#list-gels').attr('class', 'mt-4 d-flex flex-column');

            $('#src-oil').attr('class', 'nav-link');
            $('#src-scrab').attr('class', 'nav-link');
            $('#src-muse').attr('class', 'nav-link');
            $('#src-gel').attr('class', 'nav-link active');
        });

        $('#tag-scrab').click(function(){
            $('#list-oils').attr('class', 'mt-4 d-none flex-column');
            $('#list-muses').attr('class', 'mt-4 d-none flex-column');
            $('#list-gels').attr('class', 'mt-4 d-none flex-column');
            $('#list-scrabs').attr('class', 'mt-4 d-flex flex-column');

            $('#src-oil').attr('class', 'nav-link');
            $('#src-muse').attr('class', 'nav-link');
            $('#src-gel').attr('class', 'nav-link');
            $('#src-scrab').attr('class', 'nav-link active');
        });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $('.toggle-btn').change(function() {
                let id = $(this).data('id');
                console.log(id);
                let state = $(this).is(':checked') ? 1 : 0; // Получаем состояние кнопки (1 или 0)

                // AJAX-запрос
                $.ajax({
                    url: '{{ url('admin/instock') }}', // Укажите ваш URL для отправки данных
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log('Ответ сервера: ', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Ошибка AJAX: ', status, error);
                    }
                });
            });
        });
    </script>
@endsection

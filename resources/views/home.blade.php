@extends('layouts.app')

@section('content')
<div class="container w-75">
    <button id="btn-create-card" class="btn btn-primary m-2">Добавить карточку</button>
    <div id="create-card" style="display: none;">
        <div class="mt-2 mb-4 d-flex align-items-center justify-content-between border">
            <form action="{{ url('admin/create/') }}" method="POST" class="row g-3 needs-validation">
                @csrf
                <select class="form-select m-4" style="width: 95%" name="group-name" aria-label="Пример выбора по умолчанию">
                    <option selected>Выберите группу карточки</option>
                    <option value="1">Муссы</option>
                    <option value="2">Гели</option>
                    <option value="3">Скрабы</option>
                    <option value="4">Масла</option>
                </select>

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
                        {{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}
                        <input type="text" name="image" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
            <a id="src-muse" class="nav-link active" href="#">Муссы</a>
        </li>
        <li id="tag-gel" class="nav-item">
            <a id="src-gel" class="nav-link" href="#">Гели</a>
        </li>
        <li id="tag-scrab" class="nav-item">
            <a id="src-scrab" class="nav-link" href="#">Скрабы</a>
        </li>
        <li id="tag-oil" class="nav-item">
            <a id="src-oil" class="nav-link" href="#">Масла</a>
        </li>
        <li class="nav-item">
            <a id="src-muse" class="nav-link disabled" href="#">Другое</a>
        </li>
    </ul>

    <div id="list-muses" class="mt-4 d-flex flex-column">
        @foreach($muses as $muse)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="height: 50px">
                <div class="d-flex flex-row">
                    <p class="m-2">id: {{ $muse['id'] }}</p> <p class="m-2">{{ $muse['name'] }}</p>
                    <p class="m-2">({{ $muse['volume'] }} мл)</p>
                </div>
                <div class="d-flex">
                    <button id="btn-edit-muse-{{ $muse['id'] }}" class="btn btn-primary m-1">Редактировать</button>
                    <form action="{{ url('admin/delete/') }}" method="POST" class="m-1">
                        @csrf
                        <input type="hidden" name="group-name" value="1">
                        <input type="hidden" name="id" value="{{ $muse['id'] }}">
                        <button class="btn btn-primary">Удалить</button>
                    </form>
                </div>
            </div>
            <div id="toggle-muse-{{ $muse['id'] }}" style="display: none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Группа</span>
                            <input class="form-control" type="text" id="group-name" value="1" name="group-name"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">id</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $muse['id'] }}" name="id"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Заголовок</span>
                            <input type="text" name="name" value="{{ $muse['name'] }}" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Описание</span>
                            <input type="text" name="description" value="{{ $muse['description'] }}" class="form-control" placeholder="Описание товара" aria-label="Описание товара">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <input type="text" name="composition" value="{{ $muse['composition'] }}" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Цена</span>
                                <input type="text" name="price" value="{{ $muse['price'] }}" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Объем</span>
                                <input type="text" name="volume" value="{{ $muse['volume'] }}" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Название фото</label>
                            <div class="input-group">
                                {{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}
                                <input type="text" name="image" value="{{ $muse['image'] }}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div id="list-gels" class="mt-4 d-none flex-column">
        @foreach($gels as $gel)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="height: 50px">
                <div class="d-flex flex-row">
                    <p class="m-2">id: {{ $gel['id'] }}</p> <p class="m-2">{{ $gel['name'] }}</p>
                    <p class="m-2">({{ $gel['volume'] }} мл)</p>
                </div>
                <div class="d-flex">
                    <button id="btn-edit-gel-{{ $gel['id'] }}" class="btn btn-primary m-1">Редактировать</button>
                    <form action="{{ url('admin/delete/') }}" method="POST" class="m-1">
                        @csrf
                        <input type="hidden" name="group-name" value="2">
                        <input type="hidden" name="id" value="{{ $gel['id'] }}">
                        <button class="btn btn-primary">Удалить</button>
                    </form>
                </div>
            </div>
            <div id="toggle-gel-{{ $gel['id'] }}" style="display: none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Группа</span>
                            <input class="form-control" type="text" id="group-name" value="2" name="group-name"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">id</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $muse['id'] }}" name="id"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Заголовок</span>
                            <input type="text" name="name" value="{{ $muse['name'] }}" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Описание</span>
                            <input type="text" name="description" value="{{ $muse['description'] }}" class="form-control" placeholder="Описание товара" aria-label="Описание товара">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <input type="text" name="composition" value="{{ $muse['composition'] }}" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Цена</span>
                                <input type="text" name="price" value="{{ $muse['price'] }}" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Объем</span>
                                <input type="text" name="volume" value="{{ $muse['volume'] }}" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Название фото</label>
                            <div class="input-group">
                                {{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}
                                <input type="text" name="image" value="{{ $muse['image'] }}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div id="list-scrabs" class="mt-4 d-none flex-column">
        @foreach($scrabs as $scrab)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="height: 50px">
                <div class="d-flex flex-row">
                    <p class="m-2">id: {{ $scrab['id'] }}</p> <p class="m-2">{{ $scrab['name'] }}</p>
                    <p class="m-2">({{ $scrab['volume'] }} мл)</p>
                </div>
                <div class="d-flex">
                    <button id="btn-edit-scrab-{{ $scrab['id'] }}" class="btn btn-primary m-1">Редактировать</button>
                    <form action="{{ url('admin/delete/') }}" method="POST" class="m-1">
                        @csrf
                        <input type="hidden" name="group-name" value="3">
                        <input type="hidden" name="id" value="{{ $scrab['id'] }}">
                        <button class="btn btn-primary">Удалить</button>
                    </form>
                </div>
            </div>
            <div id="toggle-scrab-{{ $scrab['id'] }}" style="display: none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Группа</span>
                            <input class="form-control" type="text" id="group-name" value="3" name="group-name"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">id</span>
                            <input class="form-control" type="text" id="group-name" value="{{ $scrab['id'] }}" name="id"><br><br>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Заголовок</span>
                            <input type="text" name="name" value="{{ $scrab['name'] }}" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Описание</span>
                            <input type="text" name="description" value="{{ $scrab['description'] }}" class="form-control" placeholder="Описание товара" aria-label="Описание товара">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <input type="text" name="composition" value="{{ $scrab['composition'] }}" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Цена</span>
                                <input type="text" name="price" value="{{ $scrab['price'] }}" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Объем</span>
                                <input type="text" name="volume" value="{{ $scrab['volume'] }}" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Название фото</label>
                            <div class="input-group">
                                {{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}
                                <input type="text" name="image" value="{{ $scrab['image'] }}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div id="list-oils" class="mt-4 d-none flex-column">
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
                            <input class="form-control" type="text" id="group-name" value="4" name="group-name"><br><br>
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

                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Название фото</label>
                            <div class="input-group">
                                {{--<span class="input-group-text" id="basic-addon3">https://example.com/storage/</span>--}}
                                <input type="text" name="image" value="{{ $oil['image'] }}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">Пример текста справки выходит за пределы группы ввода.</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

    <script>
        $("#btn-create-card").on("click", function() {
            $("#create-card").toggle();
        });
    </script>

    <script>
        @foreach($muses as $muse)
            $("#btn-edit-muse-{{ $muse['id'] }}").on("click", function() {
                $("#toggle-muse-{{ $muse['id'] }}").toggle();
            });
        @endforeach

        @foreach($gels as $gel)
        $("#btn-edit-gel-{{ $gel['id'] }}").on("click", function() {
            $("#toggle-gel-{{ $gel['id'] }}").toggle();
        });
        @endforeach

        @foreach($scrabs as $scrab)
        $("#btn-edit-scrab-{{ $scrab['id'] }}").on("click", function() {
            $("#toggle-scrab-{{ $scrab['id'] }}").toggle();
        });
        @endforeach

        @foreach($oils as $oil)
        $("#btn-edit-oil-{{ $oil['id'] }}").on("click", function() {
            $("#toggle-oil-{{ $oil['id'] }}").toggle();
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

        $('#tag-oil').click(function(){
            $('#list-scrabs').attr('class', 'mt-4 d-none flex-column');
            $('#list-muses').attr('class', 'mt-4 d-none flex-column');
            $('#list-gels').attr('class', 'mt-4 d-none flex-column');
            $('#list-oils').attr('class', 'mt-4 d-flex flex-column');

            $('#src-scrab').attr('class', 'nav-link');
            $('#src-muse').attr('class', 'nav-link');
            $('#src-gel').attr('class', 'nav-link');
            $('#src-oil').attr('class', 'nav-link active');
        });
    </script>
@endsection

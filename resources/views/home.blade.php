@extends('layouts.app')
@section('content')
<div class="container w-75">
    <button id="btn-create-card" class="btn btn-primary m-2">Добавить карточку</button>
    <a href="{{ route('home.orders') }}" class="btn btn-primary m-2">Заказы</a>
    <div id="create-card" class="d-none">
        <div class="mt-2 mb-4 p-2 d-flex align-items-center justify-content-between border">
            <form action="{{ url('admin/create/') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                @csrf
                <div class="input-group mb-3">
                    <select class="form-select m-4" name="group-name" aria-label="Пример выбора по умолчанию" required>
                        <option value="">Выберите группу карточки</option>
                        <option value="hair">Для волос</option>
                        <option value="face">Для лица</option>
                        <option value="body">Для тела</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Заголовок</span>
                    <input type="text" name="name" class="form-control" placeholder="Название товара" aria-label="Название товара" aria-describedby="basic-addon1" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Описание</span>
                    <textarea name="description" class="form-control" placeholder="Описание товара" aria-label="Описание товара" required></textarea>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Состав</span>
                    <textarea name="composition" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения" required></textarea>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Цена</span>
                        <input type="text" name="price" class="form-control" placeholder="Цена товара" aria-label="Цена товара" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Объем</span>
                        <input type="text" name="volume" class="form-control" placeholder="Объем товара" aria-label="Объем товара" aria-describedby="basic-addon1" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="basic-url" class="form-label">Загрузить фото карточки</label>
                    <div class="input-group mb-3">
                        <input type="file" name="photo" id="photo" class="form-control">
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
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="border-radius: 5px;">
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
            <div id="toggle-muse-{{ $item['id'] }}" class="d-none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3 mt-4">
                            <label class="input-group-text" for="inputGroupSelect01">Категория</label>
                            <select class="form-select" id="inputGroupSelect01" name="group-name" aria-label="Пример выбора по умолчанию" required>
                                <option value="{{ $item['category'] }}">Изменить</option>
                                <option value="hair">Для волос</option>
                                <option value="face">Для лица</option>
                                <option value="body">Для тела</option>
                            </select>
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
                            <textarea name="description" class="form-control" placeholder="Описание товара" aria-label="Описание товара">{{ $item['description'] }}</textarea>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <textarea name="composition" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">{{ $item['composition'] }}</textarea>
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

                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Загрузить фото карточки</label>
                            <div class="input-group mb-3">
                                <input type="file" name="photo" id="photo" class="form-control">
                            </div>
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
        @foreach($faces as $item)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="border-radius: 5px;">
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
            <div id="toggle-gel-{{ $item['id'] }}" class="d-none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3 mt-4">
                            <label class="input-group-text" for="inputGroupSelect01">Категория</label>
                            <select class="form-select" id="inputGroupSelect01" name="group-name" aria-label="Пример выбора по умолчанию" required>
                                <option value="{{ $item['category'] }}">Изменить</option>
                                <option value="hair">Для волос</option>
                                <option value="face">Для лица</option>
                                <option value="body">Для тела</option>
                            </select>
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
                            <textarea name="description" class="form-control" placeholder="Описание товара" aria-label="Описание товара">{{ $item['description'] }}</textarea>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <textarea name="composition" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">{{ $item['composition'] }}</textarea>
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

                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Загрузить фото карточки</label>
                            <div class="input-group mb-3">
                                <input type="file" name="photo" id="photo" class="form-control">
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
        @foreach($bodies as $item)
            <div class="mt-2 d-flex flex-wrap h-auto align-items-center justify-content-between border" style="border-radius: 5px;">
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
            <div id="toggle-scrab-{{ $item['id'] }}" class="d-none">
                <div class="mt-2 d-flex align-items-center justify-content-between border-1">
                    <form action="{{ url('admin/edit/') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                        @csrf
                        <div class="input-group mb-3 mt-4">
                            <label class="input-group-text" for="inputGroupSelect01">Категория</label>
                            <select class="form-select" id="inputGroupSelect01" name="group-name" aria-label="Пример выбора по умолчанию" required>
                                <option value="{{ $item['category'] }}">Изменить</option>
                                <option value="hair">Для волос</option>
                                <option value="face">Для лица</option>
                                <option value="body">Для тела</option>
                            </select>
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
                            <textarea name="description" class="form-control" placeholder="Описание товара" aria-label="Описание товара">{{ $item['description'] }}</textarea>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Состав</span>
                            <textarea name="composition" class="form-control" placeholder="Состав товара, условия хранения" aria-label="Состав товара, условия хранения">{{ $item['composition'] }}</textarea>
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

                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Загрузить фото карточки</label>
                            <div class="input-group mb-3">
                                <input type="file" name="photo" id="photo" class="form-control">
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
    document.addEventListener('DOMContentLoaded', function() {
        // Общие элементы
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const btnCreateCard = document.getElementById('btn-create-card');
        const createCardSection = document.getElementById('create-card');

        // 1. Инициализация toggle-кнопок (оптимизированная версия)
        function initToggles(items, prefix = '') {
            items.forEach(item => {
                const toggleBtn = document.querySelector(`[data-id="${item.id}"].toggle-btn`);
                if (toggleBtn) {
                    toggleBtn.checked = item.popular === 1;
                }
            });
        }

        @foreach(['hairs', 'faces', 'bodies'] as $collection)
        initToggles(@json($$collection->toArray()));
        @endforeach

        // 2. Кнопка создания карточки (с использованием classList)
        if (btnCreateCard && createCardSection) {
            btnCreateCard.addEventListener('click', () => {
                createCardSection.classList.toggle('d-none');
            });
        }

        // 3. Делегирование событий для кнопок редактирования
        function setupEditHandlers(containerId, btnPrefix, togglePrefix) {
            const container = document.getElementById(containerId);
            if (container) {
                container.addEventListener('click', (e) => {
                    if (e.target.id.startsWith(btnPrefix)) {
                        const id = e.target.id.replace(btnPrefix, '');
                        const toggleElement = document.getElementById(`${togglePrefix}${id}`);
                        if (toggleElement) {
                            toggleElement.classList.toggle('d-none');
                        }
                    }
                });
            }
        }

        setupEditHandlers('list-muses', 'btn-edit-muse-', 'toggle-muse-');
        setupEditHandlers('list-gels', 'btn-edit-gel-', 'toggle-gel-');
        setupEditHandlers('list-scrabs', 'btn-edit-scrab-', 'toggle-scrab-');

        // 4. Переключение между вкладками (оптимизированная версия)
        const tabs = {
            'tag-muse': {
                list: 'list-muses',
                link: 'src-muse',
                inactiveLists: ['list-gels', 'list-scrabs'],
                inactiveLinks: ['src-gel', 'src-scrab']
            },
            'tag-gel': {
                list: 'list-gels',
                link: 'src-gel',
                inactiveLists: ['list-muses', 'list-scrabs'],
                inactiveLinks: ['src-muse', 'src-scrab']
            },
            'tag-scrab': {
                list: 'list-scrabs',
                link: 'src-scrab',
                inactiveLists: ['list-muses', 'list-gels'],
                inactiveLinks: ['src-muse', 'src-gel']
            }
        };

        Object.entries(tabs).forEach(([tabId, config]) => {
            const tab = document.getElementById(tabId);
            if (tab) {
                tab.addEventListener('click', () => {
                    // Активируем текущую вкладку
                    document.getElementById(config.list).classList.remove('d-none');
                    document.getElementById(config.link).classList.add('active');

                    // Деактивируем остальные
                    config.inactiveLists.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.add('d-none');
                    });

                    config.inactiveLinks.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.remove('active');
                    });
                });
            }
        });

        // 5. Обработка toggle-кнопок с улучшенным fetch
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('change', function() {
                const id = this.dataset.id;

                fetch('{{ url('admin/instock') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ id: id })
                })
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Успешно:', data);
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                        this.checked = !this.checked;
                    });
            });
        });
    });
</script>
@endsection

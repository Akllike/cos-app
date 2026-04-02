@extends('layouts.layout')
@extends('header')
@section('title', 'О нас | ShaR')
@section('content')
    <style>
        .about-hero {
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
            border-radius: 10px;
        }

        .about-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 50% 50%;
        }

        .about-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .about-hero-title {
            color: white;
            font-size: 48px;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .zoomable {
            transition: transform 0.3s;
        }

        .zoomable:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="container">
        <div class="about-hero">
            <img src="{{ url('storage/img/orig.webp') }}" alt="" />
            <div class="about-hero-overlay">
                <h1 class="about-hero-title">О Нас</h1>
            </div>
        </div>
        <div class="about-info" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 30px;">
            <div class="about-block" style="flex: 1 1 300px; min-width: 280px;">
                <img src="{{ url('storage/img/navbar.jpg') }}" alt="Уход за лицом" style="width:100%; border-radius:10px; object-fit:cover; height:180px; margin-bottom: 20px;" />
                <p>Наша компания разрабатывает уходовую косметику в собственной профессиональной лаборатории. Каждый продукт проходит строгий контроль качества и тестирование на эффективность.</p>
            </div>
            <div class="about-block" style="flex: 1 1 300px; min-width: 280px;">
                <img src="{{ url('storage/img/navbar.jpg') }}" alt="Уход за телом" style="width:100%; border-radius:10px; object-fit:cover; height:180px; margin-bottom: 20px;" />
                <p>Мы производим косметику для лица, тела, волос, а также масла и скрабы. Формулы учитывают разные типы кожи и волосы, чтобы подарить комфорт и здоровье.</p>
            </div>
            <div class="about-block" style="flex: 1 1 300px; min-width: 280px;">
                <img src="{{ url('storage/img/navbar.jpg') }}" alt="Уход за волосами" style="width:100%; border-radius:10px; object-fit:cover; height:180px; margin-bottom: 20px;" />
                <p>Мы уделяем внимание натуральным компонентам и лабораторным исследованиям. Наша продукция помогает восстановить волосы и укрепить кожу с первого использования.</p>
            </div>
            <div class="about-block" style="flex: 1 1 300px; min-width: 280px;">
                <img src="{{ url('storage/img/navbar.jpg') }}" alt="Масла и скрабы" style="width:100%; border-radius:10px; object-fit:cover; height:180px; margin-bottom: 20px;" />
                <p>В ассортименте есть масла и скрабы с мягкой текстурой, которые идеально сочетаются с профессиональными процедурами. Мы стремимся к гармонии природных ингредиентов и современных технологий.</p>
            </div>
        </div>
        <div class="about-section" style="display: flex; align-items: center; gap: 20px; margin-top: 30px;">
            <div class="text" style="flex: 1;">
                <p style="font-size: 20px;">В основе нашей уходовой косметики лежат только натуральные ингредиенты, бережно собранные природой. Мы полностью исключаем агрессивные химические добавки, парабены и синтетические отдушки, чтобы не нарушать естественный баланс кожи. Каждое средство работает за счет силы растительных экстрактов и масел, даря мягкое, но эффективное очищение и увлажнение. Выбирая натуральный состав, вы дарите своей коже здоровье без риска раздражения и аллергических реакций.
                </p>
            </div>
            <div class="image" style="flex: 1;">
                <img src="{{ url('storage/img/bodies.webp') }}" alt="" style="width: 100%; height: auto; border-radius: 10px;" class="zoomable" />
            </div>
        </div>
        <div class="about-section" style="display: flex; align-items: center; gap: 20px; margin-top: 30px;">
            <div class="image" style="flex: 1;">
                <img src="{{ url('storage/img/hairs.webp') }}" alt="" style="width: 100%; height: auto; border-radius: 10px;" class="zoomable" />
            </div>
            <div class="text" style="flex: 1;">
                <p style="font-size: 20px;">При создании этой косметики применяются передовые биотехнологии и нано-эмульсионные методы, позволяющие активным компонентам проникать в самые глубокие слои кожи. Высокоточное дозирование и крио-экстракция гарантируют максимальную эффективность и свежесть каждого ингредиента без потери его свойств. Использование интеллектуальных систем доставки активов обеспечивает пролонгированный результат и точечное воздействие на проблемные зоны. Такой высокотехнологичный подход сочетает инновации науки с заботой о здоровье вашей кожи.</p>
            </div>
        </div>
    </div>
    
@endsection
@extends('footer')

@extends('layouts.app')
@section('content')
    <div class="container w-75">
        <a href="{{ route('home') }}" class="btn btn-primary m-2">Назад</a>
        <h2>Заказы</h2><p>(Последние 10 заказов)</p>
        <div class="d-flex flex-column mt-4">
            @foreach($data as $item)
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <p>{{ date('d.m.Y', $item['date']) }} </p>
                    <p>{{ $item['name'] }} </p>
                    <p>{{ $item['number'] }} </p>
                    <p>
                        @foreach(explode(";", $item['products']) as $key)
                            {{ $key }}<br>
                        @endforeach
                    </p><br>
                </div>
            @endforeach
        </div>
    </div>
@endsection

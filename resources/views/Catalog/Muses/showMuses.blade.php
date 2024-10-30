@extends('layouts.layout')
@extends('header')
@section('title', 'Musses page id')
@section('content')
    <p>{{ $muses['name'] }} - {{ $muses['description'] }}: {{ $muses['price'] }} рублей</p>
@endsection
@extends('footer')

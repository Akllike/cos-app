@extends('layouts.layout')
@extends('header')
@section('title', 'Scrabs page id')
@section('content')
    <p>{{ $scrabs['name'] }} - {{ $scrabs['description'] }}: {{ $scrabs['price'] }} рублей</p>
@endsection
@extends('footer')

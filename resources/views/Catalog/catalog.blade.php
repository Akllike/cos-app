@extends('layouts.layout')
@extends('header')
@section('title', 'Catalog page')
@section('content')
    @foreach($products as $product => $key)
        {{$key['name']}}
    @endforeach
@endsection
@extends('footer')

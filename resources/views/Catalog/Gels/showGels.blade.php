@extends('layouts.layout')
@extends('header')
@section('title', 'Gels page id')
@section('content')
    <p>{{ $gels['name'] }} - {{ $gels['description'] }}: {{ $gels['price'] }} рублей</p>
@endsection
@extends('footer')

@extends('layout')

@section('title','Создание блога')
<link rel="stylesheet" href="{{asset('css/app.css')}}">

@section('content')
    <ul>
        <li>
            @include('partials.Tree.category')
        </li>
    </ul>
    <a href="{{route('create')}}"> Создать </a>
@endsection

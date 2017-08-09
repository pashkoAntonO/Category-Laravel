@extends('layouts.master')

@section('title','Создание блога')
<link rel="stylesheet" href="{{asset('css/app.css')}}">

@section('content')
    <ul>
        <li>
            @include('partials.Tree.category')
        </li>
    </ul>
    <a href="{{ URL::to('create') }}"> Создать </a>
@endsection

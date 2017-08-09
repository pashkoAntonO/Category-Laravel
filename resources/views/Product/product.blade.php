@extends('layouts.master')

@section('title','Создание блога')


@section('content')
    <div>
    @include('partials.Product.current_product')
    </div>

<div> {{$product->title}}</div>
<div> {{$product->price}}</div>
@endsection

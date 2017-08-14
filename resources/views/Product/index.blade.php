@extends('layouts/admin_master')

@section('title')

@section('content')

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID товара</th>
            <th>ID категории</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Картинка</th>
            <th>Описание</th>
            <th> Управление</th>

        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->category_id}}</td>
                <td>{{$product->title}}</td>
                <td>{{$product->price}}</td>
                <td><img src="{{URL::asset('/storage/'.$product->image)}}" width="100" height="100" alt="">
                    <img src="http://your.url/img/picture.jpg">
                </td>
                <td>{{$product->description}}</td>
                    <td>
                        <a href="{{ URL::to( 'product/edit/'.$product->id)  }}" style="float: left; margin-right: 10px"
                           class="btn btn-warning"> Редактировать </a>

                        <a href="{{ URL::to('product/destroy/'.$product->id)  }}" style="float: left; margin-right: 10px"
                           class="btn btn-danger"> Удалить </a>


                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
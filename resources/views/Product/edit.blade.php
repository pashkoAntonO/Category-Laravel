@extends('layouts.admin_master')

@section('title','Создание блога')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@section('content')

    {{Form::model($currentProduct, array('route'=>array('product/update', $currentProduct->id), 'method'=>'POST') )}}


    {{ Form::hidden('parent_id', $currentProduct->category_id, ['id'=>'hidden_id'])}}
    {{ Form::hidden('image', $currentProduct->image, ['id'=>'hidden_image'])}}

    <div class="form-group col-md-7">
        <div class="col-md-2">
            {{ Form::label('title', 'Название') }}
        </div>
        <div class="col-md-9">
            {{Form::text('title', $currentProduct->title, ['class' => 'form-control'])}}
        </div>
    </div>
    <div class="form-group col-md-7">
        <div class="col-md-2">
            {{ Form::label('price', 'Цена') }}
        </div>
        <div class="col-md-9">
            {{Form::text('price', $currentProduct->price, ['class' => 'form-control'])}}
        </div>
    </div>
    <div class="form-group col-md-7">
        <div class="col-md-2">
            {{ Form::label('description', 'Описание товара') }}
        </div>
        <div class="col-md-9">
            {{Form::textarea('description', $currentProduct->description, ['class' => 'form-control'])}}
        </div>
    </div>
    <div class="form-group col-md-7">
        <div class="col-md-2">
            {{ Form::label('image', 'Картинка') }}
        </div>
        <div class="col-md-9">
            {{Form::file('product', null )}}
        </div>
    </div>


    <div class="form-group col-md-7">
        <div class="col-md-2">
            Текущая картинка :
            <img src="{{URL::asset('/storage/'.$currentProduct->image)}}" width="200" height="200">
        </div>
    </div>

    <div class="form-group col-md-7">
        <div class="col-md-2">
            {{ Form::label('parent', 'Родительская ветка') }}
        </div>
        <div class="col-md-9">

            <select id="myParent">
                <option></option>
                @include('partials.Branch.select');
            </select>
        </div>
    </div>

    <div class="form-group col-md-7">
        <div class="col-md-offset-2 col-md-7">
            {{Form::submit('Изменить', ['class' => 'btn btn-success'])}}
        </div>
    </div>

    {!! Form::close() !!}

    <script>
        $("#myParent").change(function(){
            if($(this).val() == 0) return false;
            $('#hidden_id').val($(this).val());
        });

    </script>
@endsection
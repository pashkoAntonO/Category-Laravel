@extends('layouts.admin_master')

@section('title','Создание блога')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@section('content')

    {!! Form::open(['route' => 'product/store','enctype'=>"multipart/form-data"] )!!}
    {{Form::hidden('parent_id', null, ['id'=>'hidden_id'])}}

    <div class="form-group col-md-7">
        <div class="col-md-2">
            {{ Form::label('title', 'Название') }}
        </div>
        <div class="col-md-9">
            {{Form::text('title', null, ['class' => 'form-control'])}}
        </div>
    </div>
    <div class="form-group col-md-7">
        <div class="col-md-2">
            {{ Form::label('price', 'Цена') }}
        </div>
        <div class="col-md-9">
            {{Form::text('price', null, ['class' => 'form-control'])}}
        </div>
    </div>
    <div class="form-group col-md-7">
        <div class="col-md-2">
            {{ Form::label('description', 'Описание товара') }}
        </div>
        <div class="col-md-9">
            {{Form::textarea('description', null, ['class' => 'form-control'])}}
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
            {{Form::submit('Создать товар', ['class' => 'btn btn-success'])}}
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
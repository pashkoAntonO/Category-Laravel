@extends('layout')

@section('title','Создание блога')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@section('content')

    {!! Form::open(['route' => 'store', 'method'=>'POST'])!!}
    {{ csrf_field() }}

    <input type="hidden" name="parent_id" id="hidden_id" >
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
            {{ Form::label('description', 'Родительская ветка') }}
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
            {{Form::submit('Опубликовать', ['class' => 'btn btn-primary'])}}
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
{{-- Если поставить инкремент в параметр, то нарушается логика, его нужно инкрементировать в теле --}}
{{++$lvl}}
{{-- Перебор веток --}}
@foreach ($tree as $branch)
    {{--Если id совпадает, то продолажать движение вниз не нежно--}}
@if($branch->id != $id)
    {{-- Вывод, от лвл зависит отступ --}}
<option value="{{$branch->id}}"> {{str_repeat('-----', $lvl)}}   {{$branch->title}}</option>

@include('partials.Branch.innerSelect', ['tree' => $branch['children'], 'lvl'=>$lvl, 'id'=>$id]);

@endif
@endforeach

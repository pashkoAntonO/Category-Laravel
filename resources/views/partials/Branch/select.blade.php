{{--Перебор веток--}}
@foreach ($tree as $branch)
    {{--Добавление в select категории со значением id, и названия  --}}
    <option value="{{$branch->id}}">{{$branch->title}}</option>
    {{--Запуск рекурсии для перебора веток  --}}
    @include('partials.Branch.innerSelect', ['tree' => $branch['children'], 'lvl'=>++$lvl, 'id'=> isset($element)?$element->id:NULL]);
@endforeach
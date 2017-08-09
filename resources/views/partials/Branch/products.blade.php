{{--Вывод навигационного меню--}}
@for($i=0; $i<count($paths)-1; $i++)
    <a href={{ URL::to('/' . $paths[$i]) }}>{{$title[$i]}}</a> ->
@endfor
{{$title[count($paths)-1]}}

{{--Перебор всех продуктов--}}
@foreach ($products as $product)
<div>   {{ $product->title }}  -  {{$product->price}}  </div> <a href="{{'/'.$path.'/'.$product->slug}}"> Посмотреть </a>
@endforeach



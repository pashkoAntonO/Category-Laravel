    @for ($i=0; $i<count($paths); $i++)
    <a href="{{ URL::to('/'.$paths[$i]) }}">{{$link[$i]}} </a>->
    @endfor
    {{$link[count($paths)]}}

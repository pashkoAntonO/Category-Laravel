    @for ($i=0; $i<count($paths); $i++)
    <a href="/{{$paths[$i]}}">{{$link[$i]}} </a>->
    @endfor
    {{$link[count($paths)]}}

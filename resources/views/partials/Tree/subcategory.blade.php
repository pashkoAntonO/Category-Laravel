@foreach ($tree as $value)
@if (isset($value['children'][0]))
<ul>
    <li>

        <a href="{{ URL::to($value->path) }}">{{$value->title}}</a>
        <a href="{{ URL::to('edit?id='.$value->id) }}"> Изментить </a>
        @include('partials.Tree.subcategory', ['tree' => $value['children']])
    </li>
</ul>
@else
<ul>
    <li>
        <a href="{{ URL::to($value->path) }}">{{$value->title}}</a>
        <a href="{{ URL::to('edit?id='.$value->id) }}"> Изментить </a></div>
    </li>
</ul>
@endif
@endforeach


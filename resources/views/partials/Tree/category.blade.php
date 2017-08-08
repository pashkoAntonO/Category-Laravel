@foreach ($tree as $value)
    <div  class="link"> {{$value->title}}</div>
    @include('partials.Tree.subcategory', ['tree' => $value['children']]);
@endforeach

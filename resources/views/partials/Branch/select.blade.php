<?php
$lvl = 0;
?>

@foreach ($tree as $branch)
    <option value="{{$branch->id}}">{{$branch->title}}</option>
    @include('partials.Branch.innerSelect', ['tree' => $branch['children'], 'lvl'=>$lvl, 'id'=> NULL]);
@endforeach
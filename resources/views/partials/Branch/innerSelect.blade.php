<?php
$lvl++;
?>
@foreach ($tree as $branch)
@if($branch->id != $id)
<option value="{{$branch->id}}"> {{str_repeat('-----', $lvl)}}   {{$branch->title}}</option>
@include('partials.Branch.innerSelect', ['tree' => $branch['children'], 'lvl'=>$lvl, 'id'=>$id]);
@endif
@endforeach

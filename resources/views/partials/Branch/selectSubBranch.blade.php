
{{$lvl++}}
@foreach ($tree as $value)
@if($value->id != $id){
<option value="{{$value->id}}"> {{str_repeat('-----', $lvl)}}   {{$value->title}}</option>
@include('partials.Branch.selectSubBranch', ['tree' => $value['children'], 'lvl'=>$lvl, 'id'=>$id]);
@endif
@endforeach
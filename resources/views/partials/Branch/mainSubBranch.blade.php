
@foreach ($tree as $value)
<option value="{{$value->id}}">{{$value->title}}</option>
@include('partials.Branch.selectSubBranch', ['tree' => $value['children'], 'lvl'=>$lvl, 'id'=> $element->id])
@endforeach
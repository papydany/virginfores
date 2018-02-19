@extends('layouts.main')
@section('title','Edit Activity Flow')
@section('content')
@inject('r','App\General') 
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit Activity Flow</li>
</ol>	
<div class="row">
<div class="col-lg-6">

<div class="card card-default">
<div class="card-header "><?php $act = $r->getActivity($a->activity_id);
$depart= $r->getDepartment($a->department_id);
 ?>
	
<div class="card-title">Edit Activity Flow &nbsp;&nbsp; <b> {{$act}} </b>
	&nbsp;&nbsp;Department <b class="text-success">{{$depart}}</b>
	&nbsp;&nbsp;Step <b class="text-success">{{$a->step}}</b>
</div>

</div>
<div class="card-block">




<form class="" role="form" method="POST" action="{{url('updateActivityFlow',$id) }}">
		{{ csrf_field() }}
	
<div class="form-group form-group-default form-group-default-select2 required">
<label class="">Designation</label>
<select class="full-width" data-placeholder="Select Designation" data-init-plugin="select2" name="desination_id" required>
<option value="">Select Designation</option>

@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
<div class="form-group col-sm-6">
<select class="full-width" data-placeholder="When rejected Notify User" data-init-plugin="select2" name="reject_status" required="">
<option value="">When rejected Notify User</option>
<option value="1">No</option>
<option value="2">Yes</option>
</select>
</div>
 <div class="form-group col-sm-6">
<select class="full-width" data-placeholder="When Approved Notify User" data-init-plugin="select2" name="approved_status" required="">
<option value="">When Approved Notify User</option>
<option value="1">No</option>
<option value="2">Yes</option>
</select>
</div>
 <div class="form-group col-sm-6">
<select class="full-width" data-placeholder="Line Manager can Edit" data-init-plugin="select2" name="edit_status" required="">
<option value="">Line Manager can Edit</option>
<option value="1">No</option>
<option value="2">Yes</option>
</select>
</div>
<br/>
<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-warning" type="submit">Update</button>
</div>
</div>


</form>
</div>
</div>

</div>

</div>
</div>
@endsection
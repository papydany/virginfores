@extends('layouts.main')
@section('title','Activity Flow')
@section('content')
@inject('r','App\General')
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Activity Flow</li>
</ol>	
<div class="row">
<div class="col-lg-4">

<div class="card card-default">
<div class="card-header ">
<div class="card-title">Activity Flow
</div>
<div class="tools">
<a class="collapse" href="javascript:;"></a>
<a class="config" data-toggle="modal" href="#grid-config"></a>
<a class="reload" href="javascript:;"></a>
<a class="remove" href="javascript:;"></a>
</div>
</div>
<div class="card-block">




<form class="" role="form" method="POST" action="{{url('newActivityFlow') }}">
		{{ csrf_field() }}
	
<div class="form-group form-group-default form-group-default-select2 required">

<select class="full-width" data-placeholder="Select Activity" data-init-plugin="select2" name="activity_id">
<option value="">Select Activity</option>

@if(isset($a))
@foreach($a as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
<p>Enter Number of Step </p>
<div class="input-group">
<input type="Number" class="form-control" name="step" required="">
<span class="input-group-addon primary">
<i class="fa fa-align-justify"></i>
</span>
</div>
<br/>
<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">Continue</button>
</div>
</div>


</form>
</div>
</div>

</div>
@if(isset($s))
 <?php 
$activity= $r->getActivity($aid);

  ?>	
<div class="col-lg-8">

<div class="card card-default">
<div class="card-header ">
<div class="card-title">Assign Line Manager To process Flow (<b class="text-success">{{$activity}}</b>)
</div>
<div class="tools">
<a class="collapse" href="javascript:;"></a>
<a class="config" data-toggle="modal" href="#grid-config"></a>
<a class="reload" href="javascript:;"></a>
<a class="remove" href="javascript:;"></a>
</div>
</div>
<div class="card-block">
<div class="row">
<div class="col-md-12">


<form role="form" method="POST" action="{{url('submitActivityFlow') }}">
	{{ csrf_field() }}
	<input type="hidden" name="activity_id" value="{{$aid}}">
	<div class="form-group">

 <div class="col-sm-6">
<select class="full-width" data-placeholder="Select Department" data-init-plugin="select2" name="department_id" required="">
<option value="">Select Department</option>

@if(isset($dt))
@foreach($dt as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>
</div>
</div>


	@for($i = 1 ;$i <= $s; $i++)
<div class="form-group">
<input type="hidden"  name="step[{{$i}}]"  value="{{$i}}">	
<label class="label-lg col-sm-4">Step {{$i}}</label>
 <div class="col-sm-6">
<select class="full-width" data-placeholder="Select Designation" data-init-plugin="select2" name="desination_id[{{$i}}]" required="">
<option value="">Select Designation</option>

@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>
</div>
</div>
 <div class="form-group col-sm-6">
<select class="full-width" data-placeholder="When rejected Notify User" data-init-plugin="select2" name="reject_status[{{$i}}]" required="">
<option value="">When rejected Notify User</option>
<option value="1">No</option>
<option value="2">Yes</option>
</select>
</div>
 <div class="form-group col-sm-12">
<select class="full-width" data-placeholder="When Approved Notify User" data-init-plugin="select2" name="approved_status[{{$i}}]" required="">
<option value="">When Approved Notify User</option>
<option value="1">No</option>
<option value="2">Yes</option>
</select>
</div>
 <div class="form-group col-sm-6">
<select class="full-width" data-placeholder="Line Manager can Edit" data-init-plugin="select2" name="edit_status[{{$i}}]" required="">
<option value="">Line Manager can Edit</option>
<option value="1">No</option>
<option value="2">Yes</option>
</select>
</div>


	@endfor

<div class="col-sm-6">
<div class="form-group">
<button class="btn btn-primary" type="submit">Submit</button>
</div>
</div>
</form>
</div>

</div>
</div>
</div>

</div>
@endif
</div>
</div>
@endsection
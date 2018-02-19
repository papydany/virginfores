@extends('layouts.main')
@section('title','View Staff')
@section('content')
@inject('r','App\General') 
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">View Staff</li>
</ol>

<div class=" container-fluid   container-fixed-lg bg-white" style="padding-top: 40px; padding-bottom: 20px;">
<div class="col-md-12">
<div class="col-sm-12">	
<form class="" role="form" method="GET" action="{{url('viewStaff12') }}">
		{{ csrf_field() }}
<div class="col-sm-6">		
<div class="form-group form-group-default form-group-default-select2 required">
<label class="">Department</label>
<select class="full-width" data-placeholder="Select Department" data-init-plugin="select2" name="department_id">
<option value="">Select Department</option>
<option value="All">All Department</option>
@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">Continue</button>
</div>
</div>
</form>
</div>

	@if(isset($u))
	@if(count($u))
	{{!$c = 1}}
<div class="card card-transparent">
<div class="card-header ">
<div class="card-title">Staff
</div>
</div>
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>

<th style="color: #000;width:5%;">S\N</th>
<th style="color: #000;">Name</th>
<th style="color: #000;">Email</th>
<th style="color: #000;">Password</th>
<th style="color: #000;">Phone</th>
<th style="color: #000;">Department</th>
<th style="color: #000;">Designation</th>
<th style="color: #000;">Status</th>
<th style="color: #000;">Action</th>

</tr>
</thead>
<tbody>
	@foreach($u as $v)
	<?php $desination =$r->getDesination($v->desination_id);
   $department =$r->getDepartment($v->department_id);
	?>
<tr>
<td>{{$c ++}}</td>
<td>{{$v->name}}</td>
<td>{{$v->email}}</td>
<td>{{$v->word}}</td>
<td>{{$v->phone}}</td>
<td>{{$department}}</td>
<td>{{$desination}}</td>
<td>@if($v->status == 1)
	<span class="text-success">Active</span>
@elseif($v->status ==2)
<span class="text-danger">Not Active</span>
@else 
<span class="text-danger">Admin</span>
@endif</td>
<td>
  @if(Auth::user()->id == $v->id)
  @else
<div class="dropdown dropdown-default">
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Action
</button>
<div class="dropdown-menu col-sm-12">
 <a class="text-success  dropdown-item" href="{{url('editStaff',$v->id)}}">Edit</a> 
 @if($v->status == 1) 
<a class="text-danger dropdown-item" href="{{url('statusStaff',[$v->id,$v->status])}}">
  Deactivate</a>
@elseif($v->status == 2)
<a class="text-primary dropdown-item" href="{{url('statusStaff',[$v->id,$v->status])}}">
  Activate</a>
@endif
<a class="text-danger dropdown-item" href="{{url('removeStaff',$v->id)}}">Remove</a>
</div>
</div>
@endif
</td>

</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@else
<div class=" col-sm-10 col-sm-offset-1 alert alert-danger" role="alert" >
      No Records Available
    </div>
@endif
@endif
</div>
</div>
@endsection
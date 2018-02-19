@extends('layouts.main')
@section('title','Edit Staff')
@section('content')
	
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit Staff</li>
</ol>
<div class=" container-fluid   container-fixed-lg bg-white">
	<div class="col-md-8">


<div class="card card-transparent">
<div class="card-block">
<form id="form-personal" role="form" method="POST" action="{{url('updateStaff',$u->id) }}">
	{{ csrf_field() }}
<div class="row clearfix">
<div class="col-sm-12">
<div class="form-group">
<label>Staff name</label>
<input type="text" class="form-control" name="name" value="{{$u->name}}" required>
</div>
</div>

</div>
<div class="row clearfix">
<div class="col-sm-12">
<div class="form-group">
<label>Phone</label>
<input type="text" class="form-control" name="phone" value="{{$u->phone}}" required>
</div>
</div>

</div>

<div class="form-group ">
<label>Email</label>
<input type="email" name="email" class="form-control" value="{{$u->email}}"  required>
</div>



<div class="form-group">
<label class="">Department</label>
<select class="full-width" data-placeholder="Select Department" data-init-plugin="select2" name="department_id" required="">
<option value="">Select Department</option>
@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>
</div>
<div class="form-group">
<label class="">Desination</label>
<select class="full-width" data-placeholder="Select Desination" data-init-plugin="select2" name="desination_id" required="">
<option value="">Select Desination</option>
@if(isset($ds))
@foreach($ds as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>
</div>

<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">Update Staff</button>
</div>
</div>
</form>
</div>
</div>
</div>

</div>


@endsection
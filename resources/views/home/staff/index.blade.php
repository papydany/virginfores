@extends('layouts.main')
@section('title','New Staff')
@section('content')
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">New Staff</li>
</ol>

<div class="row">
<div class="col-lg-6">

<div class="card card-default">

<div class="card-block">
<h5 class="text-success">
New Staff
</h5>
<form class="" role="form" method="POST" action="{{url('newStaff') }}">
		{{ csrf_field() }}

<div class="row">
<div class="col-md-6">
<div class="form-group form-group-default required">
<label>First name</label>
<input type="text" class="form-control" name="fn" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Last name</label>
<input type="text" class="form-control" name="ln">
</div>
</div>
</div>

<div class="form-group form-group-default required ">
<label>Phone</label>
<input type="text" class="form-control" name="phone" required>
</div>

<div class="form-group  form-group-default required">
<label>Email</label>
<input type="email" name="email" class="form-control" placeholder="ex: some@example.com" required>
</div>

<div class="form-group form-group-default required">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="form-group form-group-default form-group-default-select2 required">
<label class="">Department</label>
<select class="full-width" data-placeholder="Select Department" data-init-plugin="select2" name="department_id">

@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>
</div>
<div class="form-group form-group-default form-group-default-select2 required">
<label class="">Designation</label>
<select class="full-width" data-placeholder="Select Desination" data-init-plugin="select2" name="desination_id">

@if(isset($ds))
@foreach($ds as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>
</div>
<div class="col-sm-12">
<div class="form-group">
<button class="btn btn-primary" type="submit">Create Staff</button>
</div>
</div>
</form>
</div>
</div>	


</div>

</div>




@endsection
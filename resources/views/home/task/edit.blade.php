@extends('layouts.main')
@section('title','Edit Task')
@section('content')
@inject('r','App\General') 

<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit Task</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">
<div class="col-sm-5">
<div class="card card-default">	
<form class="" role="form" method="POST" action="{{url('updatetask',$t->id) }}">
		{{ csrf_field() }}
		<br/>

<div class="form-group col-sm-12">		
<div id="summernote"><textarea rows="10" class="form-control" name="content" placeholder="Task" required>{{$t->content}}</textarea></div>
</div>
<div class="form-group col-sm-12">
<div class="form-group form-group-default input-group col-sm-12">
<div class="form-input-group">
<label>Start Date</label>
<input type="text" class="form-control" placeholder="Pick a date" id="datepicker-component2" name="start_date" value="{{$t->start_date}}" required>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>
</div>

<div class="form-group col-sm-12">
<div class="form-group form-group-default input-group col-sm-12">
<div class="form-input-group">
<label>End Date</label>
<input type="text" class="form-control" placeholder="Pick a date" id="datepicker-component2" name="end_date" value="{{$t->end_date}}" required>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>
</div>
<div class="form-group col-sm-12">
<select class="form-control" name="staff_id" required="">
<option value="">Assign Staff</option>

@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>

<div class="form-group col-sm-6">

<button class="btn btn-warning" type="submit">Update Task</button>
</div>
</form>
</div>
</div>

</div>
	

	
</div>



@endsection
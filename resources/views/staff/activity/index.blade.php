@extends('layouts.main')
@section('title','New Activity')
@section('content')
@inject('r','App\General') 
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">New Activity</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">

<div class="col-md-6">
	@if(isset($f))
	@if(count($f))
<?php $activity =$r->getActivity2($d)?>	
<div class="card card-card-default">
<div class="card-header ">
<div class="card-title">{{$activity->name}} &nbsp;Form
</div>
</div>
<div class="card-block">

<form method="POST" action="{{url('createActivity') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
<input type="hidden" name="activity_id" value="{{$d}}">	
@if(isset($lt))
<div class="form-group form-group-default form-group-default-select2">
<label class="">Leave Type</label>
<select class="full-width" data-placeholder="Select Leave Type" data-init-plugin="select2" name="LeaveType">
<option value=""></option>
@foreach($lt as $v)
<option value="{{$v->id}}">{{$v->name}}</option>

@endforeach
</select>
</div>
<div class="form-group">
<label class="">Number Of Days (<b>if its not maternity leave</b>)</label>
<input type="number" class="form-control" name="days" placeholder="enter numbers of days"/>
</div>
<div class="form-group form-group-default input-group col-md-12">
<div class="form-input-group">
<label>Expected start date</label>
<input type="text" class="form-control" placeholder="Pick a date" id="datepicker-component2" name="start_date" required>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>

<div class="form-group form-group-default input-group col-md-12">
<div class="form-input-group">
<label>Expected end date</label>
<input type="text" class="form-control" placeholder="Pick a date" id="datepicker-component2" name="end_date" required>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>

@endif
@foreach($f as $v)
<input type="hidden" name="id[{{$v->id}}]" value="{{$v->id}}">
 
@if($v->type =="input")

<div class="form-group form-group-default">

<label class="">{{$v->name}}</label>
<input type="text" class="form-control" name="name[{{$v->id}}]" @if($v->required == "1") required @endif />
</div>
@elseif($v->type =="textarea")
<div class="form-group">
<label class="">{{$v->name}}</label>
<textarea class="form-control" row="10" name="name[{{$v->id}}]" @if($v->required == "1") required @endif  ></textarea>
</div>
@elseif($v->type =="datepicker")
	

<div class="form-group form-group-default input-group col-md-12">
<div class="form-input-group">
<label>{{$v->name}}</label>
<input type="text" class="form-control" placeholder="Pick a date" id="datepicker-component2" name="name[{{$v->id}}]" 
@if($v->required == "1") required @endif>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>
@elseif($v->type =="select")

<div class="form-group form-group-default form-group-default-select2">


<label class="">{{$v->name}}</label>
<select class="full-width" data-placeholder="Select {{$v->name}}" data-init-plugin="select2" name="name[{{$v->id}}]" @if($v->required == "1") required @endif/>
<option value=""></option>

@if(!empty($v->option))
<?php   $a = explode(',', $v->option)?>
@foreach($a as $vv)
<option value="{{$vv}}">{{$vv}}</option>
@endforeach
@endif
</select>
</div>
@endif

@endforeach
	
@if($activity->name == 2)
<div class="form-group col-sm-12">
<input type="file" name="image" class="form-control">
</div>
@endif

<div class="form-group">
<button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>

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
</div>
@endsection
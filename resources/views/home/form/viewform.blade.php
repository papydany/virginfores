@extends('layouts.main')
@section('title','View Form')
@section('content')
@inject('r','App\General') 
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">View Form</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">

<div class="col-md-12">
	@if(isset($f))
	@if(count($f))
	
<div class="card card-card-default">

<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>

<th style="color: #000;width: 10px;">ID</th>
<th style="color: #000;">Name</th>
<th style="color: #000;">Belong To</th>
<th style="color: #000;">line manager</th>
<th style="color: #000;">Type</th>
<th style="color: #000;">Required</th>
<th style="color: #000;">Action</th>
</tr>
</thead>
@foreach($f as $v)
<?php $activity =$r->getActivity2($v->activity_id)?>
<tr>
	<td>{{$v->id}}</td>
	<td>{{$v->name}}</td>
	<td>{{$activity->name}}</td>
	<td>@if($activity->role == 1)
No
@else
Yes
@endif</td>
	<td>{{$v->type}}</td>
	<td>{{$v->required}}</td>
	<td>
<a href="{{url('editForm',$v->id)}}" class="btn btn-success btn-xs">
<i class="fs-10 fa fa-paint-brush"></i>
</a>
&nbsp;
<a href="{{url('removeForm',$v->id)}}" class="btn btn-danger btn-xs"><b>X</b></a></td>
</tr>

@endforeach

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
</div>
@endsection
@extends('layouts.main')
@section('title','Set leave Type')
@section('content')
 @inject('r','App\General')

<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Leave Type</li>
</ol>	
<div class="row">
<div class="col-lg-4">

<div class="card card-default">
<div class="card-header ">
<div class="card-title">leave Type
</div>
<div class="tools">
<a class="collapse" href="javascript:;"></a>
<a class="config" data-toggle="modal" href="#grid-config"></a>
<a class="reload" href="javascript:;"></a>
<a class="remove" href="javascript:;"></a>
</div>
</div>
<div class="card-block">




<form class="" role="form" method="POST" action="{{url('leavetype') }}">
		{{ csrf_field() }}
	
<div class="form-group form-group-default form-group-default-select2 required">
<label>Activity</label>
<select class="full-width" data-init-plugin="select2" name="activity_id" required>
<option value="">Select Leave Only</option>

@if(isset($a))
@foreach($a as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>

<div class="form-group form-group-default form-group-default-select2 required">

<select class="full-width" data-init-plugin="select2" name="leavecat_id" required>
<option value="">Select Leave Category</option>

@if(isset($lc))
@foreach($lc as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
<p>Leave Type</p>
<div class="input-group">
<input type="text" class="form-control" name="name" required="" placeholder="casual">
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

@if(isset($lt))
<div class="col-lg-8">

<div class="card card-default">
<div class="card-header ">
<div class="card-title">Leave Type
</div>

</div>

@if(count($lt))
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
<thead class="bg-success" >
<tr>

<th style="color: #000;width:10%;">S\N</th>
<th style="color: #000;">Activity</th>
<th style="color: #000;">Category</th>
<th style="color: #000;">Type</th>


</tr>
</thead>
<tbody>
	{{!$i = 1}}
	@foreach($lt as $v)
 <?php 
$activity= $r->getActivity($v->activity_id);
 $category =$r->getLeavecat($v->leavecat_id);
  ?>	
<tr>
<td class="v-align-middle">{{$i++}}</td>
<td class="v-align-middle ">{{$activity}}</td>
<td class="v-align-middle">{{$category->name}}</td>
<td class="v-align-middle ">{{$v->name}}</td>

</tr>
@endforeach
</tbody>
</table>
</div>
</div>
@else
<div class=" col-sm-10 col-sm-offset-1 alert alert-danger" role="alert" >
      No Records Available
    </div>
@endif


</div>
</div>
@endif

</div>
</div>
@endsection
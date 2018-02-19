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




<form class="" role="form" method="POST" action="{{url('viewActivityFlow') }}">
		{{ csrf_field() }}
	
<div class="form-group form-group-default form-group-default-select2 required">

<select class="full-width" data-placeholder="Select Activity" data-init-plugin="select2" name="activity_id" required>
<option value="">Select Activity</option>

@if(isset($a))
@foreach($a as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
<div class="form-group form-group-default form-group-default-select2 required">


<select class="full-width" data-placeholder="Select Department" data-init-plugin="select2" name="department_id" required="">
<option value="">Select Department</option>

@if(isset($dt))
@foreach($dt as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
<br/>

<div class="form-group">
<button class="btn btn-primary" type="submit">Continue</button>
</div>



</form>
</div>
</div>

</div>
@if(isset($f))
<div class="col-lg-8">

<div class="card card-default">

<div class="card-block">
<div class="row">
<div class="col-md-12">
<h5><?php $act = $r->getActivity($aid); 
$depart= $r->getDepartment($dpt);
?>
	Activity <b class="text-success">{{$act}}</b>&nbsp;&nbsp;Department <b class="text-success">{{$depart}}</b>
</h5>

<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>

<th style="color: #000;">Step</th>
<th style="color: #000;">Designation</th>

<th style="color: #000;">Edit Right</th>
<th style="color: #000;">Reject Notification</th>
<th style="color: #000;">Approve Notification</th>
<th style="color: #000;">Action</th>

</tr>
</thead>
<tbody>
@foreach($f as $v)
<?php $desination =$r->getDesination($v->desination_id) ?>
<tr>
<td class="v-align-middle ">{{$v->step}}</td>
<td class="v-align-middle ">{{$desination}}</td>
<td class="v-align-middle">{{$v->edit_status == 1 ?'No' :'Yes'}}</td>
<td class="v-align-middle">{{$v->reject_status == 1 ?'No' :'Yes'}}</td>
<td class="v-align-middle">{{$v->approved_status == 1 ?'No' :'Yes'}}</td>
<td class="v-align-middle">	
	<div class="dropdown dropdown-default">
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Action
</button>
<div class="dropdown-menu col-sm-12">
 
 <a class="text-success  dropdown-item"  href="{{url('editActivityFlow',$v->id)}}">Edit</a>
 <a  class="text-danger  dropdown-item" href="{{url('removeActivityFlow',$v->id)}}">Delete</a>

</div>
</div></td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>

</div>
</div>
</div>

</div>
@endif
</div>
</div>
@endsection
@extends('layouts.main')
@section('title','view Activity Details')
@section('content')
@inject('r','App\General') 
<?php $result= $r->getrolename(Auth::user()->id); ?>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">view Activity Details</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">
<div class="col-md-7">
	@if(isset($v))
	@if(count($v))
<?php $activity =$r->getActivity2($rs->activity_id);
// user info tha8t submit the form
$department =$r->getDepartment($u->department_id);
$name =$r->getUserName($u->id);
$designation =$r->getDesination($u->desination_id);
?>	
<div class="card card-card-default">
<div class="card-header ">
<div class="card-title">{{$activity->name}} &nbsp; Form
</div>
</div>
<div class="card-block">

@if($result =="Admin")
<table class="table table-bordered table-striped">
	<tr>
		<th>From </th>
		<th>{{$name->name}}</th>
	</tr>
	<tr>
		<th>Department </th>
		<th>{{$department}}</th>
	</tr>
	<tr>
		<th>Designation</th>
		<th>{{$designation}}</th>
	</tr>

</table>	
	
<hr/>
<form method="POST" action="{{url('submitcreateActivity') }}">
	{{ csrf_field() }}
<input type="hidden" name="rs" value="{{$rs->id}}">
<input type="hidden" name="status" value="{{$rs->status}}">

@if(!empty($ld))
<?php $l =$r->getleavetype($ld->leavetype_id);?>
<!-- edit right for activity flow -->
<p>Leave Type : &nbsp; <b>{{$l->name}}</b></p>
@if($af->edit_status == 2)
<div class="form-group">
<label class="">Number Of Days</label>
<input type="hidden" name="leavedetail_id" value="{{$ld->id}}">
<input type="number" class="form-control" name="confirm_days" value="{{$ld->days}}"/>
</div>

<div class="form-group form-group-default input-group col-md-12">
<div class="form-input-group">
<label>Expected start date</label>
<input type="text" class="form-control"  id="datepicker-component2" name="confirm_start_date" value="{{$ld->start_date}}" required>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>

<div class="form-group form-group-default input-group col-md-12">
<div class="form-input-group">
<label>Expected end date</label>
<input type="text" class="form-control"  id="datepicker-component2" name="confirm_end_date" value="{{$ld->end_date}}" required>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>

<!-- form  field is not edita8ble -->
@else
<table class="table table-bordered table-striped">
	<tr><td>Approved Numbers of days</td>
		<td>{{$ld->confirm_days}}</td>
	</tr>
	<tr><td>Approved Start Date</td>
		<td>{{$ld->confirm_start_date}}</td>
	</tr>
	<tr><td>Approved End Date : </td>
		<td>{{$ld->confirm_end_date}}</td>
	</tr>
</table>

@endif
@endif
<table class="table table-bordered table-striped">
	
@foreach($v as $vf)
<?php $formfield =$r->getformfield($vf->formfield_id);?>
<!-- edit right for activity flow -->
@if($af->edit_status == 2)
<!-- form  field is edita8ble -->
@if($formfield->editable == 2)
<input type="hidden" name="id[{{$vf->id}}]" value="{{$vf->id}}">
@if($formfield->type =="input")

<div class="form-group form-group-default">

<label class="">{{$formfield->name}}</label>
<input type="text" class="form-control" name="name[{{$vf->id}}]"  value="{{$vf->value}}" required/>
</div>
@elseif($formfield->type =="textarea")
<div class="form-group">
<label class="">{{$formfield->name}}</label>
<textarea class="form-control" row="10" name="name[{{$vf->id}}]"  required>{{$vf->value}}</textarea>
</div>
@elseif($formfield->type  =="datepicker")
<div class="form-group form-group-default input-group col-md-12">
<div class="form-input-group">
<label>{{$formfield->name}}</label>
<input type="text" class="form-control"  id="datepicker-component2" name="name[{{$vf->id}}]" 
 value="{{$vf->value}}" required>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>
@endif
<!-- form  field is not edita8ble -->
@else

<tr>
		<td>{{$formfield->name}}</td><td>{{$vf->value}}</td></tr>

@endif
<!-- No edit right for activity flow -->
@else

<tr>
		<td>{{$formfield->name}} </td><td>{{$vf->value}}</td></tr>

@endif
@endforeach

</table>
<hr/>


<div class="form-group">

<label for="yes">Comment</label>
<textarea class="form-control" rows="10" name="comment" placeholder="Official comment"></textarea>

</div>

<div class="col-sm-12">
<h5>Status</h5>
<div class="radio radio-success">
<input type="radio" value="2" name="flow_status" id="yes" checked="checked">
<label for="yes">Approve</label>
<input type="radio"  value="1" name="flow_status" id="no">
<label for="no">Reject</label>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<button class="btn btn-primary" type="submit">Submit</button>
</div>
</div>
</form>

@else
@if(!empty($ld))
<?php $l =$r->getleavetype($ld->leavetype_id);?>
<table class="table table-bordered table-striped">
	<tr><td>Leave Type</td>
		<td>{{$l->name}}</td>
	</tr>
	<tr><td>Numbers of days</td>
		<td>{{$ld->days}}</td>
	</tr>
</table>
<br/>
<table class="table table-bordered table-striped">
	<tr><td>Approved Numbers of days</td>
		<td>{{$ld->confirm_days}}</td>
	</tr>
	<tr><td>Approved Start Date</td>
		<td>{{$ld->confirm_start_date}}</td>
	</tr>
	<tr><td>Approved End Date : </td>
		<td>{{$ld->confirm_end_date}}</td>
	</tr>
</table>

@endif
<br/>
<table class="table table-bordered table-striped">
	<tr>
		<td>
@foreach($v as $vf)
<?php $formfield =$r->getformfield($vf->formfield_id);?>
<p>{{$formfield->name}} : &nbsp; <b>{{$vf->value}}</b></p>
@endforeach
</td>
</tr>
</table>
@endif


</div>
</div>
@endif
@endif
</div>

@if(isset($ad))
@if(count($ad))
<div class="col-sm-5">
<div class="card card-card-default">
<div class="card-header ">
<div class="card-title">Official Approved
</div>
</div>
<div class="card-block">	
<table class="table table-bordered table-striped">	
	@foreach($ad as $v)
	<?php 
// officia8l info
$name =$r->getUserName($v->user_id);
$designation =$r->getDesination($name->desination_id);
?>	
@if($result =="Admin")
<tr>
	<td>{{$name->name}}</td>
	<td>{{$designation}}</td>
	<td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal{{$v->id}}">Comment</button></td>
</tr>	
<div id="myModal{{$v->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>By {{$name->name}}</b></h4>

      </div>
      <div class="modal-body col-sm-12">
      <p>{{$v->comment}}</p>
     
   
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
      
      </div>
    </div>

  </div>
</div>
	
@elseif($result =="user")
<tr>
	<td>{{$name->name}}</td>
	<td>{{$designation}}</td>
	<td>{{$v->status == 2 ?'Approved' : 'Reject'}}</td>

</tr>
@endif
	@endforeach
</table>
	
</div>
</div>
</div>

@endif
@endif
</div>
</div>
@endsection	
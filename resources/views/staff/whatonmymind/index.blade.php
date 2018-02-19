@extends('layouts.main')
@section('title','What On My Mind')
@section('content')
@inject('r','App\General') 
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">What On My Mind</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">
<div class="col-sm-5">
<div class="card card-default">	
<form class="" role="form" method="POST" action="{{url('whatonmymind') }}">
		{{ csrf_field() }}
		<br/>

<div class="form-group col-sm-12">		
<div id="summernote"><textarea rows="10" class="form-control" name="content" placeholder="What on my mind" required></textarea></div>
</div>
<div class="form-group col-sm-6">
<select class="form-control" name="department_id" required="">
<option value="">Select Department</option>
<option value="0">All Department</option>
@if(Auth::user()->department_id == 0)
@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
@else
<option value="{{Auth::user()->department_id}}">Only My Department</option>
@endif
</select>

</div>

<div class="form-group col-sm-6">

<button class="btn btn-primary" type="submit">Post</button>
</div>
</form>
</div>
</div>
<div class="col-sm-7">
	@if(isset($p))
	
	
	<div class="card card-card-default">
<div class="card-header ">
<div class="card-title">Knowledge Base
</div>
</div>
@if(count($p) > 0)
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>
<th style="color: #000;width: 5px;">S/N</th>
<th style="color: #000;">Post</th>
<th style="color: #000;">Date Posted</th>
<th style="color: #000;">Posted By</th>
<th style="color: #000;width: 5px;">Action</th>
</tr>
</thead>
{{!$i =1}}
@foreach($p as $v)
<?php $user =$r->getUserName($v->user_id); ?>
<tr>
	<td>{{$i++}}</td>
	<td>{{substr($v->content,0,20)}}{{strlen($v->content) > 20 ? "....": " "}}</td>
    <td>{{date('F j , Y',strtotime($v->created_at))}}</td>
  <td>{{$user->name}}</td>
	<td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal{{$i}}">Read</button></td>
	
	
</tr>
<div id="myModal{{$i}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>By {{$user-name}}</b></h4>

      </div>
      <div class="modal-body col-sm-12">
      <p>{{$v->content}}</p>
     
   
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
       @if(Auth::user()->id == $v->user_id)
        <a href="{{url('editwhatonmymind',$v->id)}}" class="btn btn-primary btn-xs">Edit</a>
        <a href="{{url('removewhatonmymind',$v->id)}}" class="btn btn-danger btn-xs">Delete</a>
        @endif
      </div>
    </div>

  </div>
</div>

@endforeach
</table>

</div>
</div>
@else
<div class=" col-sm-10 col-sm-offset-1 alert alert-danger" role="alert" >
      No Records Available
    </div>
@endif
</div>
@endif
</div>
</div>
	

	
</div>



@endsection
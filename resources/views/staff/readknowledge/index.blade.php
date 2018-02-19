@extends('layouts.main')
@section('title','View Knowledge Base')
@section('content')
@inject('r','App\General') 
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">View Knowledge Base</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">

<div class="col-md-10">
	@if(isset($k))
	@if(count($k))
	
<div class="card card-card-default">
<div class="card-header ">
<div class="card-title">Knowledge Base
</div>
</div>
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>
<th style="color: #000;width: 5px;">S/N</th>
<th style="color: #000;">subject</th>
<th style="color: #000;">Date Posted</th>
<th style="color: #000;">Posted By</th>
<th style="color: #000;width: 5px;">Action</th>
</tr>
</thead>
{{!$i =1}}
@foreach($k as $v)
<?php $user =$r->getUserName($v->user_id); ?>
<tr>
	<td>{{$i++}}</td>
	<td>{{$v->subject}}</td>
    <td>{{date('F j , Y',strtotime($v->created_at))}}</td>
  <td>{{$user}}</td>
	<td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal{{$i}}">Read</button></td>
	
	
</tr>
<div id="myModal{{$i}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>{{$v->subject}}</b></h4>

      </div>
      <div class="modal-body col-sm-12">
      <p>{{$v->content}}</p>
     
   
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
               @if(!empty($v->image))
 <a href="{{url('getknowledgeBase_attachment',$v->id)}}" class="btn btn-primary btn-xs">View Attachement</a>
@endif
      </div>
    </div>

  </div>
</div>

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
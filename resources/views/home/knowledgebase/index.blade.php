@extends('layouts.main')
@section('title','Knowledge Base')
@section('content')
@inject('r','App\General') 
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Knowledge Base</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">
<div class="col-md-5">
<div class="card card-default">	
<form class="" role="form" method="POST" action="{{url('newknowledgeBase') }}" enctype="multipart/form-data">
		{{ csrf_field() }}

<div class="form-group col-sm-12">
<label class="">Subject</label>
<input type="text" name="subject" class="form-control">
</div>
	
<div class="form-group col-sm-12">
<select class="form-control" name="department_id">
<option value="">Select Department</option>
<option value="0">All Department</option>
@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>
</div>
<div class="form-group col-sm-12">
<label>Content</label>
<textarea class="form-control" row="120" name="content"></textarea>
</div>
<div class="form-group col-sm-12">
<input type="file" name="image" class="form-control">
</div>


<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">submit</button>
</div>
</div>
</form>



</div>
</div>
<div class="col-md-7">
	
<div class=" container-fluid   container-fixed-lg">

<div class="card card-default">

<form class="" role="form" method="POST" action="{{url('viewknowledgeBase') }}">
		{{ csrf_field() }}
<br/>	
<div class="form-group col-sm-12">
<select class="form-control" name="department_id">
<option value="">Select Department</option>
<option value="0">All Department</option>
@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">Continue</button>
</div>
</div>
</form>
<div class="clear-fix"></div>

	@if(isset($k))
	@if(count($k))
<div class="card-header ">
<div class="card-title">Knowledge Base</div>
</div>
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>
<th style="color: #000;width: 5px;">S/N</th>
<th style="color: #000;">subject</th>
<th style="color: #000;width: 15px;" colspan="2">Action</th>
</tr>
</thead>
{{!$i =1}}
@foreach($k as $v)
<tr>
	<td>{{$i++}}</td>
	<td>{{$v->subject}}</td>
	<td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal{{$i}}">
	View</button>

</td>
	<td>
		<div class="dropdown dropdown-default">
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Action
</button>
<div class="dropdown-menu col-sm-12">
 
 <a href="{{url('editknowledgeBase',$v->id)}}" class="text-success  dropdown-item">Edit</a>
 <a href="{{url('removeknowledgeBase',$v->id)}}" class="text-success  dropdown-item">Delete</a>

</div>
</div>

		</td>
	
</tr>
<div id="myModal{{$i}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{$v->subject}}</h4>

      </div>
      <div class="modal-body">
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


@else
<div class=" col-sm-10 col-sm-offset-1 alert alert-danger" role="alert" >
      No Records Available
    </div>
@endif
@endif
</div>

</div>

</div>

</div>

</div>
</div>

@endsection
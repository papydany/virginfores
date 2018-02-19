@extends('layouts.main')
@section('title','Task')
@section('content')
@inject('r','App\General') 
<?php $result= $r->getrolename(Auth::user()->id); ?>
<style type="text/css">
  .pagination {
    display: inline-block !important;
    padding-left: 0 !important;
    margin: 20px 0 !important;
    border-radius: 4px !important;
}

.pagination > li {
    display: inline;
}

.pagination > .active > a{
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border-color: #337ab7;
}
.pagination > li > a, .pagination > li > span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
        border-top-color: rgb(221, 221, 221);
        border-right-color: rgb(221, 221, 221);
        border-bottom-color: rgb(221, 221, 221);
        border-left-color: rgb(221, 221, 221);
}
.pagination a {
    text-decoration: none !important;
}
.pagination > li .active{color:#fff!important; 
background-color:#337ab7 !important;}
</style>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Task</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">
<div class="col-sm-5">
<div class="card card-default">	
<form class="" role="form" method="POST" action="{{url('task') }}">
		{{ csrf_field() }}
		<br/>

<div class="form-group col-sm-12">		
<div id="summernote"><textarea rows="10" class="form-control" name="content" placeholder="Task" required></textarea></div>
</div>
<div class="form-group col-sm-12">
<div class="form-group form-group-default input-group col-sm-12">
<div class="form-input-group">
<label>Start Date</label>
<input type="text" class="form-control" placeholder="Pick a date" id="datepicker-component2" name="start_date" required>
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
<input type="text" class="form-control" placeholder="Pick a date" id="datepicker-component2" name="end_date" required>
</div>
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>
</div>
@if($result =="SupperAdmin")
<div class="form-group col-sm-12">
<select class="form-control" name="department" id="department" required="">
<option value="">Select Deparment</option>

@if(isset($dpt))
@foreach($dpt as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
<div class="form-group col-sm-12">
<select class="form-control" name="staff_id" id="staff_id" required="">
</select>

</div>
@else
<div class="form-group col-sm-12">
<select class="form-control" name="staff_id"  required="">
<option value="">Select Staff</option>

@if(isset($d))
@foreach($d as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>

@endif

<div class="form-group col-sm-6">

<button class="btn btn-primary" type="submit">Create Task</button>
</div>
</form>
</div>
</div>
<div class="col-sm-7">
	@if(isset($t))
	<div class="card card-card-default">
<div class="card-header ">
<div class="card-title">Task
</div>
</div>
@if(count($t) > 0)
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>
<th style="color: #000;width: 5px;">S/N</th>
<th style="color: #000;">Assigned To</th>
<th style="color: #000;">Status</th>
<th style="color: #000;">Expected End Date</th>
<th style="color: #000;">completed Date</th>
<th style="color: #000;width: 5px;">Action</th>
</tr>
</thead>
{{!$i =1}}
@foreach($t as $v)
<?php $user =$r->getUserName($v->user_id); ?>
<tr>
	<td>{{$i++}}</td>
	<td>{{$user->name}}</td>
  <td>@if($v->status == 0)
   <span class="text-danger">Pending</span> 
  @else
  <span class="text-success">Completed </span> 
@endif</td>
    <td>{{date('F j , Y',strtotime($v->end_date))}}</td>
  <td>@if(!empty($v->completed_date)){{date('F j , Y',strtotime($v->completed_date))}}@endif</td>
	<td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal{{$i}}">Read</button></td>
	
	
</tr>
<div id="myModal{{$i}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>By {{$user->name}}</b></h4>

      </div>
      <div class="modal-body col-sm-12">
      <p>{{$v->content}}</p>
     
   
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
       @if($v->status == 0)
        <a href="{{url('edittask',$v->id)}}" class="btn btn-primary btn-xs">Edit</a>
        <a href="{{url('removetask',$v->id)}}" class="btn btn-danger btn-xs">Delete</a>
        @endif
      </div>
    </div>

  </div>
</div>

@endforeach
</table>
<p>{{$t->links()}}</p>
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
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
       
        <div class="modal-body text-danger text-center">
          <p>... processing ...</p>
        </div>
       
      </div>
      
    </div>
  </div>


@endsection

@section('script')
<script src="{{URL::to('js/main.js')}}"></script>
@endsection
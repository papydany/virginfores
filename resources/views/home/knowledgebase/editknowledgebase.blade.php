@extends('layouts.main')
@section('title','Edit Knowledge Base')
@section('content')
@inject('r','App\General') 
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit Knowledge Base</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">
<div class="col-md-4">
<div class="card card-default">	
<form class="" role="form" method="POST" action="{{url('updateknowledgeBase',$k->id) }}">
		{{ csrf_field() }}

<div class="form-group col-sm-12">
<label class="">Subject</label>
<input type="text" name="subject" class="form-control" value="{{$k->subject}}">


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


<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">submit</button>
</div>
</div>



</div>
</div>
<div class="col-md-8">
	
<div class=" container-fluid   container-fixed-lg">

<div class="card card-default">

<div class="card-block no-scroll card-toolbar">
<h5>Content</h5>
<div class="summernote-wrapper">
<div id="summernote"><textarea class="form-control" name="content">{{$k->content}}</textarea></div>
</div>
</div>
</div>

</div>

</div>
</form>
</div>
</div>

@endsection
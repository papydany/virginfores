@extends('layouts.main')
@section('title','Edit Post')
@section('content')
@inject('r','App\General') 
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit What On My Mind</li>
</ol>

<div class=" container-fluid   container-fixed-lg">
<div class="row">
<div class="col-sm-5">
<div class="card card-default">	
<form class="" role="form" method="POST" action="{{url('updatewhatonmymind',$k->id) }}">
		{{ csrf_field() }}
		<br/>

<div class="form-group col-sm-12">		
<div id="summernote"><textarea rows="15" class="form-control" name="content" placeholder="What on my mind" required>{{$k->content}}</textarea></div>
</div>


<div class="form-group col-sm-6">

<button class="btn btn-primary" type="submit">Update</button>
</div>
</form>
</div>
</div>

</div>
	

	
</div>



@endsection
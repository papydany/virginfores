@extends('layouts.main')
@section('title','Edit Designation')
@section('content')
	
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit Designation</li>
</ol>
<div class=" container-fluid   container-fixed-lg bg-white">
	<div class="col-md-8">


<div class="card card-transparent">
<div class="card-block">
<form id="form-personal" role="form" method="POST" action="{{url('updateDesination',$d->id) }}">
	{{ csrf_field() }}
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group">
<label>Designation name</label>
<input type="text" class="form-control" name="name" value="{{$d->name}}" required>
</div>
</div>

</div>
<div class="col-sm-12">
<h5>Line Manager</h5>
<div class="radio radio-success">
@if($d->role == 2)
<input type="radio" value="2" checked="checked" name="role" id="yes">
@else
<input type="radio" value="2" name="role" id="yes">
@endif
<label for="yes">yes</label>
@if($d->role == 1)
<input type="radio" checked="checked" value="1" name="role" id="no">
@else
<input type="radio"  value="1" name="role" id="no">
@endif
<label for="no">No</label>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">Update Designation</button>
</div>
</div>
</form>
</div>
</div>
</div>

</div>


@endsection
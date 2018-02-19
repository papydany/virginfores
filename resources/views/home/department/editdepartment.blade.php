@extends('layouts.main')
@section('title','Edit Department')
@section('content')
	
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit Department</li>
</ol>
<div class=" container-fluid   container-fixed-lg bg-white">
	<div class="col-md-8">


<div class="card card-transparent">
<div class="card-block">
<form id="form-personal" role="form" method="POST" action="{{url('updateDepartment',$d->id) }}">
	{{ csrf_field() }}
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group">
<label>Department name</label>
<input type="text" class="form-control" name="name" value="{{$d->name}}" required>
</div>
</div>

</div>
<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">Update Department</button>
</div>
</div>
</form>
</div>
</div>
</div>

</div>


@endsection
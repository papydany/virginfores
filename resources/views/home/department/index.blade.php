@extends('layouts.main')
@section('title','New Department')
@section('content')
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">New Department</li>
</ol>

<div class="row">
<div class="col-sm-4 ">

<div class="card card-default">
<div class="card-block">
<form id="form-personal" role="form" method="POST" action="{{url('newDepartment') }}">
	{{ csrf_field() }}
<div class="row clearfix">
<div class="col-sm-12">
<div class="form-group form-group-default required">
<label>Department name</label>
<input type="text" class="form-control" name="name" required>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<button class="btn btn-primary" type="submit">Create Department</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="col-md-8">
	@if(isset($d))
	@if(count($d))
<div class="card card-default">
<div class="card-header ">
<div class="card-title">Department
</div>
</div>
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
<thead class="bg-success" >
<tr>

<th style="color: #000;width:10%;">S\N</th>
<th style="color: #000;">Name</th>
<th style="color: #000; width:30%">Action</th>

</tr>
</thead>
<tbody>
	{{!$i =1}}
	@foreach($d as $v)
	
<tr>
<td class="v-align-middle">{{$i++}}</td>
<td class="v-align-middle ">{{$v->name}}</td>
<td class="v-align-middle">
<a class="btn btn-success" href="{{url('editDepartment',$v->id)}}">Edit</a>	

</td>
</tr>
@endforeach
</tbody>
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
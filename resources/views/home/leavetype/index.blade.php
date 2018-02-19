@extends('layouts.main')
@section('title','Set leave Category')
@section('content')

<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Leave Category</li>
</ol>	
<div class="row">
<div class="col-lg-4">

<div class="card card-default">
<div class="card-header ">
<div class="card-title">leave Category
</div>
<div class="tools">
<a class="collapse" href="javascript:;"></a>
<a class="config" data-toggle="modal" href="#grid-config"></a>
<a class="reload" href="javascript:;"></a>
<a class="remove" href="javascript:;"></a>
</div>
</div>
<div class="card-block">




<form class="" role="form" method="POST" action="{{url('leavecat') }}">
		{{ csrf_field() }}
	
<div class="form-group form-group-default form-group-default-select2 required">

<select class="full-width" data-init-plugin="select2" name="id" required>
<option value="">Select Leave Category</option>

@if(isset($a))
@foreach($a as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>
<p>Enter Number of Day </p>
<div class="input-group">
<input type="Number" class="form-control" name="days" required="">
<span class="input-group-addon primary">
<i class="fa fa-align-justify"></i>
</span>
</div>
<br/>
<div class="col-sm-4">
<div class="form-group">
<button class="btn btn-primary" type="submit">Continue</button>
</div>
</div>


</form>
</div>
</div>

</div>
@if(isset($a))
<div class="col-lg-8">

<div class="card card-default">
<div class="card-header ">
<div class="card-title">Leave Category
</div>

</div>

@if(count($a))
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
<thead class="bg-success" >
<tr>

<th style="color: #000;width:10%;">S\N</th>
<th style="color: #000;">Name</th>
<th style="color: #000;">Number Of Days</th>


</tr>
</thead>
<tbody>
	{{!$i = 1}}
	@foreach($a as $v)
	
<tr>
<td class="v-align-middle">{{$i++}}</td>
<td class="v-align-middle ">{{$v->name}}</td>
<td class="v-align-middle ">
	@if(!empty($v->days))
{{$v->days}}
@else
No Days Set Yet
@endif</td>

</tr>
@endforeach
</tbody>
</table>
</div>
</div>
@else
<div class=" col-sm-10 col-sm-offset-1 alert alert-danger" role="alert" >
      No Records Available
    </div>
@endif


</div>
</div>
@endif
</div>
</div>
@endsection
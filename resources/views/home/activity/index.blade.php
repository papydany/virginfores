@extends('layouts.main')
@section('title','New Activity')
@section('content')
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">New Activity</li>
</ol>


<div class="row">
<div class="col-sm-4">
<div class="card card-default">

<div class="card-block">
<form id="form-personal" role="form" method="POST" action="{{url('newActivity') }}">
	{{ csrf_field() }}
<div class="row clearfix">
<div class="col-sm-12">
<div class="form-group form-group-default required">
<label>Activity name</label>
<input type="text" class="form-control" name="name" required>
</div>
</div>
<div class="col-sm-12">
<h5>Line Manager</h5>
<div class="radio radio-success">
<input type="radio" value="2" name="role" id="yes">
<label for="yes">yes</label>
<input type="radio" checked="checked" value="1" name="role" id="no">
<label for="no">No</label>
</div>
</div>
<div class="form-group col-sm-12">
<select class="full-width" data-placeholder="Attachment Of File" data-init-plugin="select2" name="file" required="">
<option value="">Attachment Of File</option>
<option value="1">No</option>
<option value="2">Yes</option>
</select>
</div>
<div class="col-sm-12">
<div class="form-group">
<button class="btn btn-primary" type="submit">Create Activity</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="col-sm-7">
	@if(isset($act))
	
<div class="card card-card-default">
<div class="card-header ">
<div class="card-title">Activity
</div>
</div>
@if(count($act))
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
<thead class="bg-success" >
<tr>

<th style="color: #000;width:10%;">S\N</th>
<th style="color: #000;">Name</th>
<th style="color: #000;">Line Manager</th>
<th style="color: #000;">file attachment</th>
<th style="color: #000;">Action</th>

</tr>
</thead>
<tbody>
	{{!$i = 1}}
	@foreach($act as $v)
	
<tr>
<td class="v-align-middle">{{$i++}}</td>
<td class="v-align-middle ">{{$v->name}}</td>
<td class="v-align-middle ">@if($v->role == 1)

No
@elseif($v->role == 2)
Yes
@endif</td>
<td class="v-align-middle">@if($v->file == 1)No
@elseif($v->file == 2)Yes
@endif</td>
<td class="v-align-middle">
<a class="btn btn-success" href="{{url('editActivity',$v->id)}}">Edit</a>	

</td>
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

@endif
</div>

</div>

</div>




@endsection
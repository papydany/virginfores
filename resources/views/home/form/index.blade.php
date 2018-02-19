@extends('layouts.main')
@section('title','New Form Field')
@section('content')
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">New Form Field</li>
</ol>

<div class="row">
<div class="col-lg-6">

<div class="card card-default">

<div class="card-block">
<h5 class="text-success">
New Form Field
</h5>
<form class="" role="form" method="POST" action="{{url('newForm') }}">
		{{ csrf_field() }}

<div class="row">
<div class="col-md-12">
<div class="form-group form-group-default form-group-default-select2 required">
<label class="">Activity</label>
<select class="full-width" data-placeholder="Select Activity" data-init-plugin="select2" name="activity_id">
<option value="">Select Activity</option>

@if(isset($a))
@foreach($a as $v)
<option value="{{$v->id}}">{{$v->name}}</option>
@endforeach
@endif
</select>

</div>	
<div class="form-group form-group-default required">
<label>Field Name</label>
<input type="text" class="form-control" name="name" required>
</div>

<div class="form-group form-group-default form-group-default-select2 required">
<label class="">Type</label>
<select class="full-width" data-placeholder="Select Type" data-init-plugin="select2" name="type">
<option value="">Select Type</option>
<option value="input">Input</option>
<option value="textarea">Textarea</option>
<option value="datepicker">Date Picker</option>
<option value="select">Select</option>
</select>

</div>


<div class="form-group">
<label>Option</label>
<textarea class="form-control" rows="10" name="option" placeholder="if select type is selected, enter the options in comma. eg virgin,forest, etc"></textarea>  
</div>

<div class="col-sm-12">
<h5>Editable Field</h5>
<div class="radio radio-success">
<input type="radio" value="2" name="editable" id="yes">
<label for="yes">yes</label>
<input type="radio" checked="checked" value="1" name="editable" id="no">
<label for="no">No</label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox check-success checkbox-circle">
<input type="checkbox" value="1" id="checkbox8" name="required">
<label for="checkbox8">Required</label>
</div>

</div>
<div class="col-sm-6">
<button class="btn btn-primary" type="submit">Create Form Field</button>
</div>
</form>
</div>
</div>	


</div>

</div>
</form>
</div>




@endsection
@extends('layouts.main')
@section('title','Edit Form Field')
@section('content')
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit Form Field</li>
</ol>

<div class="row">
<div class="col-lg-6">

<div class="card card-default">

<div class="card-block">
<h5 class="text-success">
Edit Form Field
</h5>
<form class="" role="form" method="POST" action="{{url('updateForm',$id) }}">
		{{ csrf_field() }}

<div class="row">
<div class="col-md-12">

<div class="form-group form-group-default required">
<label>Field Name</label>
<input type="text" class="form-control" name="name" value="{{$f->name}}" required>
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


<div class="form-group form-group-default">
<label>Option</label>
<textarea class="form-control" name="option" placeholder="if select type is selected, enter the options in comma. eg virgin,forest, etc">{{$f->option}}</textarea>  
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

<div class="col-sm-5">
<div class="checkbox check-success checkbox-circle">
<input type="checkbox" value="1" id="checkbox8" name="required">
<label for="checkbox8">Required</label>
</div>

</div>
<div class="col-sm-6">
<button class="btn btn-primary" type="submit">Update Form Field</button>
</div>
</form>
</div>
</div>	


</div>

</div>
</form>
</div>




@endsection
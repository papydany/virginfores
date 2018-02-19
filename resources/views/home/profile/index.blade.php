@extends('layouts.main')
@section('title','Profile')
@section('content')
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Profile</li>
</ol>

<div class="row">
<div class="col-lg-6">

<div class="card card-default">

<div class="card-block">
<h5 class="text-success">
Profile
</h5>
<form class="" role="form" method="POST" action="{{url('profile') }}">
		{{ csrf_field() }}

<div class="row">
<div class="col-md-12">
<div class="form-group form-group-default required">
<label>Name</label>
<input type="text" class="form-control" name="name" value="{{$p->name}}" required>
</div>
</div>

</div>

<div class="form-group form-group-default required ">
<label>Phone</label>
<input type="text" class="form-control" name="phone" value="{{$p->phone}}" required>
</div>

<div class="form-group  form-group-default required">
<label>Email</label>
<input type="email" name="email" class="form-control" value="{{$p->email}}" required>
</div>
@if($p->department_id != '0')
@inject('r','App\General')

 <?php $deparment= $r->getDepartment(Auth::user()->department_id); 
$desination =$r->getDesination_all(Auth::user()->desination_id);
 ?>
<p class="text-danger">Nb : Only system admin can update your department and desination</p>
<div class="form-group">
<label>Department</label>
<input type="text" class="form-control"  value="{{$deparment}}" readonly="">
</div>

<div class="form-group">
<label>Designation</label>
<input type="text" class="form-control"  value="{{$desination->name}}" readonly="">
</div>
@endif
<div class="col-sm-12">
<div class="form-group">
<button class="btn btn-warning" type="submit">Update Profile</button>
</div>
</div>
</form>
</div>
</div>	


</div>

</div>




@endsection
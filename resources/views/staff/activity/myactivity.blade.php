@extends('layouts.main')
@section('title','All Activity')
@section('content')
@inject('r','App\General')

<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">All Activity</li>
</ol>

<div class="row">
<div class="col-lg-10">

<div class="card card-default">


@if(isset($rs))
@if(count($rs) > 0)
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>
<th style="color: #000;width: 5px;">S/N</th>
<th style="color: #000;">Activity</th>
<th style="color: #000;">Status</th>
<th style="color: #000;">Date submited</th>

<th style="color: #000;width: 10px;">Action</th>
</tr>
</thead>
{{!$i =1}}
@foreach($rs as $v)
<?php $Activity =$r->getActivity($v->activity_id);
$step =$v->status+1;
?>
<tr>
  <td>{{$i++}}</td>
<td>{{$Activity}}</td>
  <td>@if($v->status == 0)
   <span class="text-danger">Pending</span> 
   @elseif($v->status == 77)
   <span class="text-primary">Rejected</span> 
  @else
 
  <span class="text-success">Processing</span> 
@endif</td>
    <td>{{date('F j , Y',strtotime($v->created_at))}}</td>
  <td>
  <div class="dropdown dropdown-default">
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Action
</button>
<div class="dropdown-menu col-sm-12">
 
 <a class="text-success  dropdown-item"  href="{{url('viewmyactivity',$v->id)}}">View</a>
  @if($v->user_id == Auth::user()->id)
 <a  class="text-danger  dropdown-item" href="{{url('viewmyactivity',[$v->id,'pdf'])}}">Pdf</a>
@endif
</div>
</div>

  </td>
</tr>

@endforeach
</table>
<p>{{$rs->links()}}</p>
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
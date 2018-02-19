@extends('layouts.main')
@section('title','Home')
@section('content')
 @inject('r','App\General')
 <?php $result= $r->getrolename(Auth::user()->id);
$activity= $r->get_all_Activity();
 $desination =$r->getDesination_all(Auth::user()->desination_id);
  ?>
<style type="text/css">
	.mh{min-height: 100px;}

  .pagination {
    display: inline-block !important;
    padding-left: 0 !important;
    margin: 20px 0 !important;
    border-radius: 4px !important;
}

.pagination > li {
    display: inline;
}

.pagination > .active > a{
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border-color: #337ab7;
}
.pagination > li > a, .pagination > li > span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
        border-top-color: rgb(221, 221, 221);
        border-right-color: rgb(221, 221, 221);
        border-bottom-color: rgb(221, 221, 221);
        border-left-color: rgb(221, 221, 221);
}
.pagination a {
    text-decoration: none !important;
}
.pagination > li .active{color:#fff!important; 
background-color:#337ab7 !important;}
</style>
<div class=" container-fluid   container-fixed-lg">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>

</ol>
@if($result =="user" || $result =="Admin") 
<div class="col-sm-6  pull-right">
<div class="row">
<div class="card card-default">
<div class="card-header ">
<div class="card-title">Task
</div>
<div class="tools">
<a class="collapse" href="javascript:;"></a>
<a class="config" data-toggle="modal" href="#grid-config"></a>
<a class="reload" href="javascript:;"></a>
<a class="remove" href="javascript:;"></a>
</div>
</div>
@if(isset($t))
@if(count($t) > 0)
<div class="card-block">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-success" >
<tr>
<th style="color: #000;width: 5px;">S/N</th>

<th style="color: #000;">Status</th>
<th style="color: #000;">Start Date</th>
<th style="color: #000;">Expected End Date</th>
<th style="color: #000;width: 5px;">Action</th>
</tr>
</thead>
{{!$i =1}}
@foreach($t as $v)
<?php $user =$r->getUserName($v->user_id); ?>
<tr>
  <td>{{$i++}}</td>

  <td>@if($v->status == 0)
   <span class="text-danger">Pending</span> 
  @else
  <span class="text-success">Completed </span> 
@endif</td>
    <td>{{date('F j , Y',strtotime($v->start_date))}}</td>
  <td>{{date('F j , Y',strtotime($v->end_date))}}</td>
  <td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal{{$i}}">Read</button></td>
  
  
</tr>
<div id="myModal{{$i}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>By {{$user}}</b></h4>

      </div>
      <div class="modal-body col-sm-12">
      <p>{{$v->content}}</p>
     
   
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
         @if($v->status == 0)
        <a href="{{url('finishtask',$v->id)}}" class="btn btn-primary btn-xs">Completed</a>

        @endif
      </div>
    </div>

  </div>
</div>

@endforeach
</table>
<p>{{$t->links()}}</p>
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
@endif

 @if($result =="Admin")	
<div class="row col-sm-6">
@if(isset($af))
@if(count($af))
  @foreach($af as $k => $v)
  <?php  
  $activity =$r->getActivity($k);

?>

   <div class="col-sm-4">
<div class="card card-default mh">
<div class="card-header ">
<div class="card-title text-danger">
 <p>{{$activity}} </p>
<p>@foreach($v as  $c)

   <?php  $status =$c->step -1; 
 
$r_activity =$r->getregistered_activity($c->activity_id,$status);
?>
@if(count($r_activity) > 0)
{{count($r_activity)}}

@endif

@endforeach</p>
<a href="{{url('myactivity',$k)}}" class="btn btn-xs btn-primary">View Detail</a>
</div>

</div>
</div>
</div>

@endforeach
@endif
@endif



</div>

@elseif($result =="user")


<div class="col-sm-6">
<div class="row">

 
<div class="card card-default mh col-sm-3">
<div class="card-header ">
  
<div class="card-title text-success">Activity &nbsp;({{$rs}}) 
</div>
</div>
<a href="{{url('myactivity')}}" class="btn btn-xs btn-primary">View Detail</a>
</div>

<div class="card card-default mh col-sm-3">
<div class="card-header ">
<div class="card-title">Assign Line Manager To process Flow
</div>
<div class="tools">
<a class="collapse" href="javascript:;"></a>
<a class="config" data-toggle="modal" href="#grid-config"></a>
<a class="reload" href="javascript:;"></a>
<a class="remove" href="javascript:;"></a>
</div>
</div>

</div>
</div>
</div>




@endif
 
 


@endsection
 @inject('r','App\General')

 <?php $deparment= $r->getDepartment(Auth::user()->id); ?>

<a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu" data-toggle="sidebar">
</a>

<div class="">
<div class="brand inline">
@if(!empty($deparment))	
<span class="semi-bold text-success"><b>{{$deparment}} </b></span> 
@endif
</div>



</div>
<div class="d-flex align-items-center">

<div class="pull-left p-r-10 fs-14 font-heading hidden-md-down">
<span class="semi-bold text-success">{{ Auth::user()->name }} </span> 
</div>



</div>

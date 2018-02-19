 @inject('r','App\General')
 <?php $result= $r->getrolename(Auth::user()->id);
$activity= $r->get_all_Activity();
 $desination =$r->getDesination_all(Auth::user()->desination_id);
  ?>



<div class="sidebar-header">

<div class="sidebar-header-controls">

</div>
</div>

  

<div class="sidebar-menu">


<ul class="menu-items">
<li class="m-t-30 ">
<a href="{{url('/')}}" class="detailed">
<span class="title">Dashboard</span>

</a>
<span class="bg-success icon-thumbnail"><i class="pg-home"></i></span>
</li>
<li class="m-t-30 ">
<a href="{{url('profile')}}" class="detailed">
<span class="title">Profile</span>

</a>
<span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
</li>
@if($result =="Admin" || $result =="SupperAdmin")
<li class="">
<a href="{{url('task')}}">
<span class="title">Task</span>
</a>
<span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
</li>
@endif
 @if($result =="SupperAdmin")
 <li class="">
<a href="{{url('newDepartment')}}">Department</a>
<span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
</li>
<li class="">
<a href="{{url('newDesination')}}">Designation</a>
<span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
</li>
<li>
<a href="javascript:;"><span class="title">Staff</span>
<span class=" arrow"></span></a>
<span class="icon-thumbnail"><i class="pg-layouts"></i></span>
<ul class="sub-menu">
<li class="">
<a href="{{url('newStaff')}}">New</a>

</li>
<li class="">
<a href="{{url('viewStaff')}}">View</a>
</li>
</ul>
</li>
<li class="">
<a href="{{url('newActivity')}}">Activity</a>
<span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
</li>
<li>
<a href="javascript:;">
<span class="title">Create Forms</span>
<span class=" arrow"></span>
</a>
<span class="icon-thumbnail"><i class="pg-form"></i></span>
<ul class="sub-menu">
<li class="">
<a href="{{url('newForm')}}">new</a>
<span class="icon-thumbnail">fe</span>
</li>
<li class="">
<a href="{{url('viewForm')}}">view</a>
<span class="icon-thumbnail">fl</span>
</li>
</ul>
</li>

<li>
<a href="javascript:;">
<span class="title"> Activity Flow</span>
<span class=" arrow"></span>
</a>
<span class="icon-thumbnail"><i class="pg-form"></i></span>
<ul class="sub-menu">
<li class="">
<a href="{{url('newActivityFlow')}}">new</a>
<span class="icon-thumbnail">fe</span>
</li>
<li class="">
<a href="{{url('viewActivityFlow')}}">view</a>
<span class="icon-thumbnail">fl</span>
</li>

</ul>
</li>
<li>
<a href="javascript:;">
<span class="title">Leave Setup</span>
<span class=" arrow"></span>
</a>
<span class="icon-thumbnail"><i class="pg-form"></i></span>
<ul class="sub-menu">
<li class="">
<a href="{{url('leavecat')}}">Category</a>
<span class="icon-thumbnail">fe</span>
</li>
<li class="">
<a href="{{url('leavetype')}}">Type</a>
<span class="icon-thumbnail">fl</span>
</li>

</ul>
</li>

<li class="">
<a href="{{url('newknowledgeBase')}}">
<span class="title">Knowledge Base</span>
</a>
<span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
</li>

@elseif($result =="user" || $result =="Admin")
<li>
<a href="javascript:;"><span class="title">Create Activity</span>
<span class=" arrow"></span></a>
<span class="icon-thumbnail"><i class="pg-tables"></i></span>
<ul class="sub-menu">
@if(!empty($activity))
@foreach($activity as $v)
@if(!empty($desination))
	@if($desination->role == $v->role)
	<li class="">
<a href="{{url('createActivity',$v->id)}}">{{$v->name}}</a>
</li>
@endif
@endif

@endforeach
@endif

</ul>
</li>

<li class="">
<a href="{{url('readKnowledge')}}">
<span class="title">Knowledge</span>
</a>
<span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
</li>
@endif

<li class="">
<a href="{{url('whatonmymind')}}">
<span class="title">What On My Mind</span>
</a>
<span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
</li>
<li class="">
 <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
</li>
</ul>
<div class="clearfix"></div>
</div>
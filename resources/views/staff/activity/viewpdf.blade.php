<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>pdf report</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css">
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
.page-break {
    page-break-after: always;
}
 #headline1 {
      background-image: url(/img/logo_03.png);
      background-repeat: no-repeat;
      background-position: left top;
      padding-top:68px;
      margin-bottom:50px;
   
</style>
</head>
<body>
	
@inject('r','App\General') 

<?php $result= $r->getrolename(Auth::user()->id); ?>
<div>
	<div id="headline1">
	
	</div>

	@if(isset($v))
	@if(count($v))
<div>	
<?php $activity =$r->getActivity2($rs->activity_id);

$department =$r->getDepartment($u->department_id);
$name =$r->getUserName($u->id);
$designation =$r->getDesination($u->desination_id);
?>	


<h3>{{$activity->name}} &nbsp; FORM</h3>

<table>
	<tr>
		<th>From </th>
		<th>{{$name->name}}</th>
	</tr>
	<tr>
		<th>Department </th>
		<th>{{$department}}</th>
	</tr>
	<tr>
		<th>Designation</th>
		<th>{{$designation}}</th>
	</tr>

</table>	
<br/>	
@if(!empty($ld))

<?php $l =$r->getleavetype($ld->leavetype_id);?>
<table>
	<tr><td>Leave Type</td>
		<td>{{$l->name}}</td>
	</tr>
	<tr><td>Numbers of days</td>
		<td>{{$ld->days}}</td>
	</tr>
</table>

<h3>Approved </h3>
<table>
	<tr><td>Approved Numbers of days</td>
		<td>{{$ld->confirm_days}}</td>
	</tr>
	<tr><td>Approved Start Date</td>
		<td>{{$ld->confirm_start_date}}</td>
	</tr>
	<tr><td>Approved End Date : </td>
		<td>{{$ld->confirm_end_date}}</td>
	</tr>
</table>
<br/>	
@endif

<table>
	<tr>
		<td>
@foreach($v as $vf)
<?php $formfield =$r->getformfield($vf->formfield_id);?>
<p>{{$formfield->name}} : &nbsp; <b>{{$vf->value}}</b></p>
@endforeach
</td>
</tr>
</table>
<br/>	

@endif
@endif
</div>
<hr/>
@if(isset($ad))
@if(count($ad))
<div>
<h3>Official Approved Status</h3>
	
	
	
<table>
	<tr>
	<th>Name</th>
	<th>Designation</th>
	<th>Status</th>
</tr>	
@foreach($ad as $v)
	<?php 
// officia8l info
$name =$r->getUserName($v->user_id);
$designation =$r->getDesination($name->desination_id);
?>	


	<tr>
	<td>{{$name->name}}</td>
	<td>{{$designation}}</td>
	<td>{{$v->status == 2 ?'Approved' : 'Reject'}}</td>
</tr>



	@endforeach
</table>
	
</div>


@endif
@endif
</div>


</body>
</html>
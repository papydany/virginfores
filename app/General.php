<?php

namespace App;
use DB;

class General
{
	public function getDesination($id)
	{
		$des =Desination::find($id);
		if(count($des) > 0)
		{
			return $des->name;
		}
	}
		public function getDesination_all($id)
	{
		$des =Desination::find($id);
		if(count($des) > 0)
		{
			return $des;
		}
		return null;
	}
	public function getLeavecat($id)
	{
		$des =LeaveCat::find($id);
		if(count($des) > 0)
		{
			return $des;
		}
		return null;
	}
public function getDepartment($id)
	{
		$des =Department::find($id);
		if(count($des) > 0)
		{
			return $des->name;
		}
	}	
	public function getActivity($id)
	{
		$des =Activity::find($id);
		if(count($des) > 0)
		{
			return $des->name;
		}
	}
	public function getActivity2($id)
	{
		$des =Activity::find($id);
		if(count($des) > 0)
		{
			return $des;
		}
	}
	public function get_all_Activity()
	{
		$des =Activity::get();
		if(count($des) > 0)
		{
			return $des;
		}
	}
	public function getUserName($id)
	{
		$des =User::find($id);
		if(count($des) > 0)
		{
			return $des;
		}
	}

	  public function getrolename($id){
        $user = DB::table('roles')
            ->join('user_roles', 'roles.id', '=', 'user_roles.role_id')
            ->where('user_roles.user_id',$id)
            ->first();
            return $user->name;    
   }
   public function getformfield($id)
   {
   	$ff =FormField::find($id);
   	if(count($ff) > 0)
   	{
return $ff;
   	}
   }

      public function getleavetype($id)
   {
   	$ff =LeaveType::find($id);
   	if(count($ff) > 0)
   	{
return $ff;
   	}
   }
       public function getregistered_activity($activity_id,$status)
   {
   	$ff =RegisteredActivity::where([['activity_id',$activity_id],['status',$status]])->get();
   	if(count($ff) > 0)
   	{
return $ff;
   	}
   }
}
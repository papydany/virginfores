<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use App\Department;
use App\Activity;
use App\Desination;
use App\User;
use App\FormField;
use App\ActivityFlow;
use App\KnowledgeBase;
use App\Post;
use App\FormFieldValue;
use App\RegisteredActivity;
use App\LeaveType;
use App\LeaveDetail;
use App\File;
use App\ApproverDetail;
use App\LeaveCat;
use Auth;
use Mail;
use PDF;

class StaffController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 public function index($id)
 {   $f =FormField::where('activity_id',$id)->get();
 $lt =LeaveType::where('activity_id',$id)->get();
 if(count($lt) > 0)
 {
return view('staff.activity.index')->withF($f)->withD($id)->withlt($lt);
 }else
 {
  return view('staff.activity.index')->withF($f)->withD($id);
 }
 } 
//================================= get a8ctivity form ===================================
public function createActivity(Request $request)
    {
      $year =Date('Y');
      // if its normal leave category
        if ($request->has('LeaveType')) {

      $get_leave_type  =LeaveType::where('leavecat_id',2)->get();
      $LeaveType_array =array();
      
     $sum_of_days =0;
      if(count($get_leave_type) > 0)
      {
        
        foreach ($get_leave_type as $key => $value) {
        $LeaveType_array [] = $value->id;
       
        }

        $get_leave_detail =LeaveDetail::where('user_id',Auth::user()->id)->whereIn('leavetype_id',$LeaveType_array)->whereDate('year','=',$year)->get();

if(count($get_leave_detail) > 0 )
{
         // check for leave that has been approve
        foreach ($get_leave_detail as $key => $value) {

$reg =RegisteredActivity::where('id',$value->registeredactivity_id)->whereNotIn('status',[77,0])->first();
         if(count($reg) > 0)
         {
          $sum_of_days += $value->days;
         }
        }
      }
   $get_leave_cat  =LeaveCat::find(2);
  
   if($get_leave_cat->days < $sum_of_days + $request->days) 
   {
    $request->session()->flash('warning', 'Please check number of leaves days you have in these year');
    return back();
   }    
      }
    
  }
   
      $id =$request->input('id');
     
      $act=$request->input('activity_id');
      $reg_act =new RegisteredActivity;
      $reg_act->user_id =Auth::user()->id;
      $reg_act->activity_id =$act;
      $reg_act->status=0;
      $reg_act->department_id=Auth::user()->department_id;
      $reg_act->save();
      // for leave type
      if ($request->has('LeaveType')) {
      $LeaveType=$request->input('LeaveType');
      $days=$request->input('days');
$ld = new LeaveDetail;
$ld->registeredactivity_id = $reg_act->id;
$ld->leavetype_id = $LeaveType;
$ld->user_id =Auth::user()->id;
$ld->days = $days;
$ld->start_date =$request->start_date;
$ld->end_date =$request->end_date;
$ld->year =$year;
$ld->save();
    }
    // for file a8ttachement
     if($request->hasFile('image')) {
            $image = $request->file('image')->store();
            $k= new File;
           $k->registeredactivity_id = $reg_act->id; 
          $k->file = $image;
          $k->save();
          }
          
      foreach ($id as $key => $value) {
        $formvalue =$request->input('name')[$value];
        $ffv =New FormFieldValue;
        $ffv->activity_id = $act;
        $ffv->user_id =Auth::user()->id;
        $ffv->registeredactivity_id=$reg_act->id;
        $ffv->formfield_id=$value;
        $ffv->status=0; 
        $ffv->value=$formvalue; 
        $ffv->save();
       }
       // get the line manager and send email
       $activity_flow =ActivityFlow::where([['department_id',Auth::user()->department_id],['step',1],['activity_id',$act]])->first();
      
       if(count($activity_flow) > 0)
       {
        // get user email with the designation_id;
        $user =User::where('desination_id',$activity_flow->desination_id)->first();
         $activity =Activity::find($act);
        if(count($user) > 0)
        {
          $data = array('email' => $user->email);

  Mail::send(array('html'=>'emails.pending'), $data, function($message) use ($data,$activity)  {
                
                $message->to($data['email']);
                $message->subject($activity->name.'  Form Pending');

            });
        }
       }
       $request->session()->flash('success', 'Successful!');

    return redirect()->action('StaffController@index',$act);       
    } 
    //================================= myactivity===================================
    public function myactivity()
    { 
      $rs =RegisteredActivity::where([['department_id',Auth::user()->department_id],['user_id',Auth::user()->id]])->orderBy('id','desc')->paginate(20);
        return view('staff.activity.myactivity')->withRs($rs);
    }
//view
     public function viewmyactivity($id,$pdf=null)
    { 
    
      $rs =RegisteredActivity::find($id);
      $step =$rs->status + 1;
      $dept =$rs->department_id;
      // get users tha8t submited the form
      $user=User::find($rs->user_id);
      // check if you have to get lea8ve deta8il
      $ld= LeaveDetail::where('registeredactivity_id',$id)->first();
      if(count($ld) == 0)
      {
        $ld ='';
      }
      $fa=File::where('registeredactivity_id',$id)->first();
       if(count($fa) == 0)
      {
        $fa ='';
      }
      //dd($ld);
      $value =FormFieldValue::where('registeredactivity_id',$id)->get();

$af =ActivityFlow::where([['department_id',$dept],['desination_id',Auth::user()->desination_id],['step',$step],['activity_id',$rs->activity_id]])->first();

// for offica8l a8pprove level
$ApproverDetail =ApproverDetail::where([['registeredactivity_id',$id],['step','<=',$step]])->get();

if($pdf == 'pdf')
{
  $data = ['v'=>$value,'ld'=>$ld,'fa'=>$fa,'rs'=>$rs,'af'=>$af,'u'=>$user,'ad'=>$ApproverDetail];
  //view()->share([['V',$value],['Ld',$ld],['fa',$fa],['Rs',$rs],['Af',$af],['U',$user],['Ad',$ApproverDetail]]);
//return view('staff.activity.viewpdf')->withV($value)->withLd($ld)->withfa($fa)->withRs($rs)->withAf($af)->withU($uoverDetail);ser)->withAd($Appr
$pdf = PDF::loadview('staff.activity.viewpdf',$data);
            return $pdf->download('viewpdf.pdf');
}else
{
  return view('staff.activity.view')->withV($value)->withLd($ld)->withfa($fa)->withRs($rs)->withAf($af)->withU($user)->withAd($ApproverDetail);
}


    }

      public function adminmyactivity($id)
    { $dept =array();
      $status =array();
$actflow =ActivityFlow::where([['desination_id',Auth::user()->desination_id],['activity_id',$id]])->get();

      foreach ($actflow as $key => $value) {
        $dept[] =$value->department_id;
        $status[] =$value->step -1;
      }

      $rs =RegisteredActivity::where('activity_id',$id)->whereIn('department_id',$dept)->whereIn('status',$status)->orderBy('id','desc')->paginate(20);


        return view('staff.activity.myactivity')->withRs($rs);
    }
 //================================= submit a8ctivity form ===================================   
 
 public function submitcreateActivity(Request $request)
    {  
     // upda8tes formfieldva8lue ta8ble
        if ($request->has('leavedetail_id')) {
$ld = LeaveDetail::find($request->leavedetail_id);
$ld->confirm_days = $request->confirm_days;
$ld->confirm_start_date = $request->confirm_start_date;
$ld->confirm_end_date = $request->confirm_end_date;
$ld->save();
 }
 $RegisteredActivity =RegisteredActivity::find($request->rs);
  $flow_status =$request->flow_status;
  // get users email and activity
  $user =User::find($RegisteredActivity->user_id);
  $activity =Activity::find($RegisteredActivity->activity_id);
      // $flw_sta8tus 1 is rejection a8nd 2 is approve
      if($flow_status == 1)
      {
        $newstatus =77;
        $data = array('email' => $user->email);

  Mail::send(array('html'=>'emails.status'), $data, function($message) use ($data,$activity)  {
                
                $message->to($data['email']);
                $message->subject($activity->name.' Status');

            });


      }elseif($flow_status == 2)
      {
     $newstatus =$request->status + 1;
      }

      $RegisteredActivity->status = $newstatus;
      $RegisteredActivity->save();

      // upda8tes formfieldva8lue ta8ble
        if ($request->has('id')) {

      $id =$request->input('id');

       foreach ($id as $key => $value) {
        $formvalue =$request->input('name')[$value];
        $ffv = FormFieldValue::find($value);
        $ffv->value=$formvalue; 
        $ffv->save();
       }
     }

    
     //approver details
     $step =$request->status + 1;
     $ap = new ApproverDetail;
     $ap->registeredactivity_id =$RegisteredActivity->id;
     $ap->user_id =Auth::user()->id;
     $ap->status =$request->flow_status;
     $ap->step =$step;
    $ap->comment =$request->comment;
     $ap->save();

if($request->flow_status == 2)
{

    $newstep = $step + 1;
// get the next line manager
$af =ActivityFlow::where([['department_id',$RegisteredActivity->department_id],['activity_id',$RegisteredActivity->activity_id],['step',$newstep]])->first();
if(count($af) > 0)
{
  $linemanager =User::where('desination_id',$af->desination_id)->first();
// send email to the next line manager
  $l_data = array('email' => $linemanager->email);

  Mail::send(array('html'=>'emails.pending'), $l_data , function($message) use ($l_data,$activity)  {
               
                $message->to($l_data ['email']);
                $message->subject($activity->name.' Form pending');

            });

  // sending ema8il to the user when approver
  if($af->approved_status == 2)
  {
       $data = array('email' => $user->email);

  Mail::send(array('html'=>'emails.status'), $data, function($message) use ($data,$activity)  {
                
                $message->to($data['email']);
                $message->subject($activity->name.' Status');

            });
  }
}


}

 $request->session()->flash('success', 'Successful!');
 return redirect()->action('StaffController@adminmyactivity',$RegisteredActivity->activity_id); 
}  

    //===========================rea8d knowledge =====================
 public function readKnowledge()
    {
      $k =KnowledgeBase::whereIn('department_id',[Auth::user()->department_id,0])->orderBy('id','desc')->get();
        return view('staff.readknowledge.index')->withK($k);
    }  


//================================= whatonmymind ===================================
    public function whatonmymind()
    {    $d =Department::get();
        if(Auth::user()->department_id == 0)
        {   $post =Post::orderBy('created_at','desc')->get();

        }else
        {
         $post =Post::whereIn('department_id',[Auth::user()->department_id,0])->orderBy('created_at','desc')->get();
        }
     
    
        return view('staff.whatonmymind.index')->withd($d)->withP($post);
    }
//post
      public function postwhatonmymind(Request $request)
    {$request->validate(['department_id' => 'required',
        'content' => 'required',]);
    $k =new Post;
      $k->content =$request->content;
       $k->department_id =$request->department_id;
      $k->user_id =Auth::user()->id;
      $k->save();
      $request->session()->flash('success', 'Successful!');
        return back();
      }

      //edit
 public function editwhatonmymind($id)
    {
      $k =Post::find($id);
   return view('staff.whatonmymind.editwhatonmymind')->withK($k);
    }
      //upda8te
public function updatewhatonmymind(Request $request,$id)
    {
      $p =Post::find($id);
      $p->content =$request->content;
      $p->save();
      $request->session()->flash('success', 'Successful!');
  return redirect()->action('StaffController@whatonmymind');
    }     

      // remove
     public function removewhatonmymind(Request $request,$id)
    {
    Post::destroy($id);
 $request->session()->flash('success', 'Successful!');
return redirect()->action('StaffController@whatonmymind');
 }  

 
}

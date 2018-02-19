<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use App\Department;
use App\Activity;
use App\Desination;
use App\User;
use App\Form;
use App\ActivityFlow;
use App\KnowledgeBase;
use App\FormField;
use App\Task;
use App\LeaveCat;
use App\LeaveType;
use App\RegisteredActivity;
use Auth;
use DB;
use Storage;
use File;
class HomeController extends Controller
{
  Const No =1;
  Const Yes =2;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$t =Task::where('staff_id',Auth::user()->id)->orderBy('status',0)->orderBy('id','desc')->paginate(20);

$rs =RegisteredActivity::where([['department_id',Auth::user()->department_id],['user_id',Auth::user()->id]])->get()->count();

$actflow =ActivityFlow::where('desination_id',Auth::user()->desination_id)->get()->groupBy('activity_id');




  return view('home.index')->withT($t)->withRs($rs)->withAf($actflow);
    }
  //================================= Department ===================================
    public function newDepartment()
    {
         $dept =Department::orderBy('name','ASC')->get();
        return view('home.department.index')->withD($dept);
    }
 // -------------------------------- post Department -------------------
     public function post_newDepartment(Request $request)
    {
        $request->validate(['name' => 'required',]);
          $dept =New Department;
          $dept->name =strtoupper($request->name);
          $dept->save();
          $request->session()->flash('success', 'successful!');
        return back();
    }


// -------------------------------- edit Department -------------------
     public function editDepartment($id)
    {
        if(isset($id)){
        $dept =Department::find($id);
        return view('home.department.editdepartment')->withD($dept);
    }
    return back();
    } 

// -------------------------------- update Department -------------------
     public function updateDepartment(Request $request,$id)
    {
          if(isset($id)){
        $dept=Department::find($id);
         $dept->name =strtoupper($request->name);
        $dept->save();
 $request->session()->flash('success', 'Update Successful!');

    return redirect()->action('HomeController@newDepartment');
    }
       return back();
    } 

//================================= Activity ===================================
    public function newActivity()
    {$act =Activity::orderBy('name','ASC')->get();
        return view('home.activity.index')->withAct($act);
    }
 // -------------------------------- postActivity -------------------
     public function post_newActivity(Request $request)
    {
        $request->validate(['name' => 'required',]);
          $act =New Activity;
          $act->name =strtoupper($request->name);
          $act->role =$request->role;
           $act->file =$request->file;
          $act->save();
          $request->session()->flash('success', 'successful!');
        return back();
    }


// -------------------------------- edit Activity -------------------
     public function editActivity($id)
    {
        if(isset($id)){
        $act=Activity::find($id);
        return view('home.activity.editactivity')->withD($act);
    }
    return back();
    } 

// -------------------------------- update Activity -------------------
     public function updateActivity(Request $request,$id)
    {
          if(isset($id)){
        $dept=Activity::find($id);
         $dept->name =strtoupper($request->name);
         $dept->role =$request->role;
          $dept->file =$request->file;
        $dept->save();
 $request->session()->flash('success', 'Update Successful!');

    return redirect()->action('HomeController@newActivity');
    }
       return back();
    } 

 //================================= Desination ===================================
    public function newDesination()
    {$des =Desination::orderBy('name','ASC')->get();
        return view('home.desination.index')->withDes($des);
    }
 // -------------------------------- postDesination -------------------
     public function post_newDesination(Request $request)
    {
        $request->validate(['name' => 'required',]);
          $des =New Desination;
          $des->name =strtoupper($request->name);
          $des->role =strtoupper($request->role);
          $des->save();
          $request->session()->flash('success', 'successful!');
        return back();
    }
// -------------------------------- edit Desination -------------------
     public function editDesination($id)
    {
        if(isset($id)){
        $des=Desination::find($id);
        return view('home.desination.editdesination')->withD($des);
    }
    return back();
    } 

// -------------------------------- update Desination -------------------
     public function updateDesination(Request $request,$id)
    {
          if(isset($id)){
        $des=Desination::find($id);
         $des->name =strtoupper($request->name);
          $des->role =strtoupper($request->role);
        $des->save();
 $request->session()->flash('success', 'Update Successful!');

    return redirect()->action('HomeController@newDesination');
    }
       return back();
    }

    //================================= user staff===================================
    public function newStaff()
    {    $d =Department::get();
         $ds = Desination::get();
        return view('home.staff.index')->withD($d)->withDs($ds);
    }
 // -------------------------------- postStaff -------------------
     public function post_newStaff(Request $request)
    {
        $request->validate(['fn' => 'required',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
         'phone' => 'required',
        'department_id' => 'required',]);
          $ds = Desination::find($request->desination_id); 
          $user =New User;
          $user->name =strtoupper($request->fn." ".$request->ln);
          $user->email =$request->email;
          $user->password =bcrypt($request->password);
          $user->word =$request->password;
          $user->department_id =$request->department_id;
          $user->status =1;
          $user->phone =$request->phone;
          $user->desination_id =$request->desination_id;

          $user->save();
          if($ds->role==self::Yes)
            {
          $user_role =DB::table('user_roles')->insert(['user_id' => $user->id, 'role_id' =>2]);
        }elseif ($ds->role==self::No) {
       $user_role =DB::table('user_roles')->insert(['user_id' => $user->id, 'role_id' =>3]);
        }
        
          $request->session()->flash('success', 'successful!');
        return back();
    }

// -------------------------------- view Staff -------------------
     public function viewStaff()
    {
        $d =Department::get();
        return view('home.staff.viewstaff')->withD($d);
    }

      public function post_viewStaff(Request $request)
    {
        $d =Department::get();
        $department_id =$request->department_id;
        if($department_id == 'All')
        {
      $user =User::get();
        }else
        {
    $user =User::where('department_id',$department_id)->get();
        }
        
        return view('home.staff.viewstaff')->withU($user)->withD($d);
    }
// -------------------------------- edit Staff -------------------
     public function editStaff($id)
    { 
      $d =Department::get();
      $ds = Desination::get();
        if(isset($id)){
        $user=User::find($id);
        return view('home.staff.editstaff')->withU($user)->withD($d)->withDs($ds);
    }
    return back();
    } 

// -------------------------------- update Staff -------------------
     public function updateStaff(Request $request,$id)
    {

          if(isset($id)){
       $ds = Desination::find($request->desination_id);    
        $user=User::find($id);
        // get designa8tion
         
         $user->name =strtoupper($request->name);
          $user->email =$request->email;
          $user->department_id =$request->department_id;
          $user->phone =$request->phone;
          $user->desination_id =$request->desination_id;
          $user->save();
          if($ds->role==self::Yes)
            {
$user_role =DB::table('user_roles')->where('user_id', $id)->update(['role_id' => 2]);
            }elseif ($ds->role==self::No) {
$user_role =DB::table('user_roles')->where('user_id', $id)->update(['role_id' => 3]);
            }
        
 $request->session()->flash('success', 'Update Successful!');

    return redirect()->action('HomeController@viewStaff');
    }
       return back();
    }

    public function statusStaff($id,$status)
    {
        $user=User::find($id);
        if($status == 1)
        {
        $newstatus =2;
         }elseif($status == 2)
         {
           $newstatus =1; 
         }
         $user->status =$newstatus;
         $user->save();
         return back();
    }  
// remove 
    public function removeStaff(Request $request, $id)
    { 
      $user=User::destroy($id);
      $user_role =DB::table('user_roles')->where('user_id', $id)->delete();
 $request->session()->flash('success', 'Successful!');
  return back();
    }
   //================================= user form===================================
    public function newForm()
    {    $act =Activity::get();
    
        return view('home.form.index')->withA($act);
    }
 // -------------------------------- postStaff -------------------
     public function post_newForm(Request $request)
    {
        $request->validate(['activity_id' => 'required',
        'name' => 'required',
        'type' => 'required',
        ]);
        $ff =FormField::where([['activity_id',$request->activity_id],['name',$request->name]])->first();

        if(count($ff) > 0)
        {
     $request->session()->flash('warning', 'field name exist, try another');
         return back(); 
        }else{
         $f =New FormField;
         $f->activity_id =$request->activity_id;
         $f->name =$request->name;
         $f->user_id =Auth::user()->id;
         $f->type =$request->type;
         $f->option =$request->option;
         $f->editable =$request->editable;
         $f->required =$request->required;
         $f->status =1;
         $f->save();   
        }
        $request->session()->flash('success', 'successful!');
        return back();
    }

// -------------------------------- view form -------------------
     public function viewForm()
    {
      $ff =FormField::orderBy('activity_id','ASC')->paginate(20);
    return view('home.form.viewform')->withF($ff);
    }
    // -------------------------------- edit form ------------------- 
    public function editForm($id)
    {
       $act =Activity::get();
    $f =FormField::find($id);
    return view('home.form.editform')->withF($f)->withId($id)->withA($act);
    }
    // -------------------------------- update form -------------------
      public function updateForm(Request $request,$id)
    {
    $f =FormField::find($id);
   $f->name =$request->name;
     $f->user_id =Auth::user()->id;
     $f->type =$request->type;
     $f->option =$request->option;
     $f->required =$request->required;
    $f->editable =$request->editable;
    $f->save(); 
    $request->session()->flash('success', 'successful!');  
      return redirect()->action('HomeController@viewForm');
    }
// -------------------------------- remove form -----------------------------
     public function removeForm($id)
    {
    $f =FormField::destroy($id);
    return back();
    }  
    //================================= ActivityFlow===================================
    public function newActivityFlow()
    {    $act =Activity::get();
    
        return view('home.activityflow.index')->withA($act);
    }
 // -------------------------------- ActivityFlow-------------------
     public function post_newActivityFlow(Request $request)
    {
        $act =Activity::get();
        $request->validate(['activity_id' => 'required','step' => 'required',]);
        $des =Desination::where('role',self::Yes)->get();
        $dt =Department::get();
        $step =$request->step;
        $activity_id=$request->activity_id;
        return view('home.activityflow.index')->withA($act)->withD($des)->withS($step)->withAid($activity_id)->withDt($dt);
      }
// -------------------------------- ActivityFlow-------------------
     public function submitActivityFlow(Request $request)
    {
     
        $step =$request->input('step');
        $act=$request->input('activity_id');
        $dt=$request->input('department_id');
      foreach ($step as $key => $value) {
        $desination_id =$request->input('desination_id')[$value];
        $reject_status =$request->input('reject_status')[$value];
        $edit_status =$request->input('edit_status')[$value];
        $approved_status =$request->input('approved_status')[$value];
$check =ActivityFlow::where([['step', $value], ['activity_id', $act], ['desination_id', $desination_id],['department_id', $dt]])->first();
  if (count($check) == 0) {
  $actflow =New ActivityFlow;
  $actflow->activity_id = $act;
  $actflow->user_id =Auth::user()->id;
  $actflow->step =$value; 
  $actflow->desination_id = $desination_id;
  $actflow->department_id = $dt;
  $actflow->reject_status =$reject_status; 
  $actflow->approved_status = $approved_status;
  $actflow->edit_status = $edit_status;
  $actflow->save();
                    }    
                  
                }
 $request->session()->flash('success', 'Successful!');

    return redirect()->action('HomeController@newActivityFlow');
      }
// -------------------------------- view ActivityFlow -------------------
     public function viewActivityFlow()
    {
        $d  =Activity::get();
        $dt =Department::get();
        return view('home.activityflow.viewactivityFlow')->withA($d)->withDt($dt);
    }

      public function post_viewActivityFlow(Request $request)
    {
        $dt =Department::get();
        $d =$act =Activity::get();
        $type =$request->activity_id;
        $dpt =$request->department_id;
        $f =ActivityFlow::where([['activity_id',$type],['department_id',$dpt]])->get();
      
        return view('home.activityflow.viewactivityFlow')->withF($f)->withA($d)->withAid($type)->withDt($dt)->withDpt($dpt);
    }
   // -------------------------------- view ActivityFlow -------------------
     public function editActivityFlow($id)
    {
      $f =ActivityFlow::find($id);
       $des =Desination::where('role',self::Yes)->get();
        return view('home.activityflow.editactivityFlow')->withD($des)->withId($id)->withA($f);
    }

      public function updateActivityFlow(Request $request,$id)
    {
      $f =ActivityFlow::find($id);
      $f->desination_id =$request->desination_id;
    $f->reject_status =$request->reject_status; 
  $f->approved_status = $request->approved_status;
  $f->edit_status = $request->edit_status;
      $f->save();
      $request->session()->flash('success', 'Successful!');

    return redirect()->action('HomeController@viewActivityFlow');
    }     
// -------------------------------- view ActivityFlow -------------------
     public function removeActivityFlow(Request $request,$id)
    {
      $f =ActivityFlow::find($id);
      $ff=ActivityFlow::where([['activity_id',$f->activity_id],['department_id',$f->department_id]])->orderBy('id','desc')->first();
      if($ff->id > $f->id)
      {
$request->session()->flash('warning', 'Delete the step below, before you can delete these');

      }else
      {
$f->destroy($id);
 $request->session()->flash('success', 'Successful!');
      }
return back();
  
      
      }
// -------------------------------- Rule ActivityFlow -------------------
     public function ruleActivityFlow($id)
    {
      $f =ActivityFlow::find($id);
     return view('home.activityflow.rule')->withId($id)->withA($f);
    }
 //================================= Knowledge Base===================================
    public function newKnowledgeBase()
    {    $d =Department::get();
    
        return view('home.knowledgebase.index')->withd($d);
    }
 // -------------------------------- ActivityFlow-------------------
     public function post_newKnowledgeBase(Request $request)
    {
         
        $request->validate(['department_id' => 'required',
        'content' => 'required',
        'subject' => 'required',
        ]);

        $k =new KnowledgeBase;
        $k->subject =$request->subject;
      $k->content =$request->content;
       $k->department_id =$request->department_id;
      $k->user_id =Auth::user()->id;
        if($request->hasFile('image')) {
            $image = $request->file('image')->store('img/knowledgebase');
           /*$filename = time() . '.' . $image->getClientOriginalExtension();
           $destinationPath = public_path('img/knowledgebase');
          $image->store($destinationPath . '/' . $filename);*/
         $k->image = $image;
          }
          $k->save();
      $request->session()->flash('success', 'Successful!');
        return back();
      }

// -------------------------------- view KnowledgeBase -------------------
  
      public function post_viewKnowledgeBase(Request $request)
    { 
      $d =Department::get();
      $k =KnowledgeBase::where('department_id',$request->department_id)->get();

       return view('home.knowledgebase.index')->withD($d)->withK($k);
    }
   // -------------------------------- view ActivityFlow -------------------
     public function editKnowledgeBase($id)
    {$d =Department::get();
      $k =KnowledgeBase::find($id);
   return view('home.knowledgebase.editknowledgebase')->withD($d)->withK($k);
    }

      public function updateKnowledgeBase(Request $request,$id)
    {
      $k =KnowledgeBase::find($id);
       $k->subject =$request->subject;
      $k->content =$request->content;
       $k->department_id =$request->department_id;
      $k->user_id =Auth::user()->id;
      $k->save();
      $request->session()->flash('success', 'Successful!');

    return back();
    }     
// -------------------------------- view KnowledgeBase -------------------
     public function removeKnowledgeBase(Request $request,$id)
    {
    KnowledgeBase::destroy($id);
 $request->session()->flash('success', 'Successful!');
  return back();
  }
  //get a8tta8chment

  public function getknowledgeBase_attachment($id)
  {
    $k =KnowledgeBase::find($id);
    $contents = Storage::get($k->image);
    $c =$k->image;
  return response()->file('storage/'.$k->image);
  //return response()->download($c);



  
 // $responseheader('Content-Type', 'application/pdf'); 

  
  }
      //=================task ===================================      

    public function task()
{    

  if(Auth::user()->department_id == 0)
    {
      $department =Department::orderBy('name','ASC')->get();
      $des_array =array();
      $designation =Desination::where('role',self::Yes)->get();
      foreach ($designation as $key => $value) {
        $des_array [] =$value->id;
      }
$d =User::whereIn('desination_id',$des_array)->get();
    }else{
       $d =User::where('department_id',Auth::user()->department_id)
    ->whereNotIn('id',[Auth::user()->id])->get();
    
    }
   $t =Task::where([['department_id',Auth::user()->department_id],['user_id',Auth::user()->id]])
    ->orderBy('id','desc')->paginate(20);
    return view('home.task.index')->withd($d)->withT($t)->withDpt($department);
    }
//post
      public function posttask(Request $request)
    {$request->validate(['end_date' => 'required','start_date' => 'required','staff_id' => 'required','content' => 'required',]);
    $t =new Task;
      $t->content =$request->content;
       $t->department_id =Auth::user()->department_id;
      $t->user_id =Auth::user()->id;
      $t->staff_id =$request->staff_id;
      $t->end_date =$request->end_date;
      $t->start_date =$request->start_date;
      $t->status =0;
      $t->save();
      $request->session()->flash('success', 'Successful!');
        return back();
      }

      // edit
        public function edittask($id)
    {    
      $d =User::where('department_id',Auth::user()->department_id)
    ->whereNotIn('id',[Auth::user()->id])->get();
    
    $et  =Task::find($id);
    return view('home.task.edit')->withd($d)->withT($et);
    }
    //upda8te

       public function updatetask(Request $request,$id)
    {
      $t =Task::find($id);
      $t->staff_id =$request->staff_id;
      $t->end_date =$request->end_date;
      $t->start_date =$request->start_date;
     $t->content =$request->content;
      $t->save();
      $request->session()->flash('success', 'Successful!');

 return redirect()->action('HomeController@task');
    } 
    // remove
    public function removetask(Request $request,$id)
    {
  Task::destroy($id);
 $request->session()->flash('success', 'Successful!');
  return back();
    }
    //finish
        public function finishtask(Request $request,$id)
    {
      $t =Task::find($id);
      $t->status =1;
      $t->completed_date =date('Y-m-d');
      $t->save();
      $request->session()->flash('success', 'Successful!');

 return redirect()->action('HomeController@index');
    } 

   public function profile ()
   {
    $u =User::find(Auth::user()->id);
    return view('home.profile.index')->withP($u);
   }

     public function postprofile (Request $request)
   {
    $u =User::find(Auth::user()->id);
    $u->name =strtoupper($request->name);
    $u->email =$request->email;
    $u->phone =$request->phone;
    $u->save();
    return view('home.profile.index')->withP($u);
   }

   public function leavecat()
   {
    $act =LeaveCat::get();
    return view('home.leavetype.index')->withA($act);
   }
    public function postleavecat(Request $request)
   {
    $lc =LeaveCat::find($request->id);
    $lc->days =$request->days;
    $lc->save();
    $request->session()->flash('success', 'Successful!');
    return redirect()->action('HomeController@leavecat');
 
   }

   public function leavetype()
   {
    $lc =LeaveCat::get();
    $act =Activity::get();
    $lt =LeaveType::orderBy('activity_id','ASC')->orderBy('leavecat_id','ASC')->get();
    return view('home.leavetype.type')->withA($act)->withLc($lc)->withLt($lt);
   }
    public function postleavetype(Request $request)
   {
    $lt =new LeaveType;
    $lt->name =$request->name;
    $lt->activity_id =$request->activity_id;
    $lt->leavecat_id =$request->leavecat_id;
    $lt->save();
    $request->session()->flash('success', 'Successful!');
    return redirect()->action('HomeController@leavetype');
 
   }

   public function getdepartment($id)
{
$sql =User::where('department_id',$id)->orderBy('name','ASC')->get();
return $sql;
}
 

}

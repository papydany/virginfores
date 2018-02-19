<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//======================================Department =================================================
Route::get('newDepartment',['uses' =>'HomeController@newDepartment','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('newDepartment',['uses' =>'HomeController@post_newDepartment','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('editDepartment/{id}',['uses' =>'HomeController@editDepartment','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('updateDepartment/{id}',['uses' =>'HomeController@updateDepartment','middleware' => 'roles','roles'=>'SupperAdmin']);

//======================================Activity =================================================
Route::get('newActivity',['uses' =>'HomeController@newActivity','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('newActivity',['uses' =>'HomeController@post_newActivity','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('editActivity/{id}',['uses' =>'HomeController@editActivity','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('updateActivity/{id}',['uses' =>'HomeController@updateActivity','middleware' => 'roles','roles'=>'SupperAdmin']);

//======================================Desination=================================================
Route::get('newDesination',['uses' =>'HomeController@newDesination','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('newDesination',['uses' =>'HomeController@post_newDesination','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('editDesination/{id}',['uses' =>'HomeController@editDesination','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('updateDesination/{id}',['uses' =>'HomeController@updateDesination','middleware' => 'roles','roles'=>'SupperAdmin']);

//======================================staff=================================================
Route::get('newStaff',['uses' =>'HomeController@newStaff','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('newStaff',['uses' =>'HomeController@post_newStaff','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('viewStaff',['uses' =>'HomeController@viewStaff','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('viewStaff12',['uses' =>'HomeController@post_viewStaff','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('editStaff/{id}',['uses' =>'HomeController@editStaff','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('updateStaff/{id}',['uses' =>'HomeController@updateStaff','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('statusStaff/{id}/{status}',['uses' =>'HomeController@statusStaff','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('removeStaff/{id}',['uses' =>'HomeController@removeStaff','middleware' => 'roles','roles'=>'SupperAdmin']);

//======================================Formf=================================================
Route::get('newForm',['uses' =>'HomeController@newForm','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('newForm',['uses' =>'HomeController@post_newForm','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('viewForm',['uses' =>'HomeController@viewForm','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('editForm/{id}',['uses' =>'HomeController@editForm','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('updateForm/{id}',['uses' =>'HomeController@updateForm','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('removeForm/{id}',['uses' =>'HomeController@removeForm','middleware' => 'roles','roles'=>'SupperAdmin']);
//======================================ActivityFlow=================================================
Route::get('newActivityFlow',['uses' =>'HomeController@newActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('newActivityFlow',['uses' =>'HomeController@post_newActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('viewActivityFlow',['uses' =>'HomeController@viewActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('viewActivityFlow',['uses' =>'HomeController@post_viewActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('editActivityFlow/{id}',['uses' =>'HomeController@editActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('updateActivityFlow/{id}',['uses' =>'HomeController@updateActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('submitActivityFlow',['uses' =>'HomeController@submitActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('removeActivityFlow/{id}',['uses' =>'HomeController@removeActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('ruleActivityFlow/{id}',['uses' =>'HomeController@ruleActivityFlow','middleware' => 'roles','roles'=>'SupperAdmin']);
//======================setup leave type=================================
Route::get('leavecat',['uses' =>'HomeController@leavecat','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('leavecat',['uses' =>'HomeController@postleavecat','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('editcat/{id}',['uses' =>'HomeController@editleavecat','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('updateleavecat/{id}',['uses' =>'HomeController@updateleavecat','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('leavetype',['uses' =>'HomeController@leavetype','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('leavetype',['uses' =>'HomeController@postleavetype','middleware' => 'roles','roles'=>'SupperAdmin']);
//================newknowledgeBase=================================================
Route::get('newknowledgeBase',['uses' =>'HomeController@newknowledgeBase','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('newknowledgeBase',['uses' =>'HomeController@post_newknowledgeBase','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('viewknowledgeBase',['uses' =>'HomeController@newknowledgeBase','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('viewknowledgeBase',['uses' =>'HomeController@post_viewknowledgeBase','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('editknowledgeBase/{id}',['uses' =>'HomeController@editknowledgeBase','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::post('updateknowledgeBase/{id}',['uses' =>'HomeController@updateknowledgeBase','middleware' => 'roles','roles'=>'SupperAdmin']);

Route::get('removeknowledgeBase/{id}',['uses' =>'HomeController@removeknowledgeBase','middleware' => 'roles','roles'=>'SupperAdmin']);
Route::get('getknowledgeBase_attachment/{id}',['uses' =>'HomeController@getknowledgeBase_attachment','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
//================sta8ff crea8te a8ctivity=================================================
Route::get('createActivity/{id}',['uses' =>'StaffController@index','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
Route::post('createActivity',['uses' =>'StaffController@createActivity','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
Route::post('submitcreateActivity',['uses' =>'StaffController@submitcreateActivity','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
//======================================Read Knowledge=================================================
Route::get('readKnowledge',['uses' =>'StaffController@readKnowledge','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);

//====================Wha8t on my mind=================================================
Route::get('whatonmymind',['uses' =>'StaffController@whatonmymind','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
Route::post('whatonmymind',['uses' =>'StaffController@postwhatonmymind','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
Route::get('editwhatonmymind/{id}',['uses' =>'StaffController@editwhatonmymind','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
Route::post('updatewhatonmymind/{id}',['uses' =>'StaffController@updatewhatonmymind','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);

Route::get('removewhatonmymind/{id}',['uses' =>'StaffController@removewhatonmymind','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
//===============================memo ===============================================================

Route::get('memo',['uses' =>'StaffController@memo','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
Route::post('memo',['uses' =>'StaffController@postmemo','middleware' => 'roles','roles'=>['SupperAdmin','user','Admin']]);
//===============================task===============================================================

Route::get('task',['uses' =>'HomeController@task','middleware' => 'roles','roles'=>['SupperAdmin','Admin']]);
Route::post('task',['uses' =>'HomeController@posttask','middleware' => 'roles','roles'=>['SupperAdmin','Admin']]);
Route::get('edittask/{id}',['uses' =>'HomeController@edittask','middleware' => 'roles','roles'=>['SupperAdmin','Admin']]);
Route::post('updatetask/{id}',['uses' =>'HomeController@updatetask','middleware' => 'roles','roles'=>['SupperAdmin','Admin']]);
Route::get('removetask/{id}',['uses' =>'HomeController@removetask','middleware' => 'roles','roles'=>['SupperAdmin','Admin']]);
Route::get('finishtask/{id}',['uses' =>'HomeController@finishtask','middleware' => 'roles','roles'=>['SupperAdmin','Admin','user']]);

//======================profile ===========================================
Route::get('profile',['uses' =>'HomeController@profile','middleware' => 'roles','roles'=>['SupperAdmin','Admin','user']]);
Route::post('profile',['uses' =>'HomeController@postprofile','middleware' => 'roles','roles'=>['SupperAdmin','Admin','user']]);

//======================myactivity ===========================================
Route::get('myactivity',['uses' =>'StaffController@myactivity','middleware' => 'roles','roles'=>['SupperAdmin','Admin','user']]);
Route::post('myactivity',['uses' =>'StaffController@postmyactivity','middleware' => 'roles','roles'=>['SupperAdmin','Admin','user']]);
Route::get('viewmyactivity/{id}/{pdf?}',['uses' =>'StaffController@viewmyactivity','middleware' => 'roles','roles'=>['SupperAdmin','Admin','user']]);
Route::get('myactivity/{id}',['uses' =>'StaffController@adminmyactivity','middleware' => 'roles','roles'=>['SupperAdmin','Admin','user']]);

Route::get('getdepartment/{id}', 'HomeController@getdepartment');
//
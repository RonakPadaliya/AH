<?php

use Illuminate\Support\Facades\Route;
use App\Models\class_details;
use App\Models\assignment_details;
use Illuminate\Support\Facades\DB;
use App\Models\user_class_details;
use App\Models\assignment_submissions;
use App\Models\User;
use Carbon\Carbon;
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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home',function()
{   
    $create=class_details::all()->where('user_id',auth()->user()->id);
    $join = user_class_details::all()->where('user_id',auth()->user()->id); //joined students
    $array;
    $count=0;
    foreach($create as $c){
        $array[$count]=$c;
        $count++;
    }
    foreach($join as $j)
    {
        $cls = class_details::all()->where('id',$j->class_code);
        foreach($cls as $t)
        {
            $array[$count]=$t;
            $count++;
        }
    }
    if(isset($array))
        return view('home/view_class')->with('classes',$array);
    else
        return view('home/view_class');
});
Route::get('/create_class',function()
{
    return view('home/create_class');
});
Route::post('/create_class',function()
{
    $clss=new class_details;
    $clss->class_name=request('name');
    $clss->class_description=request('description');
    $clss->user_id=auth()->user()->id;
    $clss->participants=1;
    $clss->save();
    return redirect('/home');
});
Route::get('/class_home/{slug}',function()
{
    $id=request('slug');
    $author_id =  class_details::where(['id'=>$id])->get();
    $author = User::where(['id'=>$author_id['0']->user_id])->get();
    $assigmets=assignment_Details::all()->where('class_code', $id);
    $c = class_details::where(['id'=>$id])->get();
    return view('home/class_home')->with('ass',$assigmets)->with('class',$c['0'])->with('author',$author['0']);
   # return view('teacher/class_home')->with('id',$id);
});
Route::get('/create_assignment/{slug}',function()
{
    $id=request('slug');
    return view('home/create_assignment')->with('id',$id);
});
Route::post('/create_assignment/{slug}',function()
{
    $ass=new assignment_details;
    $file=request('assignment_file');
    //dd($file);
    if($file!=null){
        $file_name=$file->getClientOriginalName();
        $file->move('upload_files',$file_name);
        $ass->assignment_file=$file_name;
    } 
    $ass->due_Date = request('due_Date');
    $ass->class_code=request('slug');
    $ass->assignment_title = request('title');
    $ass->assignment_description = request('description');
    $ass->save();
    $cls=class_details::all()->where('id',request('slug'))->first();
    
	$users = user_class_details::all()->where('class_code',request('slug'));
    foreach($users as $user){
        $u = User::where(['id'=>$user->user_id])->first();
        $email = $u->email;
        $content='Your Teacher Has Posted New Assignment in '.$cls->class_name;
        $data = array('content'=>$content);
        Mail::send('mail',$data,function($message) use ($email){
            $message->to($email)->subject
               ('New Assignment ');
            $message->from('ronakpadaliya11@gmail.com','New Assignment');
         });
	}
    return redirect('/home');
});
Route::get('/assignment/{slug}', function(){
    $assignment = assignment_Details::where(['id'=>request('slug')])->get();
    //echo $assignment;
    $author = class_details::where(['id'=>$assignment['0']->class_code, 'user_id'=>auth()->user()->id])->get();
    if(sizeof($author)){
        $submissions = assignment_submissions::all()->where('class_code', $assignment['0']->class_code)->where('assignment_id',$assignment['0']->id);
        $array = [];
        $status = [];
        $count=0;
        foreach($submissions as $sub)
        {
            $usr = User::where(['id'=>$sub->user_id])->first();
            if($usr!=null){
                $array[$count] = $usr;
                $sub_date = Carbon::parse($sub->created_at->timezone('Asia/Kolkata'));
                $due_date = $assignment['0']->due_Date;
                if($sub_date->lte($due_date))
                {
                    $status[$count] = "On Time";
                }else{
                    $status[$count] = "Late Submission";                
                }
                $count++;
            }
        }
        return view('home/show_assignment')->with('submissions',$array)->with('assignment',$assignment['0'])->with('status',$status)->with('sub_date',$submissions);
    }
    $alredysubmit = assignment_submissions::where('class_code', $assignment['0']->class_code)->where('user_id',auth()->user()->id)->where('assignment_id',$assignment['0']->id)->get();
    if(!sizeof($alredysubmit)) 
        return view('home/show_assignment')->with('assignment',$assignment['0']);
    return view('home/show_assignment')->with('assignment',$assignment['0'])->with('submission', $alredysubmit['0']);
});
Route::get('/show_assignment/{slug}',function()
{
    $code=request('slug');
    $assigmets=assignment_Details::all()->where('class_code', $code);
    return view('home/class_home')->with('ass',$assigmets);
});
Route::get('/join_class',function()
{
    return view('home/joinClass');
});

Route::post('/join_class',function(){
    $cls_code=request('class_code');
    $user_id=auth()->user()->id;
    $cls=class_details::where('id',$cls_code)->where('user_id','!=',$user_id)->get();
    if(isset($cls['0']))
    {
        $alred=user_class_details::where('user_id',$user_id)->where('class_code',$cls_code)->get();
        if(!sizeof($alred))
        {
            $clss=new user_class_details;
            $clss->user_id=auth()->user()->id;
            $clss->class_code=$cls_code;
            $clss->save();     
        }
        return redirect('/home');
    }
    else{
        return redirect('/join_class')->withErrors(['Please Provide correct class code']);
    }
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/home');
})->name('dashboard');

Route::get('/logout',function()
{
    session()->flush();
    auth()->logout();
    return redirect('/');
}
);
Route::post('/invite/{slug}',function()
{
    $emails=request('invite_email');
    $data = array('content'=>'Your Teacher Invite You To Join Class with class code:-'.request('slug'));
    Mail::send('mail',$data,function($message) use ($emails){
        $message->to($emails)->subject
           ('You are invited to join the class ');
        $message->from('jaydevbambhaniya45@gmail.com','Class Invitation');
    });
    $message= "Invited";
    
    //echo '<script>alert("Welcome to Geeks for Geeks")</script>'; 
    Session::put('msg',"Successfully Invited!!!");
    return redirect('/class_home/'.request("slug"));
}
);

Route::post('/submit_assignment/{slug}', function(){
    $ass = new assignment_submissions;
    $ass_details = assignment_Details::where(['id'=>request('slug')])->get();
    $file=request('up_file');
    if($file!=null){
        $file_name=$file->getClientOriginalName();
        $file->move('submission_files',$file_name);
        $ass->assignment_file=$file_name;
    } 
    $ass->assignment_id = $ass_details['0']->id;
    $ass->user_id = auth()->user()->id;
    $ass->class_code = $ass_details['0']->class_code;
    $ass->save();
    return redirect('/home');
});

Route::get('/people/{slug}', function(){
    $class = class_details::where(['id'=>request('slug')])->get();
    $author = User::where(['id'=>$class['0']->user_id])->get();
    $u = user_class_details::all()->where('class_code',request('slug'));
    $users = [];
    $count=0;
    foreach($u as $user)
    {
        $us = User::where(['id'=>$user->user_id])->get();
        echo "\n";
        $users[$count] = $us['0'];
        $count++;
    }
    return view('home/people')->with('author',$author['0'])->with('users',$users);
});
Route::get('/unenroll/{slug}', function(){
    $author = auth()->user()->id;
	DB::delete('delete from class_details where user_id=? and id=?',[$author, request('slug')]);
    DB::delete('delete from user_class_details where user_id=? and class_code=?',[$author, request('slug')]);
    return redirect('/home');
});

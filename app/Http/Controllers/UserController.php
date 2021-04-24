<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class UserController extends Controller
{


	        function __construct()
{

$this->middleware('permission:users-list', ['only' => ['index','store']]);
$this->middleware('permission:users-create', ['only' => ['create','store']]);
$this->middleware('permission:users-edit', ['only' => ['edit','update']]);
$this->middleware('permission:users-delete', ['only' => ['destroy']]);
}
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
	$title = trans('admin.Users') ;
	$data = User::orderBy('id','DESC')->paginate(5);
return view('admin.users.index',compact('data' , 'title'))
->with('i', ($request->input('page', 1) - 1) * 5);
}

public function notify(){
	\auth()->user()->unreadNotifications->markAsRead();
	return 'hello' ;

}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
$title = trans('admin.Users') ;
$roles = Role::all();
return view('admin.users.create',compact('roles' , 'title'));
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$data = $this->validate($request, [
'name' 		=> 'required',
'email' 	=> 'required|email|unique:users,email',
'password' 	=> 'required',
'member' 	=> 'required',
'status' 	=> 'required',
]);


$data['password'] = Hash::make($data['password']);


$user = new User ;
$user->name = $data['name'];
$user->email = $data['email'];
$user->password = $data['password'];
$user->member = $data['member'];
$user->status = $data['status'];
$user->save();

$user->assignRole($data['member']);

 session()->flash('success' , trans('admin.successToAdd'));
 return back();
}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{

}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{

$title = trans('admin.edit');
$data  = User::find($id);
$roles = Role::pluck('name' , 'id')->all();
return view('admin.users.edit',compact('data' ,'title' , 'roles'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
	$data = $this->validate($request, [
	'name' 		=> 'required',
	'email' 	=> 'required|email|unique:users,email,'.$id,
	'password' 	=> 'sometimes|nullable',
	'member' 	=> 'required',
	'status' 	=> 'required',
	]);


	$user 			= User::find($id);
	$user->name 	= $data['name'];
	$user->email 	= $data['email'];
	if(!empty($input['password'])){
	$data['password'] = Hash::make($data['password']);
	}else{
		unset($data['password']);
	}
	$user->member 	= $data['member'];
	$user->status 	= $data['status'];
	$user->save();

	DB::table('model_has_roles')->where('model_id',$id)->delete();
	$user->assignRole($data['member']);
	return redirect()->route('users.index')
	->with('success', trans('admin.successToAdd'));
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
 if(is_array(request('del')) ){
            $id = request('del') ;
           User::destroy($id);
           session()->flash('success' , trans('admin.succsess_delete'));
           return back();
        }else{
             $id = request('id') ;
           User::destroy($id);
           session()->flash('success' , trans('admin.succsess_delete'));
           return back();
        }
}
}
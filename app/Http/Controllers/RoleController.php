<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
function __construct()
{

$this->middleware('permission:role-list', ['only' => ['index','store']]);
$this->middleware('permission:role-create', ['only' => ['create','store']]);
$this->middleware('permission:role-edit', ['only' => ['edit','update']]);
$this->middleware('permission:role-delete', ['only' => ['destroy']]);
}
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
	$title = trans('admin.roles') ;
$data = Role::orderBy('id','DESC')->paginate(5);
return view('admin.roles.index',compact('data' , 'title'));;
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
$title = trans('admin.permission');
$permission = Permission::get();
return view('admin.roles.create',compact('permission' , 'title'));
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
'name' => 'required|unique:roles,name',
'permission' => 'required',
]);

$role = Role::create(['name' => $data['name'] ]);
$role->syncPermissions( $request['permission']);
session()->flash('success' , 'success to add permission');
return redirect()->route('roles.index')->with('success' ,  trans('admin.successToAdd'));

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

$title = trans('admin.edit') ;
$role = Role::find($id);
$permission = Permission::all();
 $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
 ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
 ->all();
return view('admin.roles.edit',compact('role','permission','rolePermissions','title'));
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
		'name' => 'required',
		'permission' => 'required',
		]);
	$role = Role::find($id);
	$role->name = $data['name'];
	$role->save();
	$role->syncPermissions($data['permission']);
	return redirect()->route('roles.index')
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

           DB::table("roles")->where('id' , $id)->delete($id);
		return redirect()->route('roles.index')
		->with('success', trans('admin.succsess_delete'));
          
        }

        else{
        	$id = request('id') ;
             DB::table("roles")->where('id',$id)->delete();
			return redirect()->route('roles.index')
			->with('success', trans('admin.succsess_delete'));
        }

}

}
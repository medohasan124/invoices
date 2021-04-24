<?php
use Illuminate\Database\Seeder;
use App\User;
use App\products ;
use App\sections;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{

	 \DB::table('users')->delete() ;
  \DB::table('model_has_roles')->delete() ;
   \DB::table('roles')->delete() ;

   \DB::table('sections')->delete() ;
   \DB::table('products')->delete() ;

 $role = Role::create(['name' => 'Admin']);
 $permissions = Permission::pluck('id','id')->all();
 $role->syncPermissions($permissions);


$user = User::create([
'name' => 'medo',
'email' => 'medo@yahoo.com',
'member' => 1,
'status' => 'active',

'password' => bcrypt('123123123')
]);

$user->assignRole([$role->id]);


sections::create([
'name' => 'bank masr',
'description' => 'description',
'addBy' => '1',
]);

products::create([
'name' => 'invoices',
'section_id' => '1',
'addBy' => '1',
]);

}
}
<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	\DB::table('permissions')->delete() ;
	\DB::table('role_has_permissions')->delete() ;
$permissions = [
'role-list',
'role-create',
'role-edit',
'role-delete',

'invoice-list',
'invoice-create',
'invoice-edit',
'invoice-delete',

'users-list',
'users-create',
'users-edit',
'users-delete',

'section-list',
'section-create',
'section-edit',
'section-delete',

'product-list',
'product-create',
'product-edit',
'product-delete',
];
$i = 0 ;
foreach ($permissions as $permission) {
	$i = $i + 1 ;
	Permission::create(['name' => $permission]);
	\DB::table('role_has_permissions')->insert(['permission_id' => $i , 'role_id' => '1'] );
}

}
}
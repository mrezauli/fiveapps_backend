<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    /**
     * Save user information
     * @author Touch and Solve <email>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param Request $request
     * @created 17-04-24
     * 
     * @return mixed
     */
    public function getPermissionByRole(Request $request) {
        if ($request->isMethod('post')){
          $role_id = decrypt($request->post('role_id'));
          $role = Role::find($role_id);
          $permission = $role->permissions()->get();
          return $permission;
        }
    }
    
    
    /**
     * Save user information
     * @author Touch and Solve <email>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param Request $request
     * @created 17-04-24
     * 
     * @return mixed
     */
    public function managePermission(Request $request) {
        if($request->isMethod("POST")){
            $request->validate([
                'role' => 'required'
            ]);

            $data = $request->all();
            DB::beginTransaction();
            try {
                $roleId = decrypt($data['role']);
                $role = Role::find($roleId);
                if (isset($data['permission'])) {
                    $permission = Permission::whereIn('id', $data['permission'])->get();
                    $role->syncPermissions($permission);
                } else {
                    DB::table('role_has_permissions')->where('role_id', $role->id)->delete();
                }
                DB::commit();

                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with(['success' => true, 'type' => 'error', 'message' => 'Something was wrong']);
            }
        }else {
            $roles = Role::all();
            $dataPer = Permission::all();
            $permissions = [];
            foreach ($dataPer as $permission) {
                $permissions[$permission->type][] = [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ];
            }
            $permissions = collect($permissions);

            $data = ['roles' => $roles, 'permissions' => $permissions];

            return view('role.permission', $data);
        }
         
    }
}

<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
  public function index()
  {
    $data['roles'] = Role::orderby('created_at', 'asc')->get();
    return view('role.index', $data);
  }
  public function create()
  {
    return view('role.create');
  }


  public function manage($id = null)
  {
    if (in_array($id, [1])){
      return RedirectHelper::routeWarning('role.index', '<strong>Sorry!!!</strong> Role update not possible');
    }
    if ($data['role'] = Role::find($id)) {
      return view('role.edit', $data);
    }
    return RedirectHelper::routeWarning('role.index', '<strong>Sorry!!!</strong> Role not found');
  }


  public function store(Request $request)
  {
    $message = '<strong>Congratulations!!!</strong> Role successfully ';
    if ($request->has('id')) {
      $role = Role::find($request->id);
      $rules['name'] = 'required|string|unique:roles,name,' . $request->id;
      $message = $message . ' updated';
    } else {
      $role = new Role();
      $rules['name'] = 'required|string|unique:roles,name';
      $message = $message . ' created';
    }
    $request->validate($rules);

    try {
      $role->name = $request->name;
      $role->guard_name = 'web';
      if ($role->save()) {
        return RedirectHelper::routeSuccess('role.index', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request, $id)
  {
    $id = $request->post('id') ?? $id;

    if (!in_array($id, [1])){

      try {
        $role = Role::find($id);
        if ($role->delete()) {
          return 'success';
        }
      } catch (\Exception $e) {}
    }
  }


  public function ajaxUpdateStatus(Request $request)
  {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $role = Role::find($id);
      if ($role->update(['status' => $status])) {
        return "success";
      }
    }
  }
}

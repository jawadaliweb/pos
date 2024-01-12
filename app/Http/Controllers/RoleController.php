<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache; 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; 
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;


class RoleController extends Controller
{
    public function AllPermissions() {
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
        
    }
    public function AddPermissions() {
        $permissions = Permission::all();
        return view('backend.pages.permission.add_permission', compact('permissions'));
        
    }

    public function StorePermission(Request $request) {

        $role = Permission::create([
         'name' => $request->name,
         'group_name' => $request->group_name
        ]);

        return redirect('/all/permissions')->with('success', 'Permission Sucessfully added');
    }

    public function UpdatePermission($id) {
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.update_permission', compact('permission'));

    }

    public function EditPermission(Request $request, $id) {

        $data = [
            'name' => $request->name,
            'group_name' => $request->group_name
            ];
    
            Permission::findOrfail($id)->update($data);
           return redirect('/all/permissions')->with('success', 'Permission Sucessfully Updated');
       }

       public function DeletePermission($id) {
           Permission::findOrfail($id)->delete();
           return redirect('/all/permissions')->with('success', 'Permission Sucessfully Deleted');
       }
    

       ///////////////////All Roles////////////////////////

       public function AllRoles() {
        $roles = Role::all();
          return view('backend.pages.role.add_role', compact('roles'));
       }


    public function AddRoles() {
        $roles = Role::all();
        return view('backend.pages.role.add_role', compact('roles'));
        }

    public function StoreRoles(Request $request) {

        $role = Role::create($request->all());

        return redirect('/all/roles')->with('success', 'Roles Sucessfully added');
        }

    public function UpdateRoles($id) {
        $role = Role::findOrFail($id);
        $roles = Role::all();
        return view('backend.pages.role.update_role', compact('role','roles'));

    }

    public function EditRoles(Request $request, $id) {

        $data = [
            'name' => $request->name,
            'group_name' => $request->group_name
            ];
    
            Role::findOrfail($id)->update($data);
           return redirect('/all/roles')->with('success', 'Roles Sucessfully Updated');
       }

       public function DeleteRoles($id) {
        Role::findOrfail($id)->delete();
           return redirect('/all/roles')->with('success', 'Roles Sucessfully Deleted');
       }

/////////////////Assisgn Permission//////////////////////////

public function AllPermission() {
    $roles = Role::all();
    $permissions = Permission::all();
    $permission_groups = Permission::select('group_name')->groupBy('group_name')->get();
    $RoleHasPermission = DB::table('role_has_permissions')->get();

    return view('backend.pages.assign_permissions.all_roles_permissions', compact('roles', 'permissions', 'permission_groups', 'RoleHasPermission'));
}



public function AssignRolesPermission(Request $request) {
    $role = Role::find($request->role_id);

    if (!$role) {
        return redirect()->back()->with('error', 'Role not found');
    }

    $permissions = Permission::whereIn('id', $request->permission)->get();

    if ($permissions->isEmpty()) {
        $role->permissions()->detach();
    } else {
        $role->permissions()->sync($permissions);
    }

    // Clear the cache associated with permissions (replace 'your_cache_key' with the actual cache key used)
    Cache::forget('users');

    return redirect()->back()->with('success', 'Roles successfully assigned');
}



public function UserList() {
    $users = User::all();
    $roles = Role::all();
    return view('backend.pages.add_user.user_list', compact('users','roles'));
}

///////////user adding //////////////////////////

public function registeruser(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'phone' => 'required|string',
        'role' => 'required', // Adjust based on your roles
        'password' => 'required|confirmed',
    ]);

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'password' => Hash::make($request->input('password')),
    ]);

    $user->assignRole($request->input('role'));

    return redirect()->back()->with('success','user added sucessfully');
}

public function UserEdit($id)
{
    $user = User::findOrFail($id);
    $roles = Role::all();
    $users = User::all();


    return view('backend.pages.add_user.user_update', compact('user','roles','users'));
}

public function UserUpdate(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'required|string',
        'role' => 'required', // Adjust based on your roles
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    $role = Role::find($request->role);
    if ($role) {
        $user->syncRoles([$role]);
    } else {
        return redirect()->back()->with('error', 'Role Not found');
    }

    return redirect()->back()->with('success', 'User updated successfully');
}

public function UserDelete($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully');
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        Alert::toast('Role updated!', 'success');
        return redirect()->route('account.dashboard');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        Alert::toast('Role deleted!', 'success');
        return redirect()->route('account.dashboard');
    }
}

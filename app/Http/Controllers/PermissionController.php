<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();
        Alert::toast('Permission updated!', 'success');
        return redirect()->route('account.dashboard');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        Alert::toast('Permission deleted!', 'success');
        return redirect()->route('account.dashboard');
    }
}

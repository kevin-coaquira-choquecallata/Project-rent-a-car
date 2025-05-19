<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $usuarios = User::with('role')->get();
        $roles = Role::all();
        return view('admin.usuarios.index', compact('usuarios','roles'));
    }

    public function actualizarRol(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('admin.usuarios')->with('status', 'Rol actualizado correctamente');
    }
    public function eliminar(User $user)
    {
        if(auth() === $user->id){
            return back()->with('status','No puedes eliminarte a ti mismo');
        }
        $user->delete();
        return redirect()->route('admin.usuarios')->with('status','Usuario eliminado correctamente');
    }
}

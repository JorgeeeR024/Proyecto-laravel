<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validaciones para crear
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,teacher,student'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']); // siempre encripta

        User::create($data);

        return redirect()->route('admin.users.index');
    }

    public function show(User $users)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validaciones para editar
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$user->id_user},id_user",
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,teacher,student'
        ]);

        $data = $request->all();

        // Encriptar solo si viene nueva contraseña
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index');
    }

   

public function destroy($id_user)
{
    $user = User::findOrFail($id_user);

    // Si el usuario a eliminar es el mismo que está logueado
    if (Auth::id() === $user->id_user) {
        Auth::logout(); // cerrar sesión
        return redirect()->route('login')->with('status', 'Sesión cerrada, no puedes eliminar tu propia cuenta.');
    }

    // Si es otro usuario
    $user->delete();
    return redirect()->route('admin.users.index')->with('status', 'Usuario eliminado correctamente.');
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:users.create')->only(['create', 'store']);
        $this->middleware('can:users.index')->only(['index']);
        $this->middleware('can:users.edit')->only(['edit', 'update']);
        $this->middleware('can:users.show')->only(['show']);
        $this->middleware('can:users.destroy')->only(['destroy']);
    }

    public function index()
    {
        try {
            $user = Auth::user();
            $username = $user->name;
            $users = User::get();
            return view('admin.user.index', compact('users', 'username'));
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener la lista de usuarios.');
        }
    }

    public function create()
    {
        try {
            $roles = Role::get();
            return view('admin.user.create', compact('roles'));
        } catch (\Exception $e) {
            Log::error('Error creating user form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario de creación de usuario.');
        }
    }

    public function store(Request $request)
{
    
    $request->validate([
        'email' => 'required|email|unique:users,email|ends_with:gmail.com,hotmail.com,yahoo.com,outlook.com',
       
        'password' => 'required|min:8',
    ]);

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        
        $user->roles()->sync($request->get('roles'));

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    } catch (\Exception $e) {
        Log::error('Error storing user: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Ocurrió un error al crear el usuario.');
    }
}



    public function show(User $user)
    {
        try {
            return view('admin.user.show', compact('user'));
        } catch (\Exception $e) {
            Log::error('Error showing user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al mostrar el usuario.');
        }
    }

    public function edit(User $user)
    {
        try {
            $roles = Role::get();
            return view('admin.user.edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            Log::error('Error editing user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario de edición de usuario.');
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $user->update($request->all());
            $user->roles()->sync($request->get('roles'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el usuario.');
        }
    }

    public function destroy(User $user)
{
    try {
       
        $user->roles()->detach();

        
        $user->delete();

        return back()->with('success', 'Usuario eliminado exitosamente.');
    } catch (\Exception $e) {
        Log::error('Error deleting user: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Ocurrió un error al eliminar el usuario.');
    }
}

}

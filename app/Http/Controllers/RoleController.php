<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:roles.create')->only(['create', 'store']);
        $this->middleware('can:roles.index')->only(['index']);
        $this->middleware('can:roles.edit')->only(['edit', 'update']);
        $this->middleware('can:roles.show')->only(['show']);
        $this->middleware('can:roles.destroy')->only(['destroy']);
    }

    public function index()
    {
        try {
            $roles = Role::get();
            return view('admin.role.index', compact('roles'));
        } catch (\Exception $e) {
            Log::error('Error fetching roles: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener la lista de roles.');
        }
    }

    public function create()
    {
        try {
            $permissions = Permission::get();
            return view('admin.role.create', compact('permissions'));
        } catch (\Exception $e) {
            Log::error('Error creating role form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario de creación de rol.');
        }
    }

    public function store(Request $request)
    {
        try {
            $role = Role::create($request->all());
            $role->permissions()->sync($request->get('permissions'));
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            Log::error('Error storing role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al crear el rol.');
        }
    }

    public function show(Role $role)
    {
        try {
            return view('admin.role.show', compact('role'));
        } catch (\Exception $e) {
            Log::error('Error showing role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al mostrar el rol.');
        }
    }

    public function edit(Role $role)
    {
        try {
            $permissions = Permission::get();
            return view('admin.role.edit', compact('role', 'permissions'));
        } catch (\Exception $e) {
            Log::error('Error editing role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario de edición de rol.');
        }
    }

    public function update(Request $request, Role $role)
    {
        try {
            $role->update($request->all());
            $role->permissions()->sync($request->get('permissions'));
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            Log::error('Error updating role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el rol.');
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return back();
        } catch (\Exception $e) {
            Log::error('Error deleting role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el rol.');
        }
    }
}

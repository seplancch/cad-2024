<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin');
    }

    public function index()
    {
        $roles = Role::with(['permissions', 'users'])->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['exists:permissions,id']
        ], [
            'name.required' => 'El nombre del rol es obligatorio',
            'name.unique' => 'Este nombre de rol ya existe',
            'permissions.required' => 'Debe seleccionar al menos un permiso',
            'permissions.*.exists' => 'Uno o más permisos seleccionados no son válidos'
        ]);

        try {
            DB::beginTransaction();
            
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permissions'));

            DB::commit();
            return redirect()->route('roles.index')
                           ->with('success', 'Rol creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error al crear el rol: ' . $e->getMessage());
        }
    }

    public function edit(Role $role)
    {
        if ($role->name === 'Admin') {
            return redirect()->route('roles.index')
                           ->with('error', 'No se puede editar el rol de Administrador');
        }

        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        if ($role->name === 'Admin') {
            return redirect()->route('roles.index')
                           ->with('error', 'No se puede modificar el rol de Administrador');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['exists:permissions,id']
        ], [
            'name.required' => 'El nombre del rol es obligatorio',
            'name.unique' => 'Este nombre de rol ya existe',
            'permissions.required' => 'Debe seleccionar al menos un permiso',
            'permissions.*.exists' => 'Uno o más permisos seleccionados no son válidos'
        ]);

        try {
            DB::beginTransaction();
            
            $role->update(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permissions'));

            DB::commit();
            return redirect()->route('roles.index')
                           ->with('success', 'Rol actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error al actualizar el rol: ' . $e->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'Admin') {
            return redirect()->route('roles.index')
                           ->with('error', 'No se puede eliminar el rol de Administrador');
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')
                           ->with('error', 'No se puede eliminar el rol porque tiene usuarios asignados');
        }

        try {
            DB::beginTransaction();
            
            $role->syncPermissions([]); // Eliminar todos los permisos asociados
            $role->delete();

            DB::commit();
            return redirect()->route('roles.index')
                           ->with('success', 'Rol eliminado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('roles.index')
                           ->with('error', 'Error al eliminar el rol: ' . $e->getMessage());
        }
    }
}

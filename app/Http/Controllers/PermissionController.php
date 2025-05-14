<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin');
    }

    public function index()
    {
        $permissions = Permission::with('roles')->get();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name',
                'regex:/^[a-z-]+$/',
                'min:3'
            ]
        ], [
            'name.required' => 'El nombre del permiso es obligatorio',
            'name.unique' => 'Este permiso ya existe',
            'name.regex' => 'El nombre del permiso solo puede contener letras minúsculas y guiones',
            'name.min' => 'El nombre del permiso debe tener al menos 3 caracteres'
        ]);

        try {
            DB::beginTransaction();
            
            Permission::create(['name' => strtolower($request->input('name'))]);

            DB::commit();
            return redirect()->route('permissions.index')
                           ->with('success', 'Permiso creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error al crear el permiso: ' . $e->getMessage());
        }
    }

    public function edit(Permission $permission)
    {
        // Verificar si el permiso está en uso
        if ($permission->roles()->count() > 0) {
            return redirect()->route('permissions.index')
                           ->with('warning', 'Este permiso está asignado a roles. La modificación puede afectar el sistema.');
        }

        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        // Verificar si el permiso está en uso
        if ($permission->roles()->count() > 0) {
            return redirect()->route('permissions.index')
                           ->with('error', 'No se puede modificar un permiso que está asignado a roles');
        }

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions')->ignore($permission->id),
                'regex:/^[a-z-]+$/',
                'min:3'
            ]
        ], [
            'name.required' => 'El nombre del permiso es obligatorio',
            'name.unique' => 'Este permiso ya existe',
            'name.regex' => 'El nombre del permiso solo puede contener letras minúsculas y guiones',
            'name.min' => 'El nombre del permiso debe tener al menos 3 caracteres'
        ]);

        try {
            DB::beginTransaction();
            
            $permission->update(['name' => strtolower($request->input('name'))]);

            DB::commit();
            return redirect()->route('permissions.index')
                           ->with('success', 'Permiso actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error al actualizar el permiso: ' . $e->getMessage());
        }
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles()->count() > 0) {
            return redirect()->route('permissions.index')
                           ->with('error', 'No se puede eliminar un permiso que está asignado a roles');
        }

        try {
            DB::beginTransaction();
            
            $permission->delete();

            DB::commit();
            return redirect()->route('permissions.index')
                           ->with('success', 'Permiso eliminado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('permissions.index')
                           ->with('error', 'Error al eliminar el permiso: ' . $e->getMessage());
        }
    }
}

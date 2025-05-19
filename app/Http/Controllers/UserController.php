<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Profesor;
use App\Models\Plantel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin');
    }

    public function index(Request $request)
    {
        $query = User::with(['alumno', 'profesor', 'roles']);

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nombre', 'like', "%{$search}%")
                  ->orWhere('apaterno', 'like', "%{$search}%")
                  ->orWhere('amaterno', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Ordenamiento
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(10)->withQueryString();
        $roles = Role::pluck('name', 'name')->all();

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $planteles = Plantel::all();
        return view('users.create', compact('roles', 'planteles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'nombre' => 'required',
            'apaterno' => 'required',
            'amaterno' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:confirm-password',
            'confirm-password' => 'required|min:8',
            'tipo' => 'nullable|in:A,P,E',
            'roles' => 'required|array|min:1',
            // Validaciones condicionales para alumno
            'numero_cuenta' => 'required_if:tipo,A|unique:alumnos,numero_cuenta',
            'fecha_nacimiento_alumno' => 'required_if:tipo,A|nullable|date',
            'sexo_alumno' => 'required_if:tipo,A|nullable|in:M,F',
            'plantel_id_alumno' => 'required_if:tipo,A|nullable|exists:planteles,id',
            // Validaciones condicionales para profesor
            'numero_trabajador' => 'required_if:tipo,P|unique:profesores,numero_trabajador',
            'rfc' => 'required_if:tipo,P|unique:profesores,rfc',
            'fecha_nacimiento_profesor' => 'required_if:tipo,P|nullable|date',
            'sexo_profesor' => 'required_if:tipo,P|nullable|in:M,F',
            'plantel_id_profesor' => 'required_if:tipo,P|nullable|exists:planteles,id',
            'turno' => 'required_if:tipo,P|nullable|in:M,V'
        ], [
            'username.required' => 'El nombre de usuario es obligatorio',
            'username.unique' => 'Este nombre de usuario ya está registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'apaterno.required' => 'El apellido paterno es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico debe ser válido',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.same' => 'Las contraseñas no coinciden',
            'confirm-password.required' => 'La confirmación de contraseña es obligatoria',
            'confirm-password.min' => 'La confirmación de contraseña debe tener al menos 8 caracteres',
            'roles.required' => 'Debe seleccionar al menos un rol',
            'roles.array' => 'Debe seleccionar al menos un rol',
            'roles.min' => 'Debe seleccionar al menos un rol',
            'tipo.in' => 'El tipo de usuario debe ser Alumno, Profesor o Empleado',
            'numero_cuenta.required_if' => 'El número de cuenta es obligatorio para alumnos',
            'numero_cuenta.unique' => 'Este número de cuenta ya está registrado',
            'fecha_nacimiento_alumno.required_if' => 'La fecha de nacimiento es obligatoria para alumnos',
            'fecha_nacimiento_alumno.date' => 'La fecha de nacimiento del alumno debe ser una fecha válida',
            'sexo_alumno.required_if' => 'El sexo es obligatorio para alumnos',
            'sexo_alumno.in' => 'El sexo del alumno seleccionado no es válido',
            'plantel_id_alumno.required_if' => 'El plantel es obligatorio para alumnos',
            'plantel_id_alumno.exists' => 'El plantel seleccionado para el alumno no existe',
            'numero_trabajador.required_if' => 'El número de trabajador es obligatorio para profesores',
            'numero_trabajador.unique' => 'Este número de trabajador ya está registrado',
            'rfc.required_if' => 'El RFC es obligatorio para profesores',
            'rfc.unique' => 'Este RFC ya está registrado',
            'fecha_nacimiento_profesor.required_if' => 'La fecha de nacimiento es obligatoria para profesores',
            'fecha_nacimiento_profesor.date' => 'La fecha de nacimiento del profesor debe ser una fecha válida',
            'sexo_profesor.required_if' => 'El sexo es obligatorio para profesores',
            'sexo_profesor.in' => 'El sexo del profesor seleccionado no es válido',
            'plantel_id_profesor.required_if' => 'El plantel es obligatorio para profesores',
            'plantel_id_profesor.exists' => 'El plantel seleccionado para el profesor no existe',
            'turno.required_if' => 'El turno es obligatorio para profesores',
            'turno.in' => 'El turno seleccionado no es válido'
        ]);

        try {
            DB::beginTransaction();

            // Generar el nombre completo automáticamente
            $nombreCompleto = trim($request->nombre . ' ' . $request->apaterno . ' ' . $request->amaterno);

            $user = User::create([
                'username' => $request->username,
                'name' => $nombreCompleto,
                'nombre' => $request->nombre,
                'apaterno' => $request->apaterno,
                'amaterno' => $request->amaterno,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tipo' => $request->tipo
            ]);

            $user->assignRole($request->input('roles'));

            // Crear registro de alumno si es necesario
            if ($request->tipo === 'A') {
                $user->alumno()->create([
                    'numero_cuenta' => $request->numero_cuenta,
                    'fecha_nacimiento' => $request->fecha_nacimiento_alumno,
                    'sexo' => $request->sexo_alumno,
                    'plantel_id' => $request->plantel_id_alumno
                ]);
            }

            // Crear registro de profesor si es necesario
            if ($request->tipo === 'P') {
                $profesor = $user->profesor()->create([
                    'numero_trabajador' => $request->numero_trabajador,
                    'rfc' => $request->rfc,
                    'fecha_nacimiento' => $request->fecha_nacimiento_profesor,
                    'sexo' => $request->sexo_profesor
                ]);

                // Crear relación con plantel
                $profesor->profesorPlantel()->create([
                    'plantel_id' => $request->plantel_id_profesor,
                    'periodo_id' => 1, // Ajustar según el periodo actual
                    'antiguedad' => 0,
                    'turno' => $request->turno ?? 'M',
                    'fecha_asignacion' => now()
                ]);
            }

            DB::commit();
            return redirect()->route('users.index')
                           ->with('success', 'Usuario creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $user = User::with(['alumno', 'profesor', 'roles'])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with(['alumno', 'profesor'])->findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $planteles = Plantel::all();

        return view('users.edit', compact('user', 'roles', 'userRole', 'planteles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'username' => 'required|unique:users,username,'.$id,
            'nombre' => 'required',
            'apaterno' => 'required',
            'amaterno' => 'nullable',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|same:confirm-password',
            'roles' => 'required',
            // Validaciones condicionales para alumno
            'numero_cuenta' => 'required_if:tipo,A|unique:alumnos,numero_cuenta,'.($user->alumno ? $user->alumno->id : 'NULL').',id',
            'fecha_nacimiento_alumno' => 'required_if:tipo,A|date',
            'sexo_alumno' => 'required_if:tipo,A|in:M,F',
            'plantel_id_alumno' => 'required_if:tipo,A|exists:planteles,id',
            // Validaciones condicionales para profesor
            'numero_trabajador' => 'required_if:tipo,P|unique:profesores,numero_trabajador,'.($user->profesor ? $user->profesor->id : 'NULL').',id',
            'rfc' => 'required_if:tipo,P|unique:profesores,rfc,'.($user->profesor ? $user->profesor->id : 'NULL').',id',
            'fecha_nacimiento_profesor' => 'required_if:tipo,P|date',
            'sexo_profesor' => 'required_if:tipo,P|in:M,F',
        ]);

        try {
            DB::beginTransaction();

            // Generar el nombre completo automáticamente
            $nombreCompleto = trim($request->nombre . ' ' . $request->apaterno . ' ' . $request->amaterno);

            $input = $request->all();
            $input['name'] = $nombreCompleto; // Sobrescribir el campo name con el nombre completo generado

            if(!empty($input['password'])) { 
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));    
            }

            $user->update($input);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));

            // Actualizar o crear registro de alumno
            if ($request->tipo === 'A') {
                if ($user->alumno) {
                    $user->alumno->update([
                        'numero_cuenta' => $request->numero_cuenta,
                        'fecha_nacimiento' => $request->fecha_nacimiento_alumno,
                        'sexo' => $request->sexo_alumno,
                        'plantel_id' => $request->plantel_id_alumno
                    ]);
                } else {
                    $user->alumno()->create([
                        'numero_cuenta' => $request->numero_cuenta,
                        'fecha_nacimiento' => $request->fecha_nacimiento_alumno,
                        'sexo' => $request->sexo_alumno,
                        'plantel_id' => $request->plantel_id_alumno
                    ]);
                }
            }

            // Actualizar o crear registro de profesor
            if ($request->tipo === 'P') {
                if ($user->profesor) {
                    $user->profesor->update([
                        'numero_trabajador' => $request->numero_trabajador,
                        'rfc' => $request->rfc,
                        'fecha_nacimiento' => $request->fecha_nacimiento_profesor,
                        'sexo' => $request->sexo_profesor
                    ]);

                    // Actualizar o crear la relación con el plantel
                    if ($user->profesor->profesorPlantel->first()) {
                        $user->profesor->profesorPlantel->first()->update([
                            'plantel_id' => $request->plantel_id_profesor
                        ]);
                    } else {
                        $user->profesor->profesorPlantel()->create([
                            'plantel_id' => $request->plantel_id_profesor,
                            'periodo_id' => 1, // Ajustar según el periodo actual
                            'antiguedad' => 0,
                            'fecha_asignacion' => now()
                        ]);
                    }
                } else {
                    $profesor = $user->profesor()->create([
                        'numero_trabajador' => $request->numero_trabajador,
                        'rfc' => $request->rfc,
                        'fecha_nacimiento' => $request->fecha_nacimiento_profesor,
                        'sexo' => $request->sexo_profesor
                    ]);

                    $profesor->profesorPlantel()->create([
                        'plantel_id' => $request->plantel_id_profesor,
                        'periodo_id' => 1, // Ajustar según el periodo actual
                        'antiguedad' => 0,
                        'fecha_asignacion' => now()
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('users.index')
                           ->with('success', 'Usuario actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $user = User::findOrFail($id);
            
            // Eliminar registros relacionados
            if ($user->alumno) {
                $user->alumno->delete();
            }
            if ($user->profesor) {
                $user->profesor->delete();
            }
            
            $user->delete();
            
            DB::commit();
            return redirect()->route('users.index')
                           ->with('success', 'Usuario eliminado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')
                           ->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}

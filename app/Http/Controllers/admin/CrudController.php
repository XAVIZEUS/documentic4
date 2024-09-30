<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Region;
use App\Models\Role;
use App\Models\Work;

class CrudController extends Controller
{
    /*public function store(Request $request)
    {
        /*$request->validate([
            'region' => 'required',
            'oficina' => 'required',
            'cargo' => 'required',
            'Rol' => 'required',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:users',
            'carnet' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('foto') ? $request->file('foto')->store('fotos') : null;

        User::create([
            'idRol' => $request->Rol,
            'idRegion' => $request->region,
            'usuario' => $request->correo,
            'password' => Hash::make('defaultpassword'),
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'ci' => $request->carnet,
            'correo' => $request->correo,
            'oficina' => $request->oficina,
            'cargo' => $request->cargo,
            'celular' => $request->celular,
            'url_foto' => $path,
        ]);

        return redirect('/')->with('success', 'Usuario registrado correctamente');
    }*/



    public function listar(){
        //$users = User::all();
        $users = User::with('region')
                ->with('office')
                ->with('work')
                 //->where('idRol', '!=', 1)// Excluir usuarios con idRol igual a 1
                 ->get();
                 
        return view('admin.gestionUsuarios', compact('users'));
    }

    public function cambiarStatus(Request $request )
    {
        $userId = $request->input('userId');

        $usuario = User::find($userId);

        $usuario->estado = $usuario->estado ? 0 : 1; // Alternar entre 0 y 1
        $usuario->save();

        // Redirigir de vuelta a la lista de usuarios con un mensaje de éxito
        return redirect()->back()->with('success', 'El estado del usuario ha sido actualizado.');
    }

    public function registrarUsuario(){
        $region = Region::all();
        $oficinas = Office::all();
        $roles = Role::all();
        $cargos = Work::all();
        return view('admin.registro', compact('region', 'oficinas','roles','cargos'));
        //return redirect('registro', compact('region'));
    }

    public function guardarUsuario(Request $request){
        $user = new User();
        $user->idRegion = $request->region;
        $user->usuario = $request->usuario;
        $user->password = bcrypt(123);
        $user->nombres = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->ci = $request->carnet;
        $user->correo = $request->correo;
        $user->idOficina = $request->oficina;
        $user->mosca = $request->mosca;
        $user->idCargo = $request->cargo;
        $user->estado = 2;
        $user->celular = $request->celular;

        //return $request->foto;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName(); // Obtiene el nombre original del archivo
            $filePath = $file->storeAs('fotos_perfiles', $fileName,'public');
            $user->url_foto = $filePath;
        }

        
        //return $user;
        $user->save();

        $user = User::where('usuario', $request->usuario)
                      ->where('ci', $request->carnet)
                      ->latest()
                      ->first();

        $roles = array_map('intval',explode(',',$request->rol)); //convierte en lista de enteros

        $user->roles()->attach($roles);

        return redirect()->route('admin.gestionUser'); 
    }

    public function edit($id){
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('gestionuser')->with('error', 'Usuario no encontrado.');
        }
        $regionales = Region::all();
        $roles = Role::all();
        $oficinas = Office::all();
        $cargos = Work::all();
        return view('admin.editar', compact('regionales','oficinas','roles', 'user','cargos'));
    }

    public function actualizar(Request $request){
        $id = $request->id; 

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.gestionUser')->with('error', 'Usuario no encontrado.');
        }

        $user->idRegion = $request->region;
        $user->usuario = $request->usuario;
        //$user->password = bcrypt(123);
        $user->nombres = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->ci = $request->carnet;
        $user->correo = $request->correo;
        $user->idOficina = $request->oficina;
        $user->mosca = $request->mosca;
        $user->idCargo = $request->cargo;
        //$user->estado = 2;
        $user->celular = $request->celular;

        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName(); // Obtiene el nombre original del archivo
            $filePath = $file->storeAs('fotos_perfiles', $fileName,'public');
            $user->url_foto = $filePath;
        }

        DB::table('role_user')->where('Usuario_id', $id)->delete();
    
        $roles = array_map('intval',explode(',',$request->rol)); //convierte en lista de enteros

        $user->roles()->attach($roles);
        $user->save();

        return redirect()->route('admin.gestionUser')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function restaurarPassword($idUsuario)
    {
        $usuario = User::find($idUsuario);
        $usuario->estado = 2;
        $usuario->password = bcrypt(123);
        $usuario->save();
        return redirect()->back()->with('restaurado', 'ok');
    }
}

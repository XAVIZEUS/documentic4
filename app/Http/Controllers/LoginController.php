<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;


class LoginController extends Controller
{

    public function perfil(){
        if (Auth::check()){
            $usuario = Auth::user();
            $usuario->load('region','office','work');
            return view('usuario.perfil',compact('usuario'));
        } else {
            return view('404');
        }
        
    }

    public function index()
    {
        return view('usuario.index');
    }

    public function admin()
    {
        return view('admin.home');
    }

    /*public function login(Request $request)
    {
        $credenciales = [
            "usuario" => $request->usuario,
            "password" => $request->pass
        ];

        $remember = ($request->has('remember') ? true : false);
        if (Auth::attempt($credenciales,$remember)){
            $request->session()->regenerate();

            return redirect()->intended('index');
        }else{
            return redirect('/');
        }
        //return view('auth.login');
    }*/

    public function login(Request $request)
    {
        $credenciales = [
            'usuario' => $request->usuario,
            'password' => $request->pasword
        ];
        
        $remember = ($request->has('remember') ? true : false);
        if (Auth::attempt($credenciales, $remember)){
            // Si el usuario está autenticado correctamente, ahora podemos verificar el tipo de usuario
            $user = Auth::user();
            $estado = $user->estado;

            if ($estado>0){
                $request->session()->regenerate();

                $role = $user->roles->first();

                //return $role->idRol;

                if ($role && $role->idRol == 1){
                    return redirect()->route('admin')->with('user', $user->usuario);
                }else if ($role && $role->idRol == (2 || 3)) {
                    return redirect()->route('index')->with('user', $user->usuario);
                } else {
                    //return redirect()->intended('usuario.index')->with('user', $user->usuario);
                    return 'rol de usuario todavia no registrado';
                }

            }else{
                return back()->withErrors(['estado' => 'El usuario se encuentra inactivo']);
            }
        } else {
            return back()->withErrors(['usuario' => 'Las credenciales son incorrectas']);
        }
    }



    public function salir(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $consulta = Company::latest()->first();
        return view('login',['post' => $consulta->nombre]);
        //return redirect('login')->with('post', $consulta);;
    }
}

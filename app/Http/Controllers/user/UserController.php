<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function cambiarPassword(Request $request){
        if (Auth::check()){
            $usuario = User::find(Auth::user()->idUsuario);

            $usuario->password = bcrypt($request->contrasena);
            $usuario->estado = 1;

            $usuario->save();


            return redirect()->route('index');
        }else{
            return 'Algo salio mal';
        }

    }
}

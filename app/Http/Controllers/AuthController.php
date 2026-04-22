<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function logar(Request $request)
    {
        $email = $request->input('email');
        $senha = $request->input('senha');

        $usuario = DB::table('usuarios')->where('email', $email)->first();

        if ($usuario && Hash::check($senha, $usuario->senha_hash)) {
            
            session([
                'usuario_id' => $usuario->id,
                'usuario_nome' => $usuario->nome,
                'tipo_perfil' => $usuario->tipo_perfil
            ]);

            if ($usuario->tipo_perfil == 'admin') {
                return redirect('admin'); 
            } elseif ($usuario->tipo_perfil == 'professor') {
                return redirect('professor');
            } else {
                return redirect('aluno');
            }
        }

        return back()->withErrors(['erro' => 'E-mail ou senha incorretos.']);
    }
}
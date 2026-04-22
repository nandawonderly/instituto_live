<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = User::where('tipo_perfil', 'aluno')->with('curso')->get();
        $cursos = Curso::all();
        return view('gerenciar_aluno', compact('alunos', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'curso_id' => 'required|exists:cursos,id'
        ]);

        User::create([
            'name' => Str::title(mb_strtolower($request->name)),
            'email' => mb_strtolower($request->email),
            'password' => Hash::make('senha123'),
            'tipo_perfil' => 'aluno',
            'curso_id' => $request->curso_id,
        ]);

        return redirect()->back()->with('sucesso', 'Aluno matriculado com sucesso! Senha de acesso: senha123');
    }

    public function destroy($id)
    {
        $aluno = User::where('id', $id)->where('tipo_perfil', 'aluno')->firstOrFail();
        $aluno->delete();
        return redirect()->back()->with('sucesso', 'Matrícula removida.');
    }
}
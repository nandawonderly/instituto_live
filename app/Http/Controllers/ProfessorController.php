<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfessorController extends Controller
{
    // 1. MOSTRA A PÁGINA PRINCIPAL
    public function index()
    {
        // Busca apenas os usuários que são professores
        $professores = User::where('tipo_perfil', 'professor')->with('disciplinas')->get();

        // Busca todas as disciplinas para podermos vinculá-las
        $disciplinas = Disciplina::all();

        return view('gerenciar_professores', compact('professores', 'disciplinas'));
    }

    // 2. CADASTRA UM NOVO PROFESSOR
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            // Converte para minúsculo primeiro, depois capitaliza a primeira letra de cada palavra
            'name' => Str::title(mb_strtolower($request->name)), 
            
            // Aproveitamos e garantimos que o email não tenha nenhuma letra maiúscula perdida
            'email' => mb_strtolower($request->email), 
            
            'password' => Hash::make('senha123'), 
            'tipo_perfil' => 'professor',
        ]);

        return redirect()->back()->with('sucesso', 'Professor cadastrado com sucesso! A senha padrão é: senha123');
    }

    // 3. VINCULA O PROFESSOR À DISCIPLINA
    public function vincularDisciplina(Request $request)
    {
        $request->validate([
            'professor_id' => 'required|exists:users,id',
            'disciplina_id' => 'required|exists:disciplinas,id',
        ]);

        $disciplina = Disciplina::findOrFail($request->disciplina_id);
        $disciplina->professor_id = $request->professor_id;
        $disciplina->save();

        return redirect()->back()->with('sucesso', "Disciplina '{$disciplina->nome}' vinculada ao professor!");
    }

    // 4. DELETA UM PROFESSOR
    public function destroy($id)
    {
        $professor = User::findOrFail($id);
        
        // Medida de segurança: garante que não estamos deletando um administrador sem querer
        if ($professor->tipo_perfil !== 'professor') {
            return redirect()->back()->with('erro', 'Você só pode excluir perfis de professores por aqui.');
        }

        $nome = $professor->name; // Guarda o nome para mostrar na mensagem
        $professor->delete();

        return redirect()->back()->with('sucesso', "O professor {$nome} foi removido e perdeu o acesso ao sistema. Suas disciplinas agora estão livres.");
    }
}
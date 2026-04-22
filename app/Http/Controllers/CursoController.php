<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso; // Puxa o Model do Curso que criamos!

class CursoController extends Controller
{
    public function salvarCurso(Request $request)
    {
        // 1. O Laravel cria um curso novo no banco de dados com os dados do formulário
        Curso::create([
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao'),
        ]);

        // 2. Volta para a página do painel admin
        return redirect('/admin/cursos');
    }

    public function excluir($id)
    {
        $curso = Curso::find($id);
        $curso->delete(); // Apaga o curso (e o banco apaga todo o resto em cascata!)
        
        return redirect('/admin/cursos');
    }

}
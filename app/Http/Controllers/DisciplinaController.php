<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{
    public function salvar(Request $request, $curso_id)
    {
        // Cria a disciplina vinculada ao ID do curso que veio pela URL
        Disciplina::create([
            'curso_id' => $curso_id,
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao'),
        ]);

        // Salva e joga de volta pra página de detalhes do curso!
        return redirect("/admin/cursos/{$curso_id}");
    }

    public function excluir($id)
    {
        $disciplina = Disciplina::find($id);
        $curso_id = $disciplina->curso_id; // Guarda o ID do curso pra saber pra onde voltar
        
        $disciplina->delete(); // Apaga a disciplina e suas aulas
        
        return redirect("/admin/cursos/{$curso_id}");
    }
}
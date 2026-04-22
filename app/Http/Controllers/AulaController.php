<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Material; // Certifique-se de importar o model Material
use App\Models\Questao;
use App\Models\Alternativa;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function salvar(Request $request, $disciplina_id)
    {
        $linksVideos = $request->url_video ? array_filter($request->url_video) : null;

        $aula = Aula::create([
            'disciplina_id' => $disciplina_id,
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao'),
            'url_video' => empty($linksVideos) ? null : array_values($linksVideos),
        ]);

        if ($request->hasFile('arquivos')) {
            foreach ($request->file('arquivos') as $arquivo) {
                $nomeArquivo = time() . '_' . $arquivo->getClientOriginalName();
                $arquivo->move(public_path('uploads/materiais'), $nomeArquivo);

                Material::create([
                    'aula_id' => $aula->id,
                    'nome_arquivo' => $arquivo->getClientOriginalName(),
                    'caminho' => 'uploads/materiais/' . $nomeArquivo
                ]);
            }
        }

        return redirect("/admin/aulas/{$aula->id}/quiz");
    }

    public function editar($id)
    {
        // Adicionamos o 'with' para que a página de edição já conheça os arquivos vinculados
        $aula = Aula::with('materiais')->findOrFail($id);
        return view('editar_aula', compact('aula'));
    }

    public function atualizar(Request $request, $id)
    {
        $aula = Aula::findOrFail($id);
        
        // 1. Tratamento dos Vídeos do YouTube (Múltiplos)
        $linksVideos = $request->url_video ? array_filter($request->url_video) : null;
        
        $aula->update([
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao'),
            'url_video' => empty($linksVideos) ? null : array_values($linksVideos),
        ]);

        // 2. EXCLUSÃO de arquivos antigos (os que foram marcados no checkbox)
        if ($request->has('deletar_arquivos')) {
            foreach ($request->deletar_arquivos as $materialCaminho) {
                // Busca o registro do material pelo caminho salvo
                $material = Material::where('caminho', $materialCaminho)->first();
                
                if ($material) {
                    // Remove o arquivo físico da pasta public/uploads/materiais
                    $caminhoFisico = public_path($material->caminho);
                    if (file_exists($caminhoFisico)) {
                        unlink($caminhoFisico);
                    }
                    // Remove do banco de dados
                    $material->delete();
                }
            }
        }

        // 3. ADIÇÃO de novos arquivos (se houver novos envios)
        if ($request->hasFile('novos_arquivos')) {
            foreach ($request->file('novos_arquivos') as $arquivo) {
                $nomeArquivo = time() . '_' . $arquivo->getClientOriginalName();
                $arquivo->move(public_path('uploads/materiais'), $nomeArquivo);

                Material::create([
                    'aula_id' => $aula->id,
                    'nome_arquivo' => $arquivo->getClientOriginalName(),
                    'caminho' => 'uploads/materiais/' . $nomeArquivo
                ]);
            }
        }

        return redirect("/admin/disciplinas/{$aula->disciplina_id}")->with('sucesso', 'Aula atualizada com sucesso!');
    }

    public function excluir($id)
    {
        $aula = Aula::findOrFail($id);
        $disciplina_id = $aula->disciplina_id;

        // Antes de deletar a aula, precisamos apagar os arquivos físicos da pasta public
        // pois o onDelete('cascade') do banco apaga apenas as LINHAS, não os arquivos.
        foreach ($aula->materiais as $material) {
            $caminho = public_path($material->caminho);
            if (file_exists($caminho)) {
                unlink($caminho);
            }
        }

        $aula->delete();
        return redirect("/admin/disciplinas/{$disciplina_id}");
    }

    public function ver($id)
    {
        $aula = Aula::with(['materiais', 'questoes.alternativas'])->findOrFail($id);
        return view('detalhes_aula', compact('aula'));
    }

    public function novoQuiz($id) {
        $aula = Aula::findOrFail($id);
        return view('adicionar_quiz', compact('aula'));
    }

    public function salvarQuestao(Request $request, $id) {
        $aula = Aula::findOrFail($id);

        $questao = Questao::create([
            'aula_id' => $aula->id,
            'enunciado' => $request->enunciado
        ]);

        foreach ($request->alternativas as $indice => $texto) {
            Alternativa::create([
                'questao_id' => $questao->id,
                'texto' => $texto,
                'is_correta' => ($indice == $request->correta)
            ]);
        }

        if ($request->input('acao') === 'proxima') {
            return redirect()->back()->with('sucesso', 'Questão salva! Pode criar a próxima.');
        }

        return redirect("/admin/disciplinas/" . $aula->disciplina_id)->with('sucesso', 'Quiz finalizado!');
    }
}
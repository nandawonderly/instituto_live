@extends('layout_admin')

@section('conteudo')

<main class="content-area"> 
    <div class="header-acoes">
        <div>
            <h2>👨‍🏫 Gerenciar Professores</h2>
            <p>Cadastre novos professores e atribua disciplinas a eles.</p>
        </div>
    </div>

    @if(session('sucesso'))
        <div style="background: #d4edda; color: #155724; padding: 15px; margin: 20px 0; border-radius: 5px; border-left: 5px solid #28a745;">
            {{ session('sucesso') }}
        </div>
    @endif

    <div style="display: flex; gap: 20px; margin-top: 20px; flex-wrap: wrap;">
        
        <div class="form-container" style="flex: 1; min-width: 300px;">
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">Novo Professor</h3>
            
            <form action="/admin/professores" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nome Completo: *</label>
                    <input type="text" id="name" name="name" required placeholder="Ex: Dr. Carlos Silva">
                </div>

                <div class="form-group">
                    <label for="email">E-mail de Acesso: *</label>
                    <input type="email" id="email" name="email" required placeholder="carlos@instituto.com">
                    <small style="color: #666; display: block; margin-top: 5px;">A senha padrão será <strong>senha123</strong></small>
                </div>

                <button type="submit" class="btn-submit" style="width: 100%;">Cadastrar Professor</button>
            </form>
        </div>

        <div class="form-container" style="flex: 1; min-width: 300px; background-color: #f8f9fa;">
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">Atribuir Disciplina</h3>
            
            @if($disciplinas->count() == 0)
                <div style="padding: 20px; border: 2px dashed #ffc107; text-align: center; border-radius: 8px;">
                    <p style="color: #856404; margin: 0;">⚠️ Nenhuma disciplina criada.</p>
                    <small>Crie uma disciplina no menu de Cursos primeiro.</small>
                </div>
            @elseif($professores->count() == 0)
                <div style="padding: 20px; border: 2px dashed #17a2b8; text-align: center; border-radius: 8px;">
                    <p style="color: #0c5460; margin: 0;">Cadastre o primeiro professor ao lado para vincular.</p>
                </div>
            @else
                <form action="/admin/professores/vincular" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="professor_id">Selecione o Professor: *</label>
                        <select id="professor_id" name="professor_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                            <option value="">-- Escolha um professor --</option>
                            @foreach($professores as $prof)
                                <option value="{{ $prof->id }}">{{ $prof->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="disciplina_id">Selecione a Disciplina: *</label>
                        <select id="disciplina_id" name="disciplina_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                            <option value="">-- Escolha uma disciplina --</option>
                            @foreach($disciplinas as $disc)
                                <option value="{{ $disc->id }}">
                                    {{ $disc->nome }} {{ $disc->professor_id ? '(Já possui prof.)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn-submit" style="width: 100%; background-color: #17a2b8;">Confirmar Vínculo</button>
                </form>
            @endif
        </div>
    </div>
    <div class="form-container" style="margin-top: 30px; padding: 25px;">
        <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">
            📋 Professores e suas Disciplinas
        </h3>

        @if($professores->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #f4f6f8;">
                            <th style="padding: 15px; border-bottom: 2px solid #ddd; color: #444;">Professor</th>
                            <th style="padding: 15px; border-bottom: 2px solid #ddd; color: #444;">E-mail de Acesso</th>
                            <th style="padding: 15px; border-bottom: 2px solid #ddd; color: #444;">Disciplinas Ministradas</th>
                            <th style="padding: 15px; border-bottom: 2px solid #ddd; color: #444; text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($professores as $prof)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 15px;">
                                    <strong>{{ $prof->name }}</strong>
                                </td>
                                
                                <td style="padding: 15px; color: #666;">
                                    {{ $prof->email }}
                                </td>
                                
                                <td style="padding: 15px;">
                                    @if($prof->disciplinas->count() > 0)
                                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                            @foreach($prof->disciplinas as $disc)
                                                <span style="background-color: #e2e3e5; color: #383d41; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                                    📚 {{ $disc->nome }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span style="color: #dc3545; font-size: 13px; font-weight: 600;">
                                            ⚠️ Aguardando vínculo
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <form action="/admin/professores/{{ $prof->id }}" method="POST" 
                                        onsubmit="return confirm('🚨 Tem certeza que deseja remover este professor? Ele perderá o acesso imediatamente.');">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: bold; transition: 0.2s;">
                                            Remover
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 30px; color: #666;">
                Nenhum professor cadastrado ainda.
            </div>
        @endif
    </div>
</main>
@endsection
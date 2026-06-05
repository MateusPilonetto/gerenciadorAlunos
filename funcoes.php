<?php

function cadastrarAluno(&$alunos) {
    echo "\n--- Novo Cadastro ---\n";
    
    $nome = "";
    $idade = 0;
    $nota = 0.0;
    $valido = false;

    while (empty($nome)) {

        $nome = trim(readline("Digite o nome do aluno: "));

        if (empty($nome)) {
         echo "O nome não pode ficar vazio.\n";   
        }
    } 
    
    while (!$valido) {

        $idadeStr = readline("Digite a idade do aluno: ");

        if (!is_numeric($idadeStr) || (int)$idadeStr < 0) {

            echo "Idade inválida. Por favor, digite um número inteiro positivo.\n";
            $valido = false;
        } else {

            $idade = (int)$idadeStr;
            $valido = true;
        }
    }
    
    $valido = false;

    while (!$valido) {
        $notaStr = str_replace(',', '.', readline("Digite sua nota: "));

        if (!is_numeric($notaStr) || (float)$notaStr < 0 || (float)$notaStr > 10) {

            echo "Nota inválida. Por favor, digite um número entre 0 e 10.\n";
            $valido = false;
        } else {

            $nota = (float)$notaStr;
            $valido = true;
        }
    }

    $aprovado = ($nota >= 7.0);

    $idUnico = uniqid();
    $alunos[] = [
        "id" => $idUnico,
        "nome" => $nome,
        "idade" => $idade,
        "nota" => $nota,
        "status" => $aprovado
    ];

    echo "✅ Aluno cadastrado com sucesso!\n";
    echo "Use este ID: " . $idUnico . " para editar ou remover o aluno\n";
}

function listarAlunos($alunos) {
    echo "\n--- Lista de Alunos ---\n";
    if (empty($alunos)) {
        echo "Nenhum aluno cadastrado.\n";
        return;
    }

    usort($alunos, function($a, $b) {
        return strcasecmp($a['nome'], $b['nome']);
    });

    foreach ($alunos as $aluno) {
        exibirAluno($aluno);
    }
}

function exibirAluno($aluno) {
    $situacao = $aluno['status'] ? "Aprovado" : "Reprovado";
    echo "ID: {$aluno['id']} | Nome: {$aluno['nome']} | Idade: {$aluno['idade']} | Nota: {$aluno['nota']} | Situação: {$situacao}\n";
}


function buscarAluno($alunos) {
    $termo = trim(readline("\nDigite o nome para buscar: "));
    $encontrados = 0;

    echo "\n--- Resultados da Busca ---\n";
    foreach ($alunos as $aluno) {
        if (stripos($aluno['nome'], $termo) !== false) {
            exibirAluno($aluno);
            $encontrados++;
        }
    }

    if ($encontrados === 0) echo "Nenhum aluno encontrado.\n";
}

function editarAluno(&$alunos) {
    $idBusca = trim(readline("\nDigite o ID do aluno que deseja editar: "));
    
    foreach ($alunos as $index => $aluno) {
        if ($aluno['id'] === $idBusca) {
            echo "Deixe em branco para manter os valores atuais.\n";
            
            $novoNome = trim(readline("Novo nome [{$aluno['nome']}]: "));
            if ($novoNome !== "") $alunos[$index]['nome'] = $novoNome;

            $novaIdadeStr = trim(readline("Nova idade [{$aluno['idade']}]: "));
            if ($novaIdadeStr !== "" && is_numeric($novaIdadeStr) && (int)$novaIdadeStr >= 0) {
                $alunos[$index]['idade'] = (int)$novaIdadeStr;
            }

            $novaNotaStr = str_replace(',', '.', trim(readline("Nova nota [{$aluno['nota']}]: ")));
            if ($novaNotaStr !== "" && is_numeric($novaNotaStr) && (float)$novaNotaStr >= 0 && (float)$novaNotaStr <= 10) {
                $alunos[$index]['nota'] = (float)$novaNotaStr;
            }

            // Recalcula a situação sempre que o aluno for editado
            $alunos[$index]['status'] = ($alunos[$index]['nota'] >= 7.0);

            echo "✅ Aluno editado com sucesso!\n";
            return;
        }
    }
    echo "❌ ID não encontrado.\n";
}

function removerAluno(&$alunos) {
    $idBusca = trim(readline("\nDigite o ID do aluno para remover: "));
    
    foreach ($alunos as $index => $aluno) {
        if ($aluno['id'] === $idBusca) {
            exibirAluno($aluno);
            $confirma = strtoupper(readline("Tem certeza que deseja excluir? (S/N): "));
            if ($confirma === 'S') {
                unset($alunos[$index]);
                echo "✅ Aluno removido.\n";
            } else {
                echo "Operação cancelada.\n";
            }
            return;
        }
    }
    echo "❌ ID não encontrado.\n";
}

function mostrarEstatisticas($alunos) {
    echo "\n--- Estatísticas ---\n";
    $total = count($alunos);
    if ($total === 0) {
        echo "Sem dados para estatísticas.\n";
        return;
    }

    $somaNotas = 0;
    $aprovados = 0;

    foreach ($alunos as $aluno) {
        $somaNotas += $aluno['nota'];
        if ($aluno['status']) $aprovados++;
    }

    echo "Total de Alunos: {$total}\n";
    echo "Média Geral das Notas: " . number_format($somaNotas / $total, 2) . "\n";
    echo "Alunos Aprovados: {$aprovados}\n";
}

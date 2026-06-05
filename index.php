<?php
require_once 'funcoes.php';

echo "=========================================================\n";
echo "       BEM-VINDO AO SISTEMA DE CADASTRO DE ALUNOS!       \n";
echo "=========================================================\n";
sleep(1);

$alunos = []; 

while (true) {
    echo "\n================ MENU =================\n";
    echo "[1] Cadastrar Aluno\n";
    echo "[2] Listar Alunos\n";
    echo "[3] Buscar Aluno\n";
    echo "[4] Editar Aluno\n";
    echo "[5] Remover Aluno\n";
    echo "[6] Estatísticas\n";
    echo "[0] Sair\n";
    echo "=======================================\n";
    
    $opcao = trim(readline("Escolha uma opção: "));

    switch ($opcao) {
        case '1': cadastrarAluno($alunos); break;
        case '2': listarAlunos($alunos); break;
        case '3': buscarAluno($alunos); break;
        case '4': editarAluno($alunos); break;
        case '5': removerAluno($alunos); break;
        case '6': mostrarEstatisticas($alunos); break;
        case '0': 
            echo "\nSaindo do sistema... Até mais!\n"; 
            exit(0);
        default: 
            echo "\n❌ Opção inválida!\n"; 
            break;
    }
}
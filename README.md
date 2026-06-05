# 🎓 Sistema de Gestão de Alunos (PHP CLI)

Um sistema simples de gerenciamento de alunos executado diretamente no terminal (Command Line Interface). 
Este projeto foi desenvolvido como parte de uma tarefa/curso de PHP, com o objetivo de praticar lógica de programação, manipulação de arrays e modularização de código.

## ✨ Funcionalidades

O sistema possui um menu interativo com as seguintes operações (CRUD):

- **Cadastrar Aluno:** Adiciona um novo aluno calculando automaticamente sua situação (Aprovado/Reprovado) com base na nota.
- **Listar Alunos:** Exibe todos os alunos cadastrados em ordem alfabética.
- **Buscar Aluno:** Pesquisa alunos pelo nome de forma case-insensitive.
- **Editar Aluno:** Permite alterar nome, idade e nota usando o ID do aluno, recalculando a situação automaticamente.
- **Remover Aluno:** Exclui um cadastro do sistema mediante confirmação.
- **Estatísticas:** Exibe o total de alunos, média geral das notas e quantidade de aprovados.

## 🚀 Tecnologias Utilizadas

- **PHP 8+**
- Paradigma estrutural com separação de responsabilidades (arquivos `index.php` e `funcoes.php`).

## 🛠️ Como executar o projeto

### Pré-requisitos
Você precisa ter o [PHP](https://www.php.net/downloads) instalado na sua máquina.

### Passos
1. Clone este repositório
2. Abra o terminal na pasta do projeto e execute "php index.php"

<?php

session_start();

include_once("conexao.php");

$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$quantidadedevagas = filter_input(INPUT_POST, 'quantidadedevagas', FILTER_SANITIZE_NUMBER_INT);
$nomedoprofessor = filter_input(INPUT_POST, 'nomedoprofessor', FILTER_SANITIZE_STRING);

$erros = [];

if (
    strlen($nomedoprofessor) > 200
) {
    array_push($erros, 'A descrição da turma atingiu o limite de caracteres(200).');
}

if (
    strlen($descricao) < 1
) {
    array_push($erros, 'Campo de descrição obrigatório.');
}


if (
    !is_numeric($quantidadedevagas)
) {
    array_push($erros, 'Quantidade de vagas não é um número válido');
} elseif (
    $quantidadedevagas > 100
) {
    array_push($erros, 'Limite de caracteres em quantidade de vagas atingido');
}


if (
    strlen($nomedoprofessor) < 1
) {
    array_push($erros, 'Nome do professor é obrigatório');
}

if (
    strlen($nomedoprofessor) > 100
) {
    array_push($erros, 'Nome do professor atingiu o limite de caracteres(100).');
}

if (
    count($erros) > 0
) {
    $_SESSION['msg'] = "";

    foreach ($erros as $bug) {
        $_SESSION['msg'] .= "<p style='color:red;'>" . $bug . "</p>";
    }
    header("location: cadastrarturma.php");
    exit;
}


$result_usuario = "INSERT INTO turmas (descricao, quantidadedevagas, nomedoprofessor, created, modified) VALUES ('$descricao','$quantidadedevagas','$nomedoprofessor', NOW(), NOW())";

$resultado_usuario = $conn->prepare($result_usuario);
echo ("<script>console.log('PHP: " . $result_usuario . "');</script>");
if ($resultado_usuario->execute()) {
    $_SESSION['msg'] = "<p style='color:green;'>Parabéns, o cadastro foi efetuado com sucesso!</p>";
    header("location: cadastrarturma.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>O cadastro falhou, preencha os campos corretamente.</p>";
    header("location: cadastrarturma.php");
}

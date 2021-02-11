<?php

session_start();

include_once("conexao.php");

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_EMAIL);
$datadenascimento = filter_input(INPUT_POST, 'datadenascimento', FILTER_SANITIZE_NUMBER_INT);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
$rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
$complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);

$erros = [];

if (
    strlen($nome) < 1
) {
    array_push($erros, 'O nome é obrigatório.');
}

if (
    strlen($sexo) < 1
) {
    array_push($erros, 'O sexo é obrigatório.');
}

if (
    strlen($datadenascimento) < 1
) {
    array_push($erros, 'A data de nascimento é obrigatória.');
}

if (
    count($erros) > 0
) {
    $_SESSION['msg'] = "";

    foreach ($erros as $bug) {
        $_SESSION['msg'] .= "<p style='color:red;'>" . $bug . "</p>";
    }
    header("location: cadastroaluno.php");
    exit;
}

$result_usuario = "INSERT INTO alunos (matricula, nome, sexo, datadenascimento, cidade, bairro, rua, numero, complemento, created, modified) VALUES (null,'$nome','$sexo','$datadenascimento','$cidade','$bairro','$rua','$numero','$complemento', NOW(), NOW())";
$resultado_usuario = $conn->prepare($result_usuario);
echo ("<script>console.log('PHP: " . $result_usuario . "');</script>");
if ($resultado_usuario->execute()) {
    $_SESSION['msg'] = "<p style='color:green;'>Parabéns, o cadastro foi efetuado com sucesso!</p>";
    header("location: cadastroaluno.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>O cadastro falhou, preencha os campos corretamente.</p>";
    header("location: cadastroaluno.php");
}

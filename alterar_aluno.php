<?php

session_start();

include_once("conexao.php");

if(isset($_POST['nome']) && !empty($_POST['nome'])){
    $id = addslashes($_GET['id']);
    $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    $datadenascimento = filter_input(INPUT_POST, 'datadenascimento', FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
    $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
    $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
    $turma = filter_input(INPUT_POST, 'turma', FILTER_SANITIZE_STRING);

    $result_msg_cont = "UPDATE alunos SET nome=:nome, sexo=:sexo, datadenascimento=:datadenascimento, cidade=:cidade, bairro=:bairro, rua=:rua, numero=:numero, complemento=:complemento, turmas = :turma WHERE matricula = :id";

    $update_msg_cont = $conn->prepare($result_msg_cont);
    $update_msg_cont->bindParam(':nome', $nome);
    $update_msg_cont->bindParam(':sexo', $sexo);
    $update_msg_cont->bindParam(':datadenascimento', $datadenascimento);
    $update_msg_cont->bindParam(':cidade', $cidade);
    $update_msg_cont->bindParam(':bairro', $bairro);
    $update_msg_cont->bindParam(':rua', $rua);
    $update_msg_cont->bindParam(':numero', $numero);
    $update_msg_cont->bindParam(':complemento', $complemento);
    $update_msg_cont->bindParam(':turma', $turma);
    $update_msg_cont->bindParam(':id', $id);

    if ($update_msg_cont->execute()) {
        $_SESSION['msg'] = "<p style='color:green;'>Cadastro editado com sucesso!</p>";
        header("Location: painel.php");
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Falha ao editar cadastro.</p>";
        header("Location: painel.php");
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro</p>";
    header("Location: painel.php");
}

<?php
require 'conexao.php';
?>

<?php

$result = array();

if (isset($_GET['sexo'])) {
    $sexo = addslashes($_GET['sexo']);
    $sql = $conn->prepare("SELECT * FROM alunos WHERE sexo = :sexo");
    $sql->bindParam(":sexo", $sexo);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $result = $sql->fetchAll();
    } else {
        echo "Nenhum resultado.";
        exit();
    }

    foreach ($result as $dado) {
        echo '<a href="editar_aluno.php?id=' . $dado['matricula'] . '">' . $dado['nome'] . '</a><br>';
    }
}
?>
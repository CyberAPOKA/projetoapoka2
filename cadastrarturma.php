<?php

session_start();

?>

<h1>Cadastro de turma</h1>

<?php
if (isset($_SESSION['msg'])) {
    echo ($_SESSION['msg']);
    unset($_SESSION['msg']);
} ?>

<form method="POST" action="processa2.php">

    <br>Todos os campos são obrigatórios.<br><br>

    Descrição <br /> <input type="text" name="descricao" placeholder="Descrição da turma"><br><br>

    Quantidade de vagas <br /> <input type="text" name="quantidadedevagas" placeholder="Quantidade de vagas"><br><br>

    Nome do professor <br /> <input type="text" name="nomedoprofessor" placeholder="Nome do professor"><br><br>

    <input type="submit" value="Cadastrar">

</form>
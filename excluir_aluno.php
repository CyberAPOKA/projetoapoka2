<?php
require('conexao.php');

$id = addslashes($_GET['id']);

$alunos = array();

$sql = $conn->prepare("DELETE FROM alunos WHERE matricula = :id");
$sql->bindParam(":id", $id);
$sql->execute();

header("Location: painel.php");

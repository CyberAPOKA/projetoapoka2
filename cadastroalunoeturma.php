<?php

session_start();

require_once 'conexao.php';

$pegaAlunos = $conn->prepare("SELECT * FROM alunos;");
$pegaAlunos->execute();
$fetchAll = $pegaAlunos->fetchAll(PDO::FETCH_ASSOC);

$pegaTurmas = $conn->prepare("SELECT * FROM turmas;");
$pegaTurmas->execute();
$Turmas = $pegaTurmas->fetchAll(PDO::FETCH_ASSOC);

function PesquisarTurma($id)
{

    global $Turmas;

    foreach ($Turmas as $object) {
        if (
            $object["numerodaturma"] == $id
        ) {
            return $object;
        }
    }
    return [];
}




?>

<h1>Cadastro de aluno e turma</h1>

<?php
if (isset($_SESSION['msg'])) {
    echo ($_SESSION['msg']);
    unset($_SESSION['msg']);
} ?>

<form method="POST" action="processa3.php">
    <?php

    foreach ($fetchAll as $aluno) {
        echo "Matrícula: " . $aluno["matricula"], "<br>";
        echo "Nome: " . $aluno["nome"], "<br>";
        echo "Sexo: " . $aluno["sexo"], "<br>";
        echo "Data de Nascimento: " . $aluno["datadenascimento"], "<br>";
        echo "Cidade: " . $aluno["cidade"], "<br>";
        echo "Bairro: " . $aluno["bairro"], "<br>";
        echo "Rua: " . $aluno["rua"], "<br>";
        echo "Número: " . $aluno["numero"], "<br>";
        echo "Complemento: " . $aluno["complemento"], "<br>";

        if (

            $result = PesquisarTurma($aluno["turmas"])

        ) {
            echo "numerodaturma: " . $result["numerodaturma"], "<br>";
            echo "descricao: " . $result["descricao"], "<br>";
            echo "quantidadedevagas: " . $result["quantidadedevagas"], "<br>";
            echo "nomedoprofessor: " . $result["nomedoprofessor"], "<br>";
        } else {
            echo "O aluno não está cadastrado em uma turma.";
        }
        echo "<hr>";
    }
    ?>


    <input type="submit" value="Cadastrar">







</form>
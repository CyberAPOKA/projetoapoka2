<?php
require('conexao.php');

$aluno = array();
$turmas = array();

$id = addslashes($_GET['id']);

$sql = $conn->prepare("SELECT * FROM alunos WHERE matricula = :id");
$sql->bindParam(":id", $id);
$sql->execute();

if ($sql->rowCount() > 0) {
    $aluno = $sql->fetchAll(PDO::FETCH_ASSOC);
}

$sql1 = $conn->prepare("SELECT * FROM turmas");
$sql1->execute();

if ($sql1->rowCount() > 0) {
    $turmas = $sql1->fetchAll(PDO::FETCH_ASSOC);
}
?>

<form method="POST" action="alterar_aluno.php?id=<?php echo $id; ?>">
    <?php foreach ($aluno as $dado) : ?>
        Matrícula: <input type="text" name="matricula" value="<?php echo $dado['matricula']; ?>" disabled><br>
        Nome: <input type="text" name="nome" value="<?php echo $dado['nome']; ?>"><br>
        Sexo: <select name="sexo">
            <option><?php echo $dado['sexo']; ?></option>
            <option>homem</option>
            <option>mulher</option>
            <option>não binário</option>
        </select><br>
        Data de Nascimento: <input name="datadenascimento" type="date" value="<?php echo $dado['datadenascimento']; ?>"><br>
        Cidade: <input type="text" name="cidade" value="<?php echo $dado['cidade']; ?>"><br>
        Bairro: <input type="text" name="bairro" value="<?php echo $dado['bairro']; ?>"><br>
        Rua: <input type="text" name="rua" value="<?php echo $dado['rua']; ?>"><br>
        Número: <input type="text" name="numero" value="<?php echo $dado['numero']; ?>"><br>
        Complemento: <input type="text" name="complemento" value="<?php echo $dado['complemento']; ?>"><br><br><br>
        TURMAS<br>
        <select name="turma">
            <option value="null">Selecione</option>
            <?php foreach ($turmas as $turma) : ?>
                <option value="<?php echo $turma['numerodaturma']; ?>"><?php echo $turma['descricao']; ?></option>
            <?php endforeach; ?>
        </select>

    <?php endforeach; ?>
    <input type="submit" value="Alterar">
</form>
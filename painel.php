<form method="GET">
    <select name="sexo">
        <option value="null">Todos</option>
        <option value="homem">Masculino</option>
        <option value="mulher">Feminino</option>
        <option value="naobinario">Não Binário</option>
    </select>

    <input type="submit" value="Pesquisar">
</form>

<?php
$sexo = isset($_GET['sexo'])? addslashes($_GET['sexo']): "null";
require('conexao.php');

session_start();

$alunos = array();

$sql = "SELECT * FROM alunos";
if($sexo && $sexo !== "null"){
    $sql .= " WHERE sexo = :sexo";
}

$sql = $conn->prepare($sql);
$sql->bindParam(":sexo", $sexo);
$sql->execute();

if ($sql->rowCount() > 0) {
    $alunos = $sql->fetchAll(PDO::FETCH_ASSOC);
}

?>

<form method="POST">
    <table border=1>
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Complemento</th>
                <th>Turma</th>
                <th>Ação</th>
            </tr>
            <thead>
            <tbody>
                <?php
                foreach ($alunos as $dado) :
                ?>

                    <tr>
                        <td><?php echo $dado["matricula"]; ?></td>
                        <td><?php echo $dado["nome"]; ?></td>
                        <td><?php echo $dado["sexo"]; ?></td>
                        <td><?php echo $dado["datadenascimento"]; ?></td>
                        <td><?php echo $dado["cidade"]; ?></td>
                        <td><?php echo $dado["bairro"]; ?></td>
                        <td><?php echo $dado["rua"]; ?></td>
                        <td><?php echo $dado["numero"]; ?></td>
                        <td><?php echo $dado["complemento"]; ?></td>
                        <td><?php echo $dado["turmas"]; ?></td>
                        <td><a href="editar_aluno.php?id=<?php echo $dado["matricula"]; ?>">Editar</a>&nbsp;<a href="excluir_aluno.php?id=<?php echo $dado["matricula"]; ?>">Excluir</a></td>
                    </tr>

                <?php
                endforeach;
                ?>
            </tbody>
    </table>
</form>

<a href="cadastroaluno.php">Cadastrar Aluno</a><br><br>
<a href="cadastrarturma.php">Cadastrar Turma</a><br><br>
<a href="cadastroalunoeturma.php">Lista de alunos</a><br><br>
<br><br>
<a href="/logout.php">Sair</a>
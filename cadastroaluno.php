<?php

session_start();

$conexao = new PDO("mysql:host=localhost;dbname=db", "root", "");
$conexao->exec('SET CHARACTER SET utf8');

$pegaCidades = $conexao->prepare("SELECT * FROM cidades WHERE estados_id='23'");
$pegaCidades->execute();

$fetchAll = $pegaCidades->fetchAll();
?>

<h1>Cadastro de aluno</h1>

<?php if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>

<form method="POST" action="processa.php">

    <br>Campos obrigatórios tem o final *.<br><br>

    Nome* <br />
    <div class="campo"> <input type="text" name="nome" placeholder="Nome completo"><br><br></div>

    Sexo* <br> <label><input type="radio" value="homem" name="sexo" />Homem</label>
    <br> <label><input type="radio" value="mulher" name="sexo" />Mulher</label>
    <br> <label><input type="radio" value="naobinario" name="sexo" />Não binário</label><br><br>

    Data de nascimento*<br> <input name="datadenascimento" type="date"><br><br>


    Cidade<br><select name="cidade" id="cidade">

        <option value="" selected disabled>Selecione sua cidade</option>

        <?php
        foreach ($fetchAll as $estados) {
            echo '<option value="' . $estados['id'] . '">' . $estados['nome'] . '</option>';
        } ?>
    </select><br><br>

    Bairro<br><input type="text" name="bairro" placeholder="Bairro"><br><br>

    Rua<br><input type="text" name="rua" placeholder="Rua"><br><br>

    Número<br><input type="text" name="numero" placeholder="Número"><br><br>

    Complemento<br><input type="text" name="complemento" placeholder="Complemento"><br><br><br>

    <input type="submit" value="Cadastrar">


</form>
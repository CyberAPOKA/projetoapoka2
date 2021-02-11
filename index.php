<?php

$msg = [];
$login = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
    $pass_c = filter_input(INPUT_POST, "pass_c", FILTER_SANITIZE_STRING);

    $erro = 0;

    if (strlen($login) == 0) {
        $erro++;
        array_push($msg, "O campo 'login' é obrigatorio");
    } elseif (strlen($login) < 6 or strlen($login) > 20) {
        $erro++;
        array_push($msg, "O número de caracteres é invalido");
    }

    if (strlen($pass) == 0) {
        $erro++;
        array_push($msg, "O campo senha é obrigatorio");
    } elseif ($pass !== $pass_c) {
        $erro++;
        array_push($msg, "A confirmação de senha e diferente");
    }

    if ($erro === 0) {
        require_once "conexao.php";
        $sql = $conn->prepare("SELECT * FROM users WHERE login = :login");
        $sql->bindParam(":login", $login);
        $sql->execute();

        if ($sql->fetchColumn()) {
            $erro++;
            array_push($msg, "O Usuário " . $login . " já foi registrado.");
        }


        if ($erro === 0) {
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

            $sql = $conn->prepare("INSERT `users` (`id`, `login`, `password`) VALUE (NULL, :login, :pass)");
            $sql->bindParam(":login", $login);
            $sql->bindParam(":pass", $pass_hash);
            $result = $sql->execute();

            if ($result) {
                array_push($msg, "O usuário foi criado com sucesso!");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <?php
    if ($msg != null and is_array($msg)) {
        foreach ($msg as $value) {
            echo "<p>", $value, "</p>";
        }
    }
    ?>
    <form method="POST">
        Crie seu usuário para ter acesso ao sistema.<br><br>
        <label for="login">Usuário</label><br>
        <input type="text" value="<?= $login ?>" id="login" name="login"><br><br>
        <label for="password">Senha</label><br>
        <input type="password" id="password" name="pass"><br><br>
        <label for="password">Confirmação de Senha</label><br>
        <input type="password" id="password" name="pass_c"><br><br>
        <button type="submit">Registrar</button>
    </form>
    <br>Já tem um Usuário? Faça Login abaixo.<br>
    <br><input type="submit" value="Logar" onclick="location.href='Login.php'">
</body>

</html>
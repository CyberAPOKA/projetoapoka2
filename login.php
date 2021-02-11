<?php

session_start();

$login = null;
$msg = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);

    $erro = 0;

    if (!strlen($login)) {
        $erro++;
        array_push($msg, "O campo 'Login' está em branco");
    }

    if (!strlen($pass)) {
        $erro++;
        array_push($msg, "O campo 'Senha' está em branco");
    }

    if ($erro === 0) {
        require_once "conexao.php";

        $sql = $conn->prepare("SELECT * FROM `users` WHERE `login` = ?");
        $sql->bindParam(1, $login);
        $sql->execute();
        $result = $sql->fetchAll();

        if (count($result)) {
            if (password_verify($pass, $result[0]["password"])) {
                $_SESSION[md5("api")] = [
                    "id" => $result[0]["id"],
                    "token" => sha1(md5(time()))
                ];

                array_push($msg, "Login efetuado com sucesso");
                header("Location: painel.php");
                exit();
            } else {
                array_push($msg, "Usuário ou/e senha invalido/s");
            }
        } else {
            array_push($msg, "Usuário ou/e senha invalido/s");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($msg != null and is_array($msg)) {
        foreach ($msg as $value) {
            echo "<p>", $value, "</p>";
        }
    }
    ?>
    <form action="/login.php" method="POST">
        Faça seu Login para ter acesso ao sistema.<br><br>
        <label for="login">Usuário</label><br>
        <input type="text" value="<?= $login ?>" id="login" name="login"><br><br>
        <label for="password">Senha</label><br>
        <input type="password" id="password" name="pass"><br><br>


        <br><br><button type="submit">Logar</button>
    </form>
    <br><a href="index.php">Voltar</a>

</body>

</html>
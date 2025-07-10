<?php
$arquivo = "usuário.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login']) && isset($_POST['senha'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $acao = $_POST['acao'];
    $mensagem = "";

    if ($acao == "criar") {
        $linha = $login . ";" . $senha . "\n";
        $fd = fopen($arquivo, 'a');
        fwrite($fd, $linha);
        fclose($fd);
        $mensagem = "Usuário '$login' criado com sucesso!";
    } elseif ($acao == "verificar") {
        $loginEncontrado = false;

        if (file_exists($arquivo)) {
            $fd = fopen($arquivo, 'r');
            while (!feof($fd)) {
                $linha = fgets($fd);
                if (trim($linha) != "") {
                    list($loginArmazenado, $senhaArmazenada) = explode(";", trim($linha));
                    if ($loginArmazenado == $login && $senhaArmazenada == $senha) {
                        $loginEncontrado = true;
                        break;
                    }
                }
            }
            fclose($fd);
        }

        if ($loginEncontrado) {
            $mensagem = "Login e senha corretos. Acesso permitido!";
        } else {
            $mensagem = "Login ou senha inválidos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício - Login</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        form { border: 1px solid #ccc; padding: 20px; max-width: 300px; }
        input { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
        button { padding: 10px 15px; margin-right: 10px; cursor: pointer; }
        .mensagem { margin-top: 20px; padding: 10px; border: 1px solid green; background-color: #e6ffe6; }
    </style>
</head>
<body>

    <form action="index.php" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" placeholder="Seu login aqui" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Sua senha aqui" required>
        <button type="submit" name="acao" value="criar">CRIAR</button>
        <button type="submit" name="acao" value="verificar">VERIFICAR</button>
    </form>

    <?php
    if (!empty($mensagem)) {
        echo '<div class="mensagem">' . htmlspecialchars($mensagem) . '</div>';
    }
    ?>

</body>
</html>

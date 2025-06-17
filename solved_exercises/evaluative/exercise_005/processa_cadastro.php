<!DOCTYPE html>
<html>

<head>
    <title>Validação de cadastro</title>
</head>

<body>
    <h1>Relatório de cadastro</h1>

    <?php
    $nome_completo = $_POST['nome_completo'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $url_pagina_pessoal = $_POST['url_pagina_pessoal'];
    $estado_reside = $_POST['estado_reside'];

    $erros = [];

    if (empty($nome_completo)) {
        $erros[] = "Nome completo é obrigatório.";
    }
    if (empty($email)) {
        $erros[] = "E-mail é obrigatório.";
    }
    if (empty($data_nascimento)) {
        $erros[] = "Data de nascimento é obrigatória.";
    }
    if (empty($telefone)) {
        $erros[] = "Telefone é obrigatório.";
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Endereço de e-mail inválido.";
    }

    if (!empty($data_nascimento)) {
        $data_partes = explode('/', $data_nascimento);
        if (count($data_partes) != 3 || !checkdate($data_partes[1], $data_partes[0], $data_partes[2])) {
            $erros[] = "Data de nascimento inválida. Use o formato DD/MM/AAAA.";
        }
    }

    if (!empty($telefone) && !preg_match("/^\([0-9]{2}\)[0-9]{4}-[0-9]{4}$/", $telefone)) {
        $erros[] = "Telefone inválido. Use o formato (DD)DDDD-DDDD.";
    }

    if (!empty($url_pagina_pessoal) && !filter_var($url_pagina_pessoal, FILTER_VALIDATE_URL)) {
        $erros[] = "URL da página pessoal inválida.";
    }

    if (!empty($erros)) {
        echo "<div style='color: red;'>";
        foreach ($erros as $erro) {
            echo "<p>Erro: " . htmlspecialchars($erro) . "</p>";
        }
        echo "</div>";
    } else {
        echo "<p>Nome Completo: " . htmlspecialchars($nome_completo) . "</p>";
        echo "<p>E-mail: " . htmlspecialchars($email) . "</p>";
        echo "<p>Data de Nascimento: " . htmlspecialchars($data_nascimento) . "</p>";
        echo "<p>Telefone: " . htmlspecialchars($telefone) . "</p>";
        echo "<p>URL Página Pessoal: " . (empty($url_pagina_pessoal) ? "Não informada" : htmlspecialchars($url_pagina_pessoal)) . "</p>";
        echo "<p>Estado onde reside: " . (empty($estado_reside) ? "Não informado" : htmlspecialchars($estado_reside)) . "</p>";
    }
    ?>
</body>
</html>

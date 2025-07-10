/* Considere vetores com nomes, telefones, emails, e datas de nascimento, por exemplo:
$nomes = array('fulano de tal', 'fulano da silva', 'CICRANO DE SOUZA');
$fones = array('(47)3635-3434','(47)99990-4545','(48)98818-1818');
$emails = array('fulano@gmail.com','fsilva@gmail.com','cicrano@hotmail.com');
$bday = array('19/09/2001','23/10/1997','08/03/2002');
Escreva um script para validar os telefones, emails e datas de nascimento, identificando valores incorretos.
Liste os nomes completos com iniciais em maiúsculo.
Liste os emails pertencentes a hotmail.com. */

<?php

$nomes = array('fulano de tal', 'fulano da silva', 'CICRANO DE SOUZA');
$fones = array('(47)3635-3434','(47)99990-4545','(48)98818-1818', '123-4567');
$emails = array('fulano@gmail.com','fsilva@gmail.com','cicrano@hotmail.com', 'emailinvalido.com');
$bday = array('19/09/2001','23/10/1997','08/03/2002', '30/02/2023');

echo "--- Validação de dados ---<br><br>";

for ($i = 0; $i < count($nomes); $i++) {
    echo "Nome: " . ucwords(strtolower($nomes[$i])) . "<br>";

    // Validação do telefone
    if (preg_match('/^\(\d{2}\)\d{4,5}-\d{4}$/', $fones[$i])) {
        echo "Telefone: " . $fones[$i] . " (Válido)<br>";
    } else {
        echo "Telefone: " . $fones[$i] . " (Inválido)<br>";
    }

    // Validação do email
    if (filter_var($emails[$i], FILTER_VALIDATE_EMAIL)) {
        echo "Email: " . $emails[$i] . " (Válido)<br>";
    } else {
        echo "Email: " . $emails[$i] . " (Inválido)<br>";
    }

    // Validação da data de nascimento
    $dataArray = explode('/', $bday[$i]);
    if (count($dataArray) == 3 && checkdate($dataArray[1], $dataArray[0], $dataArray[2])) {
        echo "Data de nascimento: " . $bday[$i] . " (Válida)<br>";
    } else {
        echo "Data de nascimento: " . $bday[$i] . " (Inválida)<br>";
    }
    echo "<br>";
}

echo "--- Nomes completos com as iniciais em maiúsculo ---<br><br>";
foreach ($nomes as $nome) {
    echo ucwords(strtolower($nome)) . "<br>";
}

echo "<br>--- Emails do hotmail.com ---<br><br>";
foreach ($emails as $email) {
    if (strpos($email, '@hotmail.com') !== false) {
        echo $email . "<br>";
    }
}

?>

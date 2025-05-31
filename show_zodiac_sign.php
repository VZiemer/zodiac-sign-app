<?php include('layouts/header.php');

function loadZodiacSigns($filePath) {
    return simplexml_load_file($filePath);
}

function parseDate($dateStr, $format = 'd/m') {
    return DateTime::createFromFormat($format, $dateStr);
}

function findZodiacSign($birthDate, $signsXml) {
    $birth = DateTime::createFromFormat('Y-m-d', $birthDate);
    $birthFormatted = $birth->format('d/m');

    foreach ($signsXml->signo as $sign) {
        $start = parseDate((string)$sign->dataInicio);
        $end = parseDate((string)$sign->dataFim);
        $testDate = parseDate($birthFormatted);

        if ($start > $end) { // signo que atravessa o ano (ex: Capricórnio)
            $end->modify('+1 year');
            if ($testDate < $start) $testDate->modify('+1 year');
        }

        if ($testDate >= $start && $testDate <= $end) {
            return $sign;
        }
    }

    return null;
}

function renderSignResult($sign) {
    if ($sign) {
        echo "<div class='card text-center'>
                <h2>Seu signo é: <strong>{$sign->signoNome}</strong></h2>
                <p>{$sign->descricao}</p>
                <a href='index.php' class='btn btn-secondary mt-3'>Voltar</a>
              </div>";
    } else {
        echo "<div class='card text-center'>
                <h2>Não foi possível determinar seu signo.</h2>
                <a href='index.php' class='btn btn-secondary mt-3'>Tentar novamente</a>
              </div>";
    }
}

// 🚀 Execução
$birthDateInput = $_POST['data_nascimento'] ?? null;
$signs = loadZodiacSigns("signos.xml");
$foundSign = findZodiacSign($birthDateInput, $signs);
renderSignResult($foundSign);

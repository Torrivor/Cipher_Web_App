<?php
function vigenereCipher($text, $key, $encrypt = true) {
    $output = '';

    $text = strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text));
    $key = strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $key));

    $text = preg_replace("/[^A-Z]/", "", $text);
    $key = preg_replace("/[^A-Z]/", "", $key);

    if (strlen($key) == 0) return "Błąd: Pusty klucz!";

    $keyLen = strlen($key);
    for ($i = 0, $j = 0; $i < strlen($text); $i++) {
        $c = ord($text[$i]);
        $k = ord($key[$j % $keyLen]);
        if ($encrypt) {
            $output .= chr((($c + $k - 2 * 65) % 26) + 65);
        } else {
            $output .= chr((($c - $k + 26) % 26) + 65);
        }
        $j++;
    }
    return $output;
}

function caesarCipher($text, $key, $encrypt = true) {
    $output = '';
    $text = strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text));
    $text = preg_replace("/[^A-Z]/", "", $text);

    if (!is_numeric($key) || $key === '') return "Błąd: Pusty klucz!";

    $key = intval($key) % 26;
    if (!$encrypt) $key = 26 - $key;

    for ($i = 0; $i < strlen($text); $i++) {
        $c = ord($text[$i]);
        $output .= chr((($c - 65 + $key) % 26) + 65);
    }
    return $output;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $key = $_POST["key"];
    $action = $_POST["action"];
    $cipher = $_POST["cipher"];

    if ($cipher == "vigenere") {
        $result = vigenereCipher($text, $key, $action == "encrypt");
    } else {
        $result = caesarCipher($text, $key, $action == "encrypt");
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wynik szyfrowania</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Wynik:</h2>
        <pre><?php echo htmlspecialchars($result); ?></pre>
        <a href="index.html">⬅ Wróć</a>
    </div>
</body>
</html>

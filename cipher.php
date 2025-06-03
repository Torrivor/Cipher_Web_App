<?php
function vigenereCipher($text, $key, $encrypt = true) {
    $output = '';
    $text = strtoupper(preg_replace("/[^A-Z]/", "", $text));
    $key = strtoupper(preg_replace("/[^A-Z]/", "", $key));

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $key = $_POST["key"];
    $action = $_POST["action"];

    $result = vigenereCipher($text, $key, $action == "encrypt");

    echo "<h2>Wynik:</h2>";
    echo "<pre>$result</pre>";
    echo '<a href="index.html">⬅ Wróć</a>';
}
?>

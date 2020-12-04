<?php
$validPWs = 0;
$rfile = "inputDay2.conf";
$lines = file($rfile);

echo count($lines)."<br>";
foreach ($lines as $line) {
    echo $line . "<br>";
    list($minMax, $charRaw, $pw) = explode(" " ,$line);
    list($min, $max) = explode("-", $minMax);
    $char = str_replace(":","",$charRaw);
    echo $char . "<br>";
    $count = substr_count($pw, $char);
    echo $count . "<br>";
    if (($min <= $count) && ( $count <= $max)) {
        echo "Valid<br>";
        $validPWs++;
    } else {
        echo "NOT VALID!!!<br>";
    }
}

echo "Repaired your Database!!! $validPWs are valid.";
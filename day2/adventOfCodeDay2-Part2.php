<?php
$validPWs = 0;
$rfile = "inputDay2.conf";
$lines = file($rfile);

echo "Anzahl der Linien: ".count($lines)."<br>";
foreach($lines as $line) {
    //Informationen in Vaiablen speichern
    if (trim($line) == "") {
        continue;
    }
    echo "Line: \"" . $line . "\"<br>";
    list($poses, $needleRaw, $pw) = explode(" " ,$line);
    list($pos1, $pos2) = explode("-", $poses);
    $needle = str_replace(":","",$needleRaw);
    echo "needle: \"".$needle . "\"<br>";
    $pos1--;
    $pos2--;
    $pw = trim($pw);

    //Passwort in Array umwandeln, um Positionen verrechnen zu können
    $pwArr = str_split($pw);
    $found = false;
    $dead = false;
    $curPos = 0;
    foreach ($pwArr as $char) {
        echo "CurPos= \"".$curPos."\"<br>";
        echo "CurChar= \"".$char."\"<br>";
        if ($char == $needle) {
            echo "char == needle<br>";
            if (($pwArr[$curPos] == $pwArr[$pos1]) XOR ($pwArr[$curPos] == $pwArr[$pos2])){
                if (!$found) {
                    echo "found<br>";
                    $found = true;
                }
            } else {
                $dead = true;
                echo "dead, weil char == needle und found<br>";
            }
        }
        $curPos++;
    }
    if ($dead == false && $found == true) {
        $validPWs++;
        echo "Valid!!! <br>";
    } else {
        echo "nicht Valide <br>";
    }
    
    echo "<br>";
}

echo "Es wurden $validPWs valide Passwörter gefunden!";
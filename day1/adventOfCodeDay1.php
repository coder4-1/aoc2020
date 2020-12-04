<?php
$rfile="inputDay1.txt";
$lines = file($rfile);

foreach($lines as $line) {
    foreach($lines as $line2) {
        if (($line + $line2) == 2020) {
            echo "Gefunden! Zahl1: $line, Zahl2: $line2 <br>";
            echo "Multipliziert ergibt das: ".$line*$line2."<br>";
        }
    }
}
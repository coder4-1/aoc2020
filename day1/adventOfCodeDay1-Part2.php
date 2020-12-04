<?php
$rfile="inputDay1.txt";
$lines = file($rfile);

foreach($lines as $line) {
    foreach($lines as $line2) {
        foreach($lines as $line3) {
            if (($line + $line2 + $line3) == 2020) {
                echo "Gefunden! Zahl1: $line, Zahl2: $line2, Zahl3: $line3<br>";
                echo "Multipliziert ergibt das: ".$line*$line2*$line3."<br>";
            }
        }
    }
}
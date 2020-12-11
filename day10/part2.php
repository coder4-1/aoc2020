<?php
$path="input";
$lines=file($path);

for($i=0;$i<count($lines);$i++) {
    $lines[$i] = trim($lines[$i]);
}
sort($lines);

//Füge bei Index 0 die Zahl 0 ein. (Der joltage-Ausgang am Sitz)
array_unshift($lines, 0);
//Füge am Ende die höchste Zahl + 3 hinzu um das joltage Level der Baterie des Displays zu erreichen
array_push($lines, $lines[count($lines)-1] + 3);

//Mach ein Array, das die Anzahl Möglichkeiten bis zum Index zu kommen als Value für den Index speichert.
$poss = array(1);
//Fülle das Array von Index 1 bis zum Ende mit Nullen. Index 0 wurde beim initialisieren des Arrays bereits gesetzt.
for($i=1;$i<$lines[count($lines)-1];$i++) {
    $poss[$i] = 0;
}

//Gehe die Adapter durch und Addiere die Möglichkeiten der vorherigen 3 Zahlen zusammen. Das ist dann die Anzahl der Möglichkeiten zum aktuellen Adapter zu kommen.
foreach($lines as $line) {
    if ($line == 0) {
        continue;
    }
    $poss[$line] = $poss[$line-1] + $poss[$line-2] + $poss[$line-3];
}

//print_r($lines); echo "<br>";
//print_r($poss); echo "<br>";

echo "Das höchste Element in poss ist: " . $poss[count($poss)-1];
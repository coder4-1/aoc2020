<?php
$zaeune = 0;
$rfile="inputDay3.txt";
$lines = file($rfile);
$world;
$newWorld;
$posX = 0;
$posY = 0;
$slopeX = 1;
$slopeY = 2;
for ($i=0; $i<count($lines); $i++) {
    $world[$i] = str_split(trim($lines[$i]));
}

foreach ($world as $row) {
    foreach ($row as $char) {
        echo $char;
    }
    echo "<br>";
}

$newWorld = $world;
for($posY; $posY<count($world); $posY += $slopeY) {
    //$posX=$posY*3;
    //$posX = $posX % count($world[$posY]);
    if ("#" == $world[$posY][$posX]) {
        echo "Gartenzaun in y=$posY und x=$posX!<br>\n";
        $newWorld[$posY][$posX] = "X";
        $zaeune++;
    } else if ("." == $world[$posY][$posX]) {
        echo "Kein gartenzaun gefunden in y=$posY und x=$posX<br>\n";
        $newWorld[$posY][$posX] = "0";
    } else {
        echo "FEHLER FEHLER FEHLER in posY=$posY und posX=$posX Gefunden hab ich ".$world[$posY][$posX]."<br>\n";
    }
    if ($posX == 28) {
        //echo "$posX ist jetzt 28 und wird gleich erhöht<br>\n";
        //echo "Die Länge der Zeile getrimmten ist: ".count($world[$posY])."<br>\n";
    }
    $posX += $slopeX;
    if ($posX >= count($world[$posY])) {
        //echo "In posX >= count(world[posY])<br>\n";
        //$posX = $posX % count($world[$posY]);
        $posX -= count($world[$posY])/*-1*/;
        //echo "posX ist jetzt nach Erhöhung und zu hoch feststellung und verniedrigung $posX<br>\n";
    }
}

echo "$zaeune Gartenzäune gefunden!\n";
echo "new World: \n";

foreach ($newWorld as $row) {
    foreach ($row as $char) {
        echo $char;
    }
    echo "<br>";
}
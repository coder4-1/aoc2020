<?php
$zaeune = 0;
$rfile="inputDay3.txt";
$lines = file($rfile);
$world;
$posX = 0;
$posY = 0;
$slopeX = 1;
$slopeY = 2;
for ($i=0; $i<count($lines); $i++) {
    $world[$i] = str_split(trim($lines[$i]));
}

$newWorld = $world;
for($posY; $posY<count($world); $posY += $slopeY) {
    if ("#" == $world[$posY][$posX]) {
        $zaeune++;
    }
    $posX += $slopeX;
    if ($posX >= count($world[$posY])) {
        $posX -= count($world[$posY]);
    }
}
echo "$zaeune Gartenzäune gefunden!\n";
<?php
$path="input";
$lines=file($path);

$x = 0;
$y = 0;
$dir = 90;

foreach($lines as $line) {
    $command = substr($line,0,1);
    $arg = trim(substr($line,1));
    if ($command == "N") {
        $y -= $arg;
    } else if ($command == "E") {
        $x += $arg;
    } else if ($command == "S") {
        $y += $arg;
    } else if ($command == "W") {
        $x -= $arg;
    } else if ($command == "L") {
        if ($dir == 0) {
            $dir = 360;
        }
        $dir -= $arg;
        if ($dir < 0) {
            $dir += 360;
        }
    } else if ($command == "R") {
        if ($dir == 360) {
            $dir = 0;
        }
        $dir += $arg;
        if ($dir > 360) {
            $dir -= 360;
        }
    } else if ($command == "F") {
        if ($dir == 0 || $dir == 360) {
            $y -= $arg;
        } else if ($dir == 90) {
            $x += $arg;
        } else if ($dir == 180) {
            $y += $arg;
        } else if ($dir == 270) {
            $x -= $arg;
        }
    }
    //echo "x:$x y:$y dir:$dir<br>";
}

$sum = abs($x) + abs($y);
echo "Sum of x und y: $sum<br>";
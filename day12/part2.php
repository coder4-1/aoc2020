<?php
$path="input";
$lines=file($path);

$xWaypoint = 10;
$yWaypoint = -1;
$xShip = 0;
$yShip = 0;

foreach($lines as $line) {
    $command = substr($line,0,1);
    $arg = trim(substr($line,1));
    if ($command == "N") {
        $yWaypoint -= $arg;
    } else if ($command == "E") {
        $xWaypoint += $arg;
    } else if ($command == "S") {
        $yWaypoint += $arg;
    } else if ($command == "W") {
        $xWaypoint -= $arg;
    } else if ($command == "L") {
        $x=$xWaypoint;
        $y=$yWaypoint;
        if ($arg == 90) {
            $xWaypoint = $y;
            $yWaypoint = -$x;
        } else if ($arg == 180) {
            $xWaypoint = -$x;
            $yWaypoint = -$y;
        } else if ($arg == 270) {
            $xWaypoint = -$y;
            $yWaypoint = $x;
        }
    } else if ($command == "R") {
        $x=$xWaypoint;
        $y=$yWaypoint;
        if ($arg == 90) {
            $xWaypoint = -$y;
            $yWaypoint = $x;
        } else if ($arg == 180) {
            $xWaypoint = -$x;
            $yWaypoint = -$y;
        } else if ($arg == 270) {
            $xWaypoint = $y;
            $yWaypoint = -$x;
        }
    } else if ($command == "F") {
        $xShip = $xShip + $xWaypoint * $arg;
        $yShip = $yShip + $yWaypoint * $arg;
    }
    //echo "xWaypoint:$xWaypoint yWaypoint:$yWaypoint xShip:$xShip yShip:$yShip<br>";
}

$sum = abs($xShip) + abs($yShip);
echo "Sum of x und y: $sum<br>";
<?php
$path="input";
$lines=file($path);

$cordsX = array();
$cordsY = array();
$seatIDs = array();
$j = 0; //Zähler für Seat IDs
$personalSeatID;
foreach($lines as $line) {
    $x = 0;
    $y = 0;
    $lineArr = str_split($line);
    for ($i = 0; $i < 7; $i++) {
        $cordsY[$i] = $lineArr[$i];
    }
    for ($i = 7; $i < 10; $i++) {
        $cordsX[$i] = $lineArr[$i];
    }
    $low = 0;
    $top = 127;
    foreach($cordsY as $char) {
        //echo "Low: $low Top: $top<br>";
        if ($char=="F") {
            $top = $low+intval(($top-$low)/2);
            //echo "Action: F<br>";
        } else if ($char=="B") {
            $low = $top-intval(($top-$low)/2);
            //echo "Action: B<br>";
        }
    }
    //echo "Low: $low Top: $top<br>";
    //echo "<br><br>";
    if ($low==$top) {
        $y=$low;
    }
    $low = 0;
    $top = 7;
    foreach($cordsX as $char) {
        //echo "Low: $low Top: $top<br>";
        if ($char=="L") {
            $top = $low+intval(($top-$low)/2);
            //echo "Action: L<br>";
        } else if ($char=="R") {
            $low = $top-intval(($top-$low)/2);
            //echo "Action: R<br>";
        }
    }
    //echo "Low: $low Top: $top<br><br>";
    if ($low==$top) {
        $x=$low;
    }
    $seatID = $y*8+$x;
    $seatIDs[$j] = $seatID;
    $j++;
    //echo "Seat-ID: $seatID";
    //echo "<br>----------------------<br><br>";
}
//echo "<br><br><br><br><br>";
sort($seatIDs);
//print_r($seatIDs);
//echo "<br>";

$lastID = $seatIDs[0]-1;
for($i = 0; $i < count($seatIDs); $i++) {
    $id = $seatIDs[$i];
    if (($lastID + 1) == $id) {
        //echo "In ($lastID + 1) == $id<br>";
        $lastID = $id;
    } else {
        //echo "In Lücke gefunden, setzte seat ID auf meinen Platz, bei id=".($id-1)."<br>";
        $personalSeatID = $id-1;
        $lastID = $id;
    }
}

echo "Your Seat ID is: $personalSeatID";
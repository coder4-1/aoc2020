<?php
$startingNumbers=array(8,0,17,4,1,12);
//$startingNumbers=array(0,3,6);
$turns=$startingNumbers;
for($i=1; $i <= 2020; $i++) {
    if (($i)<=count($startingNumbers)) {
        //echo "Turn $i übersprungen<br>";
        continue;
    }
    $lastSpoken = $turns[$i-2];
    $spoken = -1;
    $turnCountVals = array_count_values($turns);
    //echo "turnCountVals[lastSpoken] " . $turnCountVals[$lastSpoken] . ", lastSpoken $lastSpoken<br>";
    if ($turnCountVals[$lastSpoken] == 1) {
        //echo "Turn $i ist neu, deshalb spoken=0<br>";
        $spoken = 0;
    } else if ($turnCountVals[$lastSpoken] > 1) {
        $keys = array_keys($turns, $lastSpoken);
        $key = max($keys);
        $editedTurns = $turns;
        $editedTurns[$key] = "-2";
        $keys = array_keys($editedTurns, $lastSpoken);
        $key = max($keys);
        $spoken = ($i-1)-($key+1);
        //echo "Turn $i, lastSpoken $lastSpoken, maxKey $key, i $i, soken $spoken<br>";
    }
    $turns[$i-1] = $spoken;
}

//print_r($turns);
echo "Zahl bei Turn 2020: " . $turns[2019] . "<br>";
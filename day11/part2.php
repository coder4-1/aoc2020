<?php
$path="input";
$lines=file($path);

$lastLines = array();
$finished = false;
$count = 0;

$i = 0;
foreach($lines as $line) {
    $lines[$i] = str_split(trim($line));
    $i++;
}

for($j = 0; $j < 300 && !$finished; $j++) {
    if (compareArray($lines, $lastLines)) {
        echo "<br><br>Last State reached!<br>";
        $finished = true;
    }
    $lastLines = $lines;
    if (!$finished) {
        $lines = simulateSeating($lines);
    }
    if ($j == 299) {
        echo "<br><br>Gleich wird abgebrochen, weil zu lange gebraucht!";
    }
}

foreach($lines as $line) {
    foreach($line as $seat) {
        if ($seat == "#") {
            $count++;
        }
    }
}

echo "In the final state there are $count seats occupied!";

function compareArray($array1, $array2) {
    //echo "Compairing Arrays: ";
    $i = 0;
    foreach($array1 as $lineArr) {
        $line = "";
        foreach($lineArr as $seat) {
            $line .= $seat;
        }
        $array1[$i] = $line;
        $i++;
    }
    $i = 0;
    foreach($array2 as $lineArr) {
        $line = "";
        foreach($lineArr as $seat) {
            $line .= $seat;
        }
        $array2[$i] = $line;
        $i++;
    }
    if ($array1 === $array2) {
        //echo "In return true for the comparing<br><br>";
        return true;
    } else {
        //echo "In return false!!!<br><br>";
        return false;
    }
}

function simulateSeating($array) {
    //echo "<br>In simualte<br>";
    $newArray = $array;
    for($y = 0; $y < count($array); $y++) {
        $line = $array[$y];
        for($x = 0; $x < count($line); $x++) {
            $seat = $line[$x];
            if ($seat == "#") {
                $count = 0;
                $dead = false;
                for($i = 0; ($y-$i > 0) && ($x-$i > 0) && !$dead; $i++) {
                    if ($array[$y-$i-1][$x-$i-1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y-$i-1][$x-$i-1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; $y-$i > 0 && !$dead; $i++) {
                    if ($array[$y-$i-1][$x]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y-$i-1][$x]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; ($y-$i > 0) && ($x+$i < count($array[0])) && !$dead; $i++) {
                    if ($array[$y-$i-1][$x+$i+1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y-$i-1][$x+$i+1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; $x-$i > 0 && !$dead; $i++) {
                    if ($array[$y][$x-$i-1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y][$x-$i-1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; $x+$i < count($array[0]) && !$dead; $i++) {
                    if ($array[$y][$x+$i+1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y][$x+$i+1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; ($y+$i < count($array)) && ($x-$i > 0) && !$dead; $i++) {
                    if ($array[$y+$i+1][$x-$i-1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y+$i+1][$x-$i-1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; $y+$i < count($array) && !$dead; $i++) {
                    if ($array[$y+$i+1][$x]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y+$i+1][$x]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; ($y+$i < count($array)) && ($x+$i < count($array[0])) && !$dead; $i++) {
                    if ($array[$y+$i+1][$x+$i+1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y+$i+1][$x+$i+1]=="L") {
                        $dead = true;
                    }
                }
                //echo "seat is # an count is: $count<br>";
                if ($count >= 5) {
                    $newArray[$y][$x] = "L";
                }
            } else if ($seat == "L") {
                $count = 0;
                $dead = false;
                for($i = 0; ($y-$i > 0) && ($x-$i > 0) && !$dead; $i++) {
                    if ($array[$y-$i-1][$x-$i-1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y-$i-1][$x-$i-1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; $y-$i > 0 && !$dead; $i++) {
                    if ($array[$y-$i-1][$x]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y-$i-1][$x]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; ($y-$i > 0) && ($x+$i < count($array[0])) && !$dead; $i++) {
                    if ($array[$y-$i-1][$x+$i+1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y-$i-1][$x+$i+1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; $x-$i > 0 && !$dead; $i++) {
                    if ($array[$y][$x-$i-1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y][$x-$i-1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; $x+$i < count($array[0]) && !$dead; $i++) {
                    if ($array[$y][$x+$i+1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y][$x+$i+1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; ($y+$i < count($array)) && ($x-$i > 0) && !$dead; $i++) {
                    if ($array[$y+$i+1][$x-$i-1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y+$i+1][$x-$i-1]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; $y+$i < count($array) && !$dead; $i++) {
                    if ($array[$y+$i+1][$x]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y+$i+1][$x]=="L") {
                        $dead = true;
                    }
                }
                $dead = false;
                for($i = 0; ($y+$i < count($array)) && ($x+$i < count($array[0])) && !$dead; $i++) {
                    if ($array[$y+$i+1][$x+$i+1]=="#") {
                        $count++;
                        $dead = true;
                    }
                    if ($array[$y+$i+1][$x+$i+1]=="L") {
                        $dead = true;
                    }
                }
                //echo "seat is # an count is: $count<br>";
                if ($count == 0) {
                    $newArray[$y][$x] = "#";
                }
            }
        }
    }
    return $newArray;
}
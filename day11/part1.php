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

//print_r($lines);

//print_r(simulateSeating($lines));

for($j = 0; $j < 300 && !$finished; $j++) {
    if (compareArray($lines, $lastLines)) {
        //echo "<br><br>Last State reached!<br>";
        $finished = true;
    }
    $lastLines = $lines;
    if (!$finished) {
        $lines = simulateSeating($lines);
    }
    //showArray($lines);
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
    //echo "Array1: <br>";
    //print_r($array1);
    //echo "<br>Array2: <br>";
    //print_r($array2);
    //echo "<br>";
    if ($array1 === $array2) {
        //echo "In return true for the comparing<br><br>";
        return true;
    } else {
        //echo "In return false!!!<br><br>";
        return false;
    }
}

function showArray($array) {
    echo "<br><br>Showing Array: <br>";
    foreach($array as $line) {
        foreach($line as $seat) {
            echo $seat;
        }
        echo "<br>";
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
                if ($array[$y-1][$x-1]=="#") {
                    $count++;
                }
                if ($array[$y-1][$x]=="#") {
                    $count++;
                }
                if ($array[$y-1][$x+1]=="#") {
                    $count++;
                }
                if ($array[$y][$x-1]=="#") {
                    $count++;
                }
                if ($array[$y][$x+1]=="#") {
                    $count++;
                }
                if ($array[$y+1][$x-1]=="#") {
                    $count++;
                }
                if ($array[$y+1][$x]=="#") {
                    $count++;
                }
                if ($array[$y+1][$x+1]=="#") {
                    $count++;
                }
                //echo "seat is # an count is: $count<br>";
                if ($count >= 4) {
                    $newArray[$y][$x] = "L";
                }
            } else if ($seat == "L") {
                if ($array[$y-1][$x-1]!="#" && $array[$y-1][$x]!="#" && $array[$y-1][$x+1]!="#" && $array[$y][$x-1]!="#" && $array[$y][$x+1]!="#" && $array[$y+1][$x-1]!="#" && $array[$y+1][$x]!="#" && $array[$y+1][$x+1]!="#") {
                    $newArray[$y][$x] = "#";
                }
            }
        }
    }
    return $newArray;
}
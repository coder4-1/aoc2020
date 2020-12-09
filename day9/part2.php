<?php
$path="input";
$lines=file($path);

$low=0;
$preamble=25;
$dead = false;
$invalid = -1;

for($i=$preamble; $i < count($lines) && !$dead; $i++) {
    $valid = false;
    for($j=$low; $j<($low+$preamble); $j++) {
        for($k=$low; $k<($low+$preamble); $k++) {
            if ((trim($lines[$j])!=trim($lines[$k])) && trim($lines[$j])+trim($lines[$k])==trim($lines[$i])) {
                $valid = true;
            }
        }
    }
    $low++;
    if (!$valid) {
        $invalid = trim($lines[$i]);
        echo "The first non valid Number is ".$lines[$i]." at Index $i<br>";
        $dead = true;
    }
}

$range=1;
$dead = false;
$index = -1;

for($i=0; $i<count($lines) && !$dead; $i++) {
    $nextLine = false;
    for($k = 0; $k<count($lines) && !$nextLine; $k++) {
        $curSum = 0;
        for($j=$i; $j<($i+$range); $j++) {
            $curSum += trim($lines[$j]);
        }
        //echo "curSum für i=$i bei range=$range ist $curSum<br>";
        if ($curSum == $invalid) {
            //echo "curSum=$curSum ist == invalid<br>";
            $dead = true;
            $index = $i;
            $nextLine = true;
        } else if ($curSum < $invalid) {
            //echo "curSum=$curSum<invalid $range um eins erhöht auf".($range+1)."<br>";
            $range++;
        } else if ($curSum > $invalid) {
            //echo "curSum=$curSum>invalid range wieder auf 1 und curSum wieder 0 und nextLine auf true<br>";
            $range = 1;
            $curSum = 0;
            $nextLine = true;
        }
    }
}

echo "Die Range ist $range und der Index ab dem die Range beginnt ist $index <br>";
echo "Wert am index bei dem die Range beginnt:" . $lines[$index] . "<br>";
echo "Wert am oberen Ende der Range: " . $lines[$index+$range-1] . "<br>";

$highest = 0;
$lowest = 10000000000;
for($i=0;$i<$range;$i++) {
    echo $lines[$index+$i]."<br>";
    if ($highest < trim($lines[$index+$i])) {
        $highest = trim($lines[$index+$i]);
    }
    if ($lowest > trim($lines[$index+$i])) {
        $lowest = trim($lines[$index+$i]);
    }
}
$sum =  $highest + $lowest;

echo "Niedrigste Zahl in der Range: $lowest<br>";
echo "Höchste Zahl in der Range: $highest<br>";
echo "Die Summer der beiden zahlen ist $sum<br>";
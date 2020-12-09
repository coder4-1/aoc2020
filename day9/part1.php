<?php
$path="input";
$lines=file($path);

$low=0;
$preamble=25;

for($i=$preamble; $i < count($lines); $i++) {
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
        echo "The first non valid Number is ".$lines[$i]." at Index $i<br>";
        exit(1);
    }
}
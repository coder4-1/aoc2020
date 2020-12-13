<?php
$path="input";
$lines=file($path);

$time=trim($lines[0]);
$busesLine=trim($lines[1]);
$bussesArray=explode(",",$busesLine);
$busses = array();
$lowestDiff = $time;
$lowestDiffBusId = -1;
foreach($bussesArray as $bus) {
    if ($bus != "x") {
        for($i=1; $i*$bus<=$time+$bus; $i++) {
            //echo "i mal bus = " . $i*$bus . "<br>";
            $busTime = $i*$bus;
            if ($busTime > $time) {
                //echo "i*bus=$busTime ist größer als time=$time<br>";
                if ($busTime - $time < $lowestDiff) {
                    $lowestDiff = $busTime - $time;
                    $lowestDiffBusId = $bus;
                    //echo "New lowest Diff: $lowestDiff und Bus ID: $lowestDiffBusId<br>";
                }
            }
        }
    }
}
$produkt = $lowestDiff * $lowestDiffBusId;
echo $produkt;
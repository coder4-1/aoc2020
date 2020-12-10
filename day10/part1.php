<?php
$path="input";
$lines=file($path);

for($i=0;$i<count($lines);$i++) {
    $lines[$i] = trim($lines[$i]);
}
sort($lines);
print_r($lines);

$lastValue = 0;
$onevoltdiffs = 0;
$threevoltdiffs = 0;
foreach($lines as $line) {
    $diff = $line - $lastValue;
    echo "Diff: $diff von Line: $line - Lastval: $lastValue<br>";
    if ($diff == 3) {
        $threevoltdiffs++;
    } else if ($diff == 1) {
        $onevoltdiffs++;
    }
    $lastValue = $line;
}
$threevoltdiffs++;

$produkt = $onevoltdiffs * $threevoltdiffs;

echo "<br>";
echo "1: $onevoltdiffs 3: $threevoltdiffs<br>";
echo "Das Produkt aus Anzahl der 1 Volt Diffs und der 3 Volt Diffs ist: $produkt<br>";

//Wrong: 2470
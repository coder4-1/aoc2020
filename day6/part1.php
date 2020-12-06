<?php
$path="input";
$lines=file($path);

$groupAnswers = array();
$groupIndex = 0;
$yesAnswers = array();
$yesIndex = 0;
$letters = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$yesCounter = 0;
foreach($lines as $line) {
    if ($line == "\n") {
        $groupIndex++;
        continue;
    }
    $groupAnswers[$groupIndex] = $groupAnswers[$groupIndex].$line;
}

for($i = 0; $i < count($groupAnswers); $i++) {
    $groupAnswers[$i] = str_replace("\n","",$groupAnswers[$i]);
}

foreach($groupAnswers as $answer) {
    foreach($letters as $letter) {
        if (strpos($answer, $letter) !== false) {
            //echo "$answer contaons $letter<br>";
            $yesAnswers[$yesIndex]++;
        }
    }
    //echo "Group with index: $yesIndex got ".$yesAnswers[$yesIndex]." yes Answers<br><br>";
    $yesIndex++;
}

foreach ($yesAnswers as $yeses) {
    $yesCounter += $yeses;
}

echo "There are $yesCounter yeses!";
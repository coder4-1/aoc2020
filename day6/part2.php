<?php
$path="input";
$lines=file($path);

$groupAnswers = array();
$groupIndex = 0;
$yesAnswers = array();
$yesGroupIndex = 0;
$letters = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$yesCounter = 0;
$NumberOfYesedLettersPerGroup = array();
foreach($lines as $line) {
    if ($line == "\n") {
        $groupIndex++;
        continue;
    }
    $groupAnswers[$groupIndex] = $groupAnswers[$groupIndex].$line;
}

//echo "GroupAnswers in array, dass in erster Postion die Gruppe hat in der als String alle user durch einen Zeilenumbruch gepseicvhert sind<br>";
//print_r($groupAnswers);
//echo "<br><br><br>";

for($i = 0; $i < count($groupAnswers); $i++) {
    $groupAnswers[$i] = explode("\n",$groupAnswers[$i]);
    if ($groupAnswers[$i][count($groupAnswers[$i])-1] == "") {
        array_pop($groupAnswers[$i]);
    }
}

//echo "GroupAnswers in array, dass in erster Postion die Gruppe hat und in zweiter pos die antworten als array pro user<br>";
//print_r($groupAnswers);
//echo "<br><br><br>";

foreach($groupAnswers as $oneGroupAnswers) {
    //echo "onegroupanswer: <br>";
    //print_r($oneGroupAnswers);
    //echo "<br>";
    for($i = 0; $i < count($letters); $i++) {
        $letter = $letters[$i];
        //echo "LEtter $letter<br>";
        for($j = 0; $j < count($oneGroupAnswers); $j++) {
            //echo "IF Abfrage für ".$oneGroupAnswers[$j]."<br>";
            if ((strpos($oneGroupAnswers[$j], $letter) !== false)) {
                //echo "If sagt Buchstabe enthalten<br>";
                $yesAnswers[$yesGroupIndex][$i][$j] = true;
            } else {
                //echo "If sagt Buchstabe NICHT enthalten<br>";
                $yesAnswers[$yesGroupIndex][$i][$j] = -1;
            }
        }
    }
    //echo "Eine Gruppe geschaft<br><br>";
    $yesGroupIndex++;
}

//echo"yesAnser: <br>";
//print_r($yesAnswers);
//echo"<br><br><br>";

$yesGroupIndex = 0;
foreach($yesAnswers as $groupYeses) {
    //echo"GroupYeses: <br>";
    //print_r($groupYeses);
    //echo"<br><br>";
    foreach($groupYeses as $letterWithUserAnswers) {
        //echo "Das ist die Antwort für einen Buchstaben der Gruppe: <br>";
        //print_r($letterWithUserAnswers);
        //echo "<br>";
        $letterDead = false;
        foreach($letterWithUserAnswers as $UserAnswerForOneLetter) {
            //echo "This is the Answer for a Letter From one User: $UserAnswerForOneLetter<br>";
            if ($UserAnswerForOneLetter === -1) {
                //echo "This User anwered no for the Question so the Letter is dead!!!<br>";
                $letterDead = true;
            }
        }
        //echo "Alle Antworten der User für einen Letter durchgegangen<br>";
        if (!$letterDead) {
            //echo "Der Letter ist nicht dead. :-) Es wird eins zum Array Eintrag der Gruppe hinzugezählt!<br>";
            $NumberOfYesedLettersPerGroup[$yesGroupIndex]++;
        }
        //echo "Ein Buchstabe vorbei!<br>";
    }
    //echo "Eine Gruppe vorbei<br>";
    $yesGroupIndex++;
    //echo "<br><br>";
}

foreach ($NumberOfYesedLettersPerGroup as $YesLettersForOneGroup) {
    $yesCounter += $YesLettersForOneGroup;
}

echo "There are $yesCounter yeses!";
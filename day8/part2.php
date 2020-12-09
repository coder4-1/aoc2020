<?php
$path="input";
$lines=file($path);

$jmpORmopLines = array();
$z = 0;

foreach($lines as $line) {
    list($command, $parameter) = explode(" ",trim($line));;
    if ($command == "jmp" || $command == "nop") {
        $jmpORmopLines[count($jmpORmopLines)] = $z;
    }
    $z++;
}
$z=0;

//print_r($jmpORmopLines);

$linesChanged = array();

foreach($jmpORmopLines as $lineNr) {
    list($command, $parameter) = explode(" ",trim($lines[$lineNr]));
    $newLines = $lines;
    if ($command == "jmp") {
        $newLines[$lineNr] = "nop ".$parameter;
        $linesChanged[$z] = $newLines;
    } else if ($command == "nop") {
        $newLines[$lineNr] = "jmp ".$parameter;
        $linesChanged[$z] = $newLines;
    }
    $z++;
}
$z=0;

$finalAcc = -1;

foreach($linesChanged as $curLines) {
    $executedLines = array();
    $acc = 0;
    $dead = false;
    for($i = 0; ($i < count($curLines)) && !$dead ;$i++) {
        //echo "i=$i<br>";
        list($command, $parameter) = explode(" ",trim($curLines[$i]));;
        //echo "cmd:$command Param:$parameter<br>";
        if ($command == "acc") {
            $executedLines[count($executedLines)] = $i;
            $acc += trim($parameter);
        } else if ($command == "jmp") {
            //echo "cmd: jump ";
            $iSoll = $i+trim($parameter);
            //echo "iSoll=$iSoll<br>";
            $executedLines[count($executedLines)] = $i;
            foreach($executedLines as $lineNr) {
                if ($iSoll == $lineNr) {
                    //echo "Die Acc is $acc";
                    $dead = true;
                    //exit(1);
                }
            }
            $i = $iSoll-1;
        }
        if ($i == 600) {
            $finalAcc = $acc;
        }
    }
}

echo "Der Acc nach beenden der Endlosschleife ist $finalAcc.<br>";
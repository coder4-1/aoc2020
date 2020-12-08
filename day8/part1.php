<?php
$path="input";
$lines=file($path);

$executedLines = array();
$acc = 0;

for($i = 0; $i < count($lines);$i++) {
    //echo "i=$i<br>";
    list($command, $parameter) = explode(" ",trim($lines[$i]));;
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
                echo "Die Acc is $acc";
                exit(1);
            }
        }
        $i = $iSoll-1;
    }
}
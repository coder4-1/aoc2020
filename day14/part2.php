<?php
$path="input";
$lines=file($path);

$mem = array();
$mask = "";
$sum = 0;
foreach($lines as $line) {
    if (startsWith($line, "mask")) {
        $mask = trim(str_replace("mask = ", "", $line));
    } else {
        $string = str_replace("mem[", "", $line);
        $string = str_replace("]", "", $string);
        list($index, $value) = explode(" = ", $string);
        $binIndex = decbin($index);
        //echo "Aktuelle Maske: $mask<br>";
        //echo "Binärer String von index: $binIndex (Dec=$index)<br>";
        //$test = bindec($binIndex);
        //echo "Binärer String wieder in Dec umgewandelt: $test<br>";
        $maskArr = str_split($mask);
        $binIndexArr = str_split($binIndex);
        $maskedIndexArr = $maskArr;
        $floatingBitPositions = array();
        for($j=0; $j < count($maskArr); $j++) { //j zählt von 0-35 hoch.
            $i = (count($maskArr)-1)-$j;        //i zählt von 35-0 runter.
            //echo "Aktueller index (von hinten gestartet $j) von der Maske: $i<br>";
            $bit = $maskArr[$i];
            if ($bit === "1") {
                //echo "curMask hat 1!!!<br>";
                $maskedIndexArr[$i] = "1";
            } else if ($bit === "X") {
                //echo "Maske hat ein X<br>";
                $floatingBitPositions[count($floatingBitPositions)] = $i;
                $maskedIndexArr[$i] = "X";
            } else if ($bit === "0") {
                //echo "Maske hat eine 0<br>";
                if ($j >= count($binIndexArr)) {
                    $maskedIndexArr[$i] = "0";
                } else {
                    $maskedIndexArr[$i] = $binIndexArr[(count($binIndexArr)-1)-$j];
                }
            }
        }
        $adresses = array(); //adresses ist das Array in dem alle Adressen für den aktuellen Wert als Dezimale Zahl gespeichert werden
        $floatingBits = array_count_values($maskedIndexArr)["X"];
        //echo "FLB: $floatingBits<br>";
        for($i = 0; $i < 2**$floatingBits; $i++) {
            //echo "Bei Durchlauf $i ";
            $binI = decbin($i);
            $binIArray = str_split($binI);
            $curAdress = $maskedIndexArr;
            //echo "in Binär: $binI<br>";
            //echo "Cur Adress: " . implode($curAdress) . "<br>";
            $binIArray = array_pad($binIArray, -count($floatingBitPositions), "0");
            //echo "binIArray: " . implode($binIArray) . "<br>";
            for($j=count($floatingBitPositions)-1; $j>=0; $j--) {
                //echo "Speichere Bit binIArray[j]=" . $binIArray[$j] . " in curAdress an Stelle floatingBitPositions[j]=" . $floatingBitPositions[$j] . "<br>";
                $curAdress[$floatingBitPositions[$j]] = $binIArray[$j];
            }
            $adresses[count($adresses)] = bindec(implode($curAdress));
            //echo "curAdress in Binär: " . implode($curAdress) . " und curAdress in Dezimal: " . bindec(implode($curAdress)) . "<br>";
        }
        //echo "Adresses die befüllt wurden sind: ";
        //print_r($adresses); echo "<br>";
        foreach($adresses as $adress) {
            $mem[$adress] = $value;
            //echo "Value $value gespeichert an Position: $adress<br>";
            //echo "-----------------------------------------------<br>";
        }        
    }
}

//echo "Memory Array am Ende: ";
//print_r($mem);
//echo "<br>";

$sum = array_sum($mem);

echo "Die Summe aller Memory Values ist: $sum<br>";

function startsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}
function endsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}
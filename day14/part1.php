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
        $binValue = decbin($value);
        //echo "Aktuelle Maske: $mask<br>";
        //echo "Binärer String von value: $binValue (Dec=$value)<br>";
        $test = bindec($binValue);
        //echo "Binärer String wieder in Dec umgewandelt: $test<br>";
        $maskArr = str_split($mask);
        $binValueArr = str_split($binValue);
        $maskedValueArr = $maskArr;
        for($j=0; $j < count($maskArr); $j++) {
            $i = (count($maskArr)-1)-$j;
            //echo "Aktueller index (von hinten gestartet $j) von der Maske: $i<br>";
            $bit = $maskArr[$i];
            if ($bit == "X") {
                $sollBit = $binValueArr[(count($binValueArr)-1)-((count($maskArr)-1)-$i)];
                if ($sollBit != "0" && $sollBit != "1") {
                    $sollBit = "0";
                }
                //echo "Aktuelles Bit der Maske ist ein X<br>";
                //echo "in MaskedValueArr an Stelle $i das da gespeichert: $sollBit<br>";
                $maskedValueArr[$i] = $sollBit;
            }
        }
        $maskedValBin = "";
        foreach($maskedValueArr as $bit) {
            $maskedValBin .= $bit;
        }
        $maskedVal = bindec($maskedValBin);
        //echo "Binäre maskierte Value: $maskedValBin<br>";
        //echo "Maskierte Value: $maskedVal<br>";
        $mem[$index] = $maskedVal;
        //echo "Maskierte Value gespeichert an Position: $index<br>";
        //echo "-----------------------------------------------<br>";
    }

}

//echo "Memory Array am Ende: ";
//print_r($mem);
//echo "<br>";

foreach($mem as $val) {
    $sum += $val;
}

echo "Die Summe aller Memory Values ist: $sum<br>";

function startsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}
function endsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}
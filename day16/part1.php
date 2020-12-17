<?php
$path="input";
$lines=file($path);

$validRooms = array();
$pos=0;
$invalidNumbers = array();

foreach($lines as $line) {
    if ($line == "\n") {
        $pos++;
    }
    if ($pos == 0) {
        list($name, $values) = explode(": ", $line);
        $rooms = explode(" or ", $values);
        foreach($rooms as $room) {
            $room = trim($room);
            $downAndUp = explode("-", $room);
            $validRooms[count($validRooms)] = $downAndUp;
        }
    } else if ($pos == 1) {
        if (trim($line) != "your ticket:") {

        }
    } else if ($pos == 2) {
        if (trim($line) != "nearby tickets:") {
            $valuesInTicket = explode(",", trim($line));
            foreach($valuesInTicket as $value) {
                if ($value == "") {
                    continue;
                }
                $dead = true;
                foreach($validRooms as $room) {
                    if (($room[0] <= $value) && ($value <= $room[1])) {
                        $dead = false;
                    }
                }
                if ($dead) {
                    $invalidNumbers[count($invalidNumbers)] = $value;
                }
            }
        }
    }
}
echo "Die Summer aller ungültiger Zahlen ist: " . array_sum($invalidNumbers);
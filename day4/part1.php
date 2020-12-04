<?php
$path="input";
$lines=file($path);
$passports;
$validPassports;
$i = 0; //Zähler bei dem wie vielten Passwort man ist
$x = 0; //Index of next possible Field in current Passport $passports[$i]
foreach ($lines as $line) {
    $x = 0;
    if ($line == "\n") {
        //echo "Leere Linie:<br>";
        $i++;
        continue;
    }
    if (isset($passports[$i])) {
        $x = count($passports[$i]);
    }
    $fields = explode(" ", $line);
    foreach ($fields as $field) {
        $passports[$i][$x] = $field;
        $x++;
    }
    //echo $line."<br>";
}

//print_r($passports);
//echo "<br>";

foreach ($passports as $passport) {
    $numberOfValidFields = 0;
    foreach ($passport as $field) {
        list($fieldname) = explode(":", $field);
        //echo "Feldname: $fieldname";
        if ($fieldname == "byr") {
            $numberOfValidFields++;
        } else if ($fieldname == "iyr") {
            $numberOfValidFields++;
        } else if ($fieldname == "eyr") {
            $numberOfValidFields++;
        } else if ($fieldname == "hgt") {
            $numberOfValidFields++;
        } else if ($fieldname == "hcl") {
            $numberOfValidFields++;
        } else if ($fieldname == "ecl") {
            $numberOfValidFields++;
        } else if ($fieldname == "pid") {
            $numberOfValidFields++;
        }
        //echo ". Jetzt sind wir bei $numberOfValidFields von 7 benötigten Feldern.<br>";
    }
    if ($numberOfValidFields == 7) {
        //echo "Passport is valid!<br>";
        $validPassports++;
    }
    //echo "<br>";
}

echo "Valid Passports: $validPassports";
<?php
$path="input";
$lines=file($path);
$passports;
$validPassports = 0;
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
        list($fieldname, $fieldvalue) = explode(":", $field);
        $fieldvalue = trim($fieldvalue);
        echo "Feldname: $fieldname und Feldwert: $fieldvalue";
        if ($fieldname == "byr") {
            if ((1920 <= $fieldvalue) && ($fieldvalue <= 2002)) {
                $numberOfValidFields++;
            }
        } else if ($fieldname == "iyr") {
            if ((2010 <= $fieldvalue) && ($fieldvalue <= 2020)) {
                $numberOfValidFields++;
            }
        } else if ($fieldname == "eyr") {
            if ((2020 <= $fieldvalue) && ($fieldvalue <= 2030)) {
                $numberOfValidFields++;
            }
        } else if ($fieldname == "hgt") {
            if (endsWith($fieldvalue, "cm")) {
                $number = str_replace("cm","",$fieldvalue); //Nummer vor der Einheit
                if ((150 <= $number) && ($number <= 193)) {
                    $numberOfValidFields++;
                }
            } else if (endsWith($fieldvalue, "in")) {
                $number = str_replace("in","",$fieldvalue); //Nummer vor der Einheit
                if ((59 <= $number) && ($number <= 76)) {
                    $numberOfValidFields++;
                }
            }
        } else if ($fieldname == "hcl") {
            if (startsWith($fieldvalue, "#")) {
                $number = str_replace("#","",$fieldvalue); //Farbecode hinter #
                if (strlen($number) == 6) {
                    $numberArray = str_split($number);
                    $numberOfValidDigits = 0;
                    foreach ($numberArray as $digit) {
                        if ($digit=="0" || $digit=="1" || $digit=="2" || $digit=="3" || $digit=="4" || $digit=="5" || $digit=="6" || $digit=="7" || $digit=="8" || $digit=="9" || $digit=="a" || $digit=="b" || $digit=="c" || $digit=="d" || $digit=="e" || $digit=="f") {
                            $numberOfValidDigits++;
                        }
                    }
                    if ($numberOfValidDigits == 6) {
                        $numberOfValidFields++;
                    }
                }
            }
        } else if ($fieldname == "ecl") {
            if ($fieldvalue=="amb" || $fieldvalue=="blu" || $fieldvalue=="brn" || $fieldvalue=="gry" || $fieldvalue=="grn" || $fieldvalue=="hzl" || $fieldvalue=="oth") {
                $numberOfValidFields++;
            }
        } else if ($fieldname == "pid") {
            if ((strlen($fieldvalue) == 9)) {
                $numberOfValidFields++;
            }
        }
        echo ". Jetzt sind wir bei $numberOfValidFields von 7 benötigten Feldern.<br>";
    }
    if ($numberOfValidFields == 7) {
        echo "Passport is valid!<br>";
        $validPassports++;
    }
    echo "<br>";
}

echo "Valid Passports: $validPassports";

function startsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}
function endsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

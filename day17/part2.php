<?php
$path="input";
$lines=file($path);

$coords; //Vierdimensionales Array mit x, y, z, w   = array(array(array(array())))
$neighborPos = array(   array(-1,-1,-1, -1), array( 0,-1,-1, -1), array( 1,-1,-1, -1),
                        array(-1, 0,-1, -1), array( 0, 0,-1, -1), array( 1, 0,-1, -1),
                        array(-1, 1,-1, -1), array( 0, 1,-1, -1), array( 1, 1,-1, -1),
                        array(-1,-1, 0, -1), array( 0,-1, 0, -1), array( 1,-1, 0, -1),
                        array(-1, 0, 0, -1), array( 0, 0, 0, -1), array( 1, 0, 0, -1),
                        array(-1, 1, 0, -1), array( 0, 1, 0, -1), array( 1, 1, 0, -1),
                        array(-1,-1, 1, -1), array( 0,-1, 1, -1), array( 1,-1, 1, -1),
                        array(-1, 0, 1, -1), array( 0, 0, 1, -1), array( 1, 0, 1, -1),
                        array(-1, 1, 1, -1), array( 0, 1, 1, -1), array( 1, 1, 1, -1),
                    
                        array(-1,-1,-1,  0), array( 0,-1,-1,  0), array( 1,-1,-1,  0),
                        array(-1, 0,-1,  0), array( 0, 0,-1,  0), array( 1, 0,-1,  0),
                        array(-1, 1,-1,  0), array( 0, 1,-1,  0), array( 1, 1,-1,  0),
                        array(-1,-1, 0,  0), array( 0,-1, 0,  0), array( 1,-1, 0,  0),
                        array(-1, 0, 0,  0),                      array( 1, 0, 0,  0),
                        array(-1, 1, 0,  0), array( 0, 1, 0,  0), array( 1, 1, 0,  0),
                        array(-1,-1, 1,  0), array( 0,-1, 1,  0), array( 1,-1, 1,  0),
                        array(-1, 0, 1,  0), array( 0, 0, 1,  0), array( 1, 0, 1,  0),
                        array(-1, 1, 1,  0), array( 0, 1, 1,  0), array( 1, 1, 1,  0),
                    
                        array(-1,-1,-1, +1), array( 0,-1,-1, +1), array( 1,-1,-1, +1),
                        array(-1, 0,-1, +1), array( 0, 0,-1, +1), array( 1, 0,-1, +1),
                        array(-1, 1,-1, +1), array( 0, 1,-1, +1), array( 1, 1,-1, +1),
                        array(-1,-1, 0, +1), array( 0,-1, 0, +1), array( 1,-1, 0, +1),
                        array(-1, 0, 0, +1), array( 0, 0, 0, +1), array( 1, 0, 0, +1),
                        array(-1, 1, 0, +1), array( 0, 1, 0, +1), array( 1, 1, 0, +1),
                        array(-1,-1, 1, +1), array( 0,-1, 1, +1), array( 1,-1, 1, +1),
                        array(-1, 0, 1, +1), array( 0, 0, 1, +1), array( 1, 0, 1, +1),
                        array(-1, 1, 1, +1), array( 0, 1, 1, +1), array( 1, 1, 1, +1));
$active=0;

for($y=0; $y<count($lines); $y++) {
    $line = trim($lines[$y]);
    $cubes = str_split($line);
    for($x=0; $x<count($cubes); $x++) {
        $coords[$x][$y][0][0] = $cubes[$x];
    }
}

for ($x=min(array_keys($coords)); $x<=max(array_keys($coords)); $x++) {
    for($y=min(array_keys($coords[$x])); $y<=max(array_keys($coords[$x])); $y++) {
        for ($z=min(array_keys($coords[$x][$y])); $z<=max(array_keys($coords[$x][$y])); $z++) {
            for ($w=min(array_keys($coords[$x][$y][$z])); $w<=max(array_keys($coords[$x][$y][$z])); $w++) {
                //echo "x=$x y=$y z=$z w=$w: " . $coords[$x][$y][$z][$w] . "<br>";
            }
        }
    }
}
//echo "Das bis hier hat den ersten eingelesenen Status zurückgegeben<br>------------------------------------------------------------------------------------------<br>";

for($i=0; $i<6; $i++) {
    //echo "Circle Number: " . ($i+1) . "<br>";
    $active=0;
    $nextCoords = $coords;

    /**
     * Berechne die höchsten Keys
     */

    $maxKeysX = array();
    $maxKeysY = array();
    $maxKeysZ = array();
    $maxKeysW = array();
    
    $curMaxKeyX = max(array_keys($coords))+1;
    $maxKeysX[count($maxKeysX)] = $curMaxKeyX;
    for($x=min(array_keys($coords))-1; $x<=$curMaxKeyX; $x++) {
        if (isset($coords[$x])) {} else {
            $coords[$x] = array(array(array()));
        }
        $curMaxKeyY = max(array_keys($coords[$x]))+1;
        $maxKeysY[count($maxKeysY)] = $curMaxKeyY;
        for($y=min(array_keys($coords[$x]))-1; $y<=$curMaxKeyY; $y++) {
            if (isset($coords[$x][$y])) {} else {
                $coords[$x][$y] = array(array());
            }
            $curMaxKeyZ = max(array_keys($coords[$x][$y]))+1;
            $maxKeysZ[count($maxKeysZ)] = $curMaxKeyZ;
            for($z=min(array_keys($coords[$x][$y]))-1; $z<=$curMaxKeyZ; $z++) {
                if (isset($coords[$x][$y][$z])) {} else {
                    $coords[$x][$y][$z] = array();
                }
                $curMaxKeyW = max(array_keys($coords[$x][$y][$z]))+1;
                $maxKeysW[count($maxKeysW)] = $curMaxKeyW;
                for($w=min(array_keys($coords[$x][$y][$z]))-1; $w<=$curMaxKeyW; $w++) {
                    if (isset($coords[$x][$y][$z][$w])) {} else {
                        $coords[$x][$y][$z][$w] = ".";                        
                    }
                }
            }
        }
    }

    $maxKeyX = max($maxKeysX);
    $maxKeyY = max($maxKeysY);
    $maxKeyZ = max($maxKeysZ);
    $maxKeyW = max($maxKeysW);
    //echo "MAX KEY X: $maxKeyX<br>";
    //echo "MAX KEY Y: $maxKeyY<br>";
    //echo "MAX KEY Z: $maxKeyZ<br>";
    //echo "MAX KEY W: $maxKeyW<br>";


    /**
     * Berechne die biedrigsten Keys
     */

    $minKeysX = array();
    $minKeysY = array();
    $minKeysZ = array();
    $minKeysW = array();
    
    $curMinKeyX = min(array_keys($coords))-1;
    $minKeysX[count($minKeysX)] = $curMinKeyX;
    for($x=min(array_keys($coords))-1; $x<=$maxKeyX; $x++) {
        if (isset($coords[$x])) {} else {
            $coords[$x] = array(array(array()));
        }
        $curMinKeyY = min(array_keys($coords[$x]))-1;
        $minKeysY[count($minKeysY)] = $curMinKeyY;
        for($y=min(array_keys($coords[$x]))-1; $y<=$maxKeyY; $y++) {
            if (isset($coords[$x][$y])) {} else {
                $coords[$x][$y] = array(array());
            }
            $curMinKeyZ = min(array_keys($coords[$x][$y]))-1;
            $minKeysZ[count($minKeysZ)] = $curMinKeyZ;
            for($z=min(array_keys($coords[$x][$y]))-1; $z<=$maxKeyZ; $z++) {
                if (isset($coords[$x][$y][$z])) {} else {
                    $coords[$x][$y][$z] = array();
                }
                $curMinKeyW = min(array_keys($coords[$x][$y][$z]))-1;
                $minKeysW[count($minKeysW)] = $curMinKeyW;
                for($w=min(array_keys($coords[$x][$y][$z]))-1; $w<=$maxKeyW; $w++) {
                    if (isset($coords[$x][$y][$z][$w])) {} else {
                        $coords[$x][$y][$z][$w] = ".";
                    }
                }
            }
        }
    }

    $minKeyX = min($minKeysX);
    $minKeyY = min($minKeysY);
    $minKeyZ = min($minKeysZ);
    $minKeyW = min($minKeysW);
    //echo "MIN KEY X: $minKeyX<br>";
    //echo "MIN KEY Y: $minKeyY<br>";
    //echo "MIN KEY Z: $minKeyZ<br>";
    //echo "MIN KEY W: $minKeyW<br>";


    for($x=$minKeyX; $x<=$maxKeyX; $x++) {
        //echo min(array_keys($coords)) . "<br>";
        //echo "Aktueller X-Wert:$x<br>";
        if (isset($coords[$x])) {
            //echo "Dieser Wert ist auch im Array vorhanden<br>";
        } else {
            $coords[$x] = array(array(array()));
        }
        for($y=$minKeyY; $y<=$maxKeyY; $y++) {
            //echo "Aktueller Y-Wert:$y<br>";
            if (isset($coords[$x][$y])) {
                //echo "Dieser Wert ist auch im Array vorhanden<br>";
            } else {
                $coords[$x][$y] = array(array());
            }
            for($z=$minKeyZ; $z<=$maxKeyZ; $z++) {
                //echo "Aktueller Z-Wert:$z<br>";
                if (isset($coords[$x][$y][$z])) {
                    //echo "Dieser Wert ist auch im Array vorhanden<br>";
                } else {
                    $coords[$x][$y][$z] = array();
                }
                for($w=$minKeyW; $w<=$maxKeyW; $w++) {
                    //echo "Aktueller W-Wert:$w<br>";
                    if (isset($coords[$x][$y][$z][$w])) {
                        //echo "Dieser Wert ist auch im Array vorhanden<br>";
                    } else {
                        $coords[$x][$y][$z][$w] = ".";
                    }


                    //echo "x=$x, y=$y, z=$z, w=$w<br>";
                    $cube = $coords[$x][$y][$z][$w];
                    $activeNeighbors = 0;
                    foreach($neighborPos as $pos) {
                        if (checkNeighbor($coords, $x, $y, $z, $w, $pos[0],$pos[1],$pos[2],$pos[3])) {
                            //echo "neighbor bei $x $y $z $w für " . $pos[0] . " " . $pos[1] . " " . $pos[2] . " " . $pos[3] . " ist aktiv<br>";
                            $activeNeighbors++;
                        }
                    }
                    if ($cube == "#") {
                        //echo "cube ist #<br>";
                        if (!($activeNeighbors == 2 || $activeNeighbors == 3)) {
                            //echo "Ja ich werde geändert!! ABER ich werde inaktiv<br>";
                            //echo "$x $y $z $w betroffen<br>";
                            $nextCoords[$x][$y][$z][$w] = ".";
                        }
                    } else if ($cube == ".") {
                        //echo "......................<br>";
                        if ($activeNeighbors == 3) {
                            //echo "ICH werde aktiv<br>";
                            //echo "$x $y $z $w betroffen<br>";
                            $nextCoords[$x][$y][$z][$w] = "#";
                        }
                    } else {
                        echo "ALARM ALARM ALARM!!!<br>";
                    }
                    //echo "<br>";

                }
            }
        }
    }
    $coords = $nextCoords;

    for ($x=min(array_keys($coords)); $x<=max(array_keys($coords)); $x++) {
        for($y=min(array_keys($coords[$x])); $y<=max(array_keys($coords[$x])); $y++) {
            for ($z=min(array_keys($coords[$x][$y])); $z<=max(array_keys($coords[$x][$y])); $z++) {
                for ($w=min(array_keys($coords[$x][$y][$z])); $w<=max(array_keys($coords[$x][$y][$z])); $w++) {
                    //echo "x=$x y=$y z=$z w=$w: " . $coords[$x][$y][$z][$w] . "<br>";
                }
            }
        }
    }

    //echo "Got ONE Cylce<br>--------------------------------------------------------------------------------------<br><br><br><br><br>";
}

//print_r($coords); echo "<br>";

foreach($coords as $curX) {
    foreach($curX as $curY) {
        foreach($curY as $curZ) {
            foreach($curZ as $w) {
                if ($w == "#") {
                    $active++;
                }
            }
        }
    }
}

echo "There are $active cubes<br>";

function checkNeighbor($currentCoords, $x, $y, $z, $w, $offsetX, $offsetY, $offsetZ, $offsetW) {
    if (!isset($currentCoords[$x+$offsetX][$y+$offsetY][$z+$offsetZ][$w+$offsetW]) || $currentCoords[$x+$offsetX][$y+$offsetY][$z+$offsetZ][$w+$offsetW] == ".") {
        return false;
    } else {
        return true;
    }
}

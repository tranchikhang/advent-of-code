<?php

$x = 1;
$current = 1;

$crtLength = 240;
$crtRowLength = 40;

function setupCrt($crtLength, $crtRowLength) {
    $crt = [];
    for ($i=0; $i<$crtLength ; $i++) {
        $crt[$i] = 0;
    }
    return $crt;
}

function drawCrt($crt, $crtLength, $crtRowLength) {
    for ($i=0; $i<$crtLength ; $i++) {
        if ($crt[$i]==1) {
            echo "#";
        } else {
            echo ".";
        }
        if ($i && (($i+1)%$crtRowLength)==0) {
            echo "<br>";
        }
    }
    echo "<br>";
}

$crt = setupCrt($crtLength, $crtRowLength);

function checkCrt($x, $current) {
    $row = floor($current/40);
    $crtPos = ($current%40)-1;
    global $crt;
    if($crtPos==$x-1 || $crtPos==$x || $crtPos==$x+1) {
        $crt[$row*40+$crtPos] = 1;
    }
}

function echoString($string) {
    print_r($string);
    echo '<br>';
}

$total = 0;

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));
        $arr = explode(" ", $line);
        checkCrt($x, $current);

        $current++;
        if ($arr[0]=='addx') {
            checkCrt($x, $current);
            $current++;
            $x += $arr[1];
        }

    }
    fclose($file);
}

drawCrt($crt, $crtLength, $crtRowLength);
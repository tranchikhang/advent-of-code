<?php

$map = [];
$val = [];
$cnt=0;

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));
        $arr = str_split($line);
        $val[$cnt] = [];
        $map[] = $arr;
        for ($i=0; $i < count($arr) ; $i++) {
            $val[$cnt][] = 0;
        }
        $cnt++;
    }
    fclose($file);
}

$total = 0;

// check left and right
for ($i=0; $i < count($map) ; $i++) {
    $maxLeft = $map[$i][0];
    $maxRight = $map[$i][count($map[$i])-1];
    for ($j=0; $j < count($map[0]) ; $j++) {
        if ($i==0 || $j==0 || $i==count($map)-1 || $j==count($map[0])-1) {
            continue;
        }
        if ($map[$i][$j]>$maxLeft) {
            $val[$i][$j] = 1;
            $maxLeft = $map[$i][$j];
        }

        $rightColumn = count($map[0]) -1 -$j;
        if ($map[$i][$rightColumn]>$maxRight) {
            $val[$i][$rightColumn] = 1;
            $maxRight = $map[$i][$rightColumn];
        }
    }
}

// check top and down
for ($i=0; $i < count($map[0]) ; $i++) {
    $maxTop = $map[0][$i];
    $maxBottom = $map[count($map)-1][$i];
    for ($j=0; $j < count($map) ; $j++) {
        if ($i==0 || $j==0 || $i==count($map[0])-1 || $j==count($map)-1) {
            continue;
        }
        if ($map[$j][$i]>$maxTop) {
            $val[$j][$i] = 1;
            $maxTop = $map[$j][$i];
        }

        $bottom = count($map) -1 -$j;
        if ($map[$bottom][$i]>$maxBottom) {
            $val[$bottom][$i] = 1;
            $maxBottom = $map[$bottom][$i];
        }
    }
}



for ($i=0; $i < count($map) ; $i++) {
    for ($j=0; $j < count($map[0]) ; $j++) {
        if ($val[$i][$j]==1) {
           $total += 1;
       }
   }
}
print_r($total + count($map)*2 + (count($map[0])-2)*2);
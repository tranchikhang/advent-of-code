<?php

$map = [];
$val = [];
$cnt=0;

$scenicView = [];

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));
        $arr = str_split($line);
        $val[$cnt] = [];
        $scenicView[$cnt] = [];
        $map[] = $arr;
        for ($i=0; $i < count($arr) ; $i++) {
            $val[$cnt][] = 1;
            $scenicView[$cnt][] = [
                'left' => 0,
                'right' => 0,
                'top' => 0,
                'bottom' => 0
            ];
        }
        $cnt++;
    }
    fclose($file);
}

function countView($x, $y, $map) {
    $leftView = 0;
    for ($i=$y-1; $i >= 0 ; $i--) {
        if ($map[$x][$i]<$map[$x][$y]) {
            $leftView+=1;
        } else {
            $leftView+=1;
            break;
        }
    }
    $rightView = 0;
    for ($i=$y+1; $i < count($map[0]) ; $i++) {
        if ($map[$x][$i]<$map[$x][$y]) {
            $rightView+=1;
        } else {
            $rightView+=1;
            break;
        }
    }
    $topView = 0;
    for ($j=$x-1; $j >= 0 ; $j--) {
        if ($map[$j][$y]<$map[$x][$y]) {
            $topView+=1;
        } else {
            $topView+=1;
            break;
        }
    }
    $bottomView = 0;
    for ($j=$x+1; $j < count($map) ; $j++) {
        if ($map[$j][$y]<$map[$x][$y]) {
            $bottomView+=1;
        } else {
            $bottomView+=1;
            break;
        }
    }
    return [
                'left' => $leftView,
                'right' => $rightView,
                'top' => $topView,
                'bottom' => $bottomView
            ];
}

// check left and right
for ($i=1; $i < count($map)-1 ; $i++) {
    for ($j=1; $j < count($map[0])-1 ; $j++) {
        $result = countView($i, $j, $map);
        $scenicView[$i][$j]['left']=$result['left'];
        $scenicView[$i][$j]['right']=$result['right'];
        $scenicView[$i][$j]['top']=$result['top'];
        $scenicView[$i][$j]['bottom']=$result['bottom'];
    }
}


$total = 0;

for ($i=0; $i < count($map) ; $i++) {
    for ($j=0; $j < count($map[0]) ; $j++) {
        $val[$i][$j] = $val[$i][$j]*$scenicView[$i][$j]['left']*$scenicView[$i][$j]['right']*$scenicView[$i][$j]['top']*$scenicView[$i][$j]['bottom'];
        if ($val[$i][$j]>$total) {
            $total = $val[$i][$j];
        }
   }
}
print_r($total);
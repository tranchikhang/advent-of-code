<?php

$elves = [];
$pos=0;
$total = [];

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $textperline = trim(fgets($file));
        if ($textperline == "") {
            $total[] = $elves[$pos];
            $pos += 1;
            continue;
        }
        $val = intval($textperline);
        if (array_key_exists($pos, $elves)) {
            $elves[$pos] += $val;
        } else {
            $elves[$pos] = $val;
        }

     }
    fclose($file);
}
rsort($total);
echo $total[0] + $total[1] + $total[2];
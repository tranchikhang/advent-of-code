<?php

$elves = [];
$max = 0;
$pos=0;

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $textperline = trim(fgets($file));
        if ($textperline == "") {
            if ($elves[$pos]>=$max) {
                $max = $elves[$pos];
            }
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
echo $max;
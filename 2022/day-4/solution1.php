<?php

$total = 0;

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));
        $arr = explode(',', $line);

        $first = explode("-", $arr[0]);
        $second = explode("-", $arr[1]);

        if (($first[0] <= $second[0] && $first[1] >= $second[1]) ||
            $first[0] >= $second[0] && $first[1] <= $second[1]) {
            $total +=1;
        }


     }
    fclose($file);
}
echo $total;
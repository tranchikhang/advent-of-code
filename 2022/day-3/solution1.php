<?php

$total = 0;

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $map = [];
        $duplicate = [];
        $line = trim(fgets($file));
        $len = strlen($line)/2;

        $first = substr($line, 0, $len);
        for ($i=0 ; $i<strlen($first) ; $i++) {
            $key = strval(ord($first[$i]));
            if (array_key_exists($key, $map)) {
                $map[$key] += 1;
            } else {
                $map[$key] = 1;
            }
        }


        $second = substr($line, $len, $len);
        for ($i=0 ; $i<strlen($second) ; $i++) {
            $key = strval(ord($second[$i]));
            if (array_key_exists($key, $map)) {
                $duplicate[] = $second[$i];
            }
        }

        $duplicate = array_unique($duplicate);
        foreach ($duplicate as $val) {
            if (intval(ord($val)) >= 97) {
                $total += intval(ord($val)) - 97 + 1;
            } else {
                $total += intval(ord($val)) - 65 + 27;
            }
        }


     }
    fclose($file);
}
echo $total;
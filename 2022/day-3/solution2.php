<?php

$total = 0;
$groupMax = 3;
$lineCount = 0;
$map = [];

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {

        $line = trim(fgets($file));
        $len = strlen($line);
        $line = str_split($line);
        $line = array_values(array_unique($line));
        for ($i=0 ; $i<count($line) ; $i++) {
            $key = $line[$i];
            if (array_key_exists($key, $map)) {
                $map[$key] += 1;
            } else {
                $map[$key] = 1;
            }
        }
        foreach ($map as $key => $val) {
            if ($val==3) {
                if (intval(ord($key)) >= 97) {
                    $total += intval(ord($key)) - 97 + 1;
                } else {
                    $total += intval(ord($key)) - 65 + 27;
                }
            }
        }
        $lineCount += 1;
        if ($lineCount == 3) {
            $lineCount = 0;
            $map = [];
        }


     }
    fclose($file);
}
echo $total;
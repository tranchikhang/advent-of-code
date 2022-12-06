<?php

$result = 0;


if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = fgets($file);

        $map = [];
        $map[$line[0]] = 1;
        $map[$line[1]] = 1;
        $map[$line[2]] = 1;

        // loop through line
        for ($i=3 ; $i<strlen($line) ; $i++) {
            $map = [];
            $map[$line[$i-3]] = 1;
            if (array_key_exists($line[$i-2], $map)) {
                continue;
            }
            $map[$line[$i-2]] = 1;
            if (array_key_exists($line[$i-1], $map)) {
                continue;
            }
            $map[$line[$i-1]] = 1;
            if (!array_key_exists($line[$i], $map)) {
                $result = $i;
                break;
            }
        }
     }
    fclose($file);
}


echo $result + 1;
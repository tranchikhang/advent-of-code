<?php

$result = 0;


if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = fgets($file);

        $map = [];
        for ($i=13 ; $i<strlen($line) ; $i++) {
            $map = [];
            $flg = false;
            for ($j=0 ; $j<14 ; $j++) {
                if (array_key_exists($line[$i-$j], $map)) {
                    $flg=true;
                }
                $map[$line[$i-$j]] = 1;
            }
            if ($flg) {
                continue;
            } else {
                $result = $i;
                break;
            }
        }
     }
    fclose($file);
}


echo $result + 1;
<?php

$ls = true;
$currentPath = '/';
$pathValMap= [];

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));

        if ($line[0]=='$') {
            $ls = false;
            $arr = explode(" ", $line);
            if ($arr[1]=='cd') {
                // cd logic
                if ($arr[2] == '/') {
                    // move to root, do nothing
                } elseif ($arr[2] == "..") {
                    // current size
                    $c = $pathValMap[$currentPath];
                    //go up
                    $a = explode("/", $currentPath);
                    $b = array_pop($a);
                    $b = array_pop($a);
                    $currentPath = implode("/", $a);
                    $currentPath .= '/';

                    // add to parent
                    if (array_key_exists($currentPath, $pathValMap)) {
                        $pathValMap[$currentPath] += $c;
                    } else {
                        $pathValMap[$currentPath] = $c;
                    }
                } else {
                    // cd to folder => add to path
                    $currentPath .= $arr[2] . '/';
                }
            } else {
                // ls logic
                $ls = true;
            }
        } elseif ($ls) {
            // read list from ls
            $arr = explode(' ', $line);
            if ($arr[0]!='dir') {
                // add file
                // add value
                if (array_key_exists($currentPath, $pathValMap)) {
                    $pathValMap[$currentPath] += $arr[0];
                } else {
                    $pathValMap[$currentPath] = $arr[0];
                }
            }
        }
    }
    fclose($file);
}

$total = 0;
foreach ($pathValMap as $key => $value) {
    if ($key!='/' && $value<=100000) {
        $total += $value;
    }
}
echo $total;
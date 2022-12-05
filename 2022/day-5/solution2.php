<?php

$result = '';
$lineCount = 0;
$maxLine = 8;
$crate = [];
$crateArr = [];
$maxCrate = 9;


$operation = [];

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = fgets($file);

        // read stack lines
        if ($lineCount<$maxLine) {
            // echo $line . PHP_EOL;
            $crate[$lineCount] = [];

            // get each crate
            for ($i=0 ; $i<$maxCrate ; $i++) {
                // 1 5 9 13
                // echo $line[$i*4+1] . PHP_EOL;
                $crate[$lineCount][] = $line[$i*4+1];
            }

        } elseif ($lineCount>=10) {
            $arr = explode(" ", trim($line));
            $operation[] = [
                'number' => $arr[1],
                'from' => $arr[3],
                'to' => $arr[5]
            ];
        }
        $lineCount++;
     }
    fclose($file);
}

// loop through each crate, total 9 crates
for ($j=0 ; $j<$maxCrate ; $j++) {
    // for each create
    $crateArr[$j] = [];
    for ($i=$maxLine-1 ; $i>=0 ; $i--) {
        if (!empty(trim($crate[$i][$j]))) {
            $crateArr[$j][] = $crate[$i][$j];
        }
    }
}

foreach ($operation as $o) {
    $temp = [];
    $from = $o['from'] - 1;
    $to = $o['to'] - 1;

    for ($i=0 ; $i<$o['number'] ; $i++) {
        // move elements
        if (count($crateArr[$from])==0) {
            continue;
        }
        $eleToMove = $crateArr[$from][count($crateArr[$from])-1];
        // echo "eleToMove=" . $eleToMove;
        // echo "<br>";
        // add
        $temp[] = $eleToMove;
        // remove
        unset($crateArr[$from][count($crateArr[$from])-1]);
        $crateArr[$from] = array_values($crateArr[$from]);
    }
    $crateArr[$to] = array_merge($crateArr[$to], array_reverse($temp));

}



// loop through each crate, total 9 crates
for ($i=0 ; $i<$maxCrate ; $i++) {
    if (count($crateArr[$i])==0) {
        continue;
    }
    $result .= $crateArr[$i][count($crateArr[$i])-1];
}

echo $result;
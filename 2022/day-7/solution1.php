<?php

$folderTree = [];
$currentFolder = null;
$level = 1;
$pointer = [];
$pointer = ['parent' => '/', 'files' => []];
$temp = [];

$list = [['level' => -1, 'parent' => '/', 'name' => 'root']];
$parent = 0;
$idx = 0;
// folder name => index map
$folderMap = ['root' => 0];

// flag to determine if current command is ls or not
$ls = false;

$currentPath = '/';
$pathValMap= [];

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));
        print_r('Command: ' . $line);
        echo '<br>----------<br>';

        if ($line[0]=='$') {
            $ls = false;
            $arr = explode(" ", $line);
            if ($arr[1]=='cd') {
                // cd logic
                if ($arr[2] == '/') {
                    $pointer = $folderTree;
                } elseif ($arr[2] == "..") {
                    print_r('..');
                    echo '<br>';
                    $level--;

                    // current size
                    $c = $pathValMap[$currentPath];
                    //go up
                    $a = explode("/", $currentPath);
                    $b = array_pop($a);
                    $b = array_pop($a);
                    $currentPath = implode("/", $a);
                    $currentPath .= '/';

                    // add to parent
                     $pathValMap[$currentPath] += $c;
                } else {
                    // cd to folder
                    print_r('cd to ' . $arr[2]);
                    echo '<br>';
                    $parent = $folderMap[$arr[2]];
                    $level++;

                    // add to path
                    $currentPath .= $arr[2] . '/';
                }
            } else {
                // ls logic
                $ls = true;
            }
        } elseif ($ls) {
            // read list from ls
            $arr = explode(' ', $line);
            $temp = $pointer;
            if ($arr[0]=='dir') {
                // add directory
                print_r('directory ' . $arr[1]);
                echo '<br>';
                $list[] = [
                    'name' => $arr[1],
                    'type' => 'folder',
                    'parent' => $parent,
                    'level' => $level
                ];
                $folderMap[$arr[1]] = count($list)-1;
                // s
            } else {
                // add file
                $list[] = [
                    'name' => $arr[1],
                    'type' => 'file',
                    'parent' => $parent,
                    'level' => $level,
                    'size' => $arr[0]
                ];
                // add value
                if (array_key_exists($currentPath, $pathValMap)) {
                    $pathValMap[$currentPath] += $arr[0];
                } else {
                    $pathValMap[$currentPath] = $arr[0];
                }
            }
            // $pointer = $temp;
        }

//         echo '<br>************<br><pre>';
// print_r($pointer);
// echo '</pre><br>************<br>';
    }
    fclose($file);
}


// print_r($pointer);
echo '<br>************<br><pre>';
print_r($list);
echo '</pre><br>************<br>';

// folder name => size map
$sum = ['root' => 0];
for ($i=1; $i < count($list) ; $i++) {
    $folderName = $list[$i]['name'];
    if ($list[$i]['type'] == 'folder') {
        // print_r('current folder');
        // echo '<br>';
        // print_r($list[$i]);
        // echo '<br>';
        if (!array_key_exists($list[$i]['name'], $sum)) {
            $sum[$folderName] = 0;
        }
        for ($j=$i+1; $j < count($list) ; $j++) {
            if ($list[$j]['type'] == 'file' && $list[$j]['parent']==$i) {
                // print_r('current file');
                // echo '<br>';
                // print_r($list[$j]);
                // echo '<br>';
                $sum[$folderName] += $list[$j]['size'];
            }
        }
        // get parent name

        $parentName = $list[$list[$i]['parent']]['name'];
        $sum[$parentName] += $sum[$folderName];
    }
}
echo '<br>************<br><pre>';
print_r($sum);
echo '</pre><br>************<br>';


$total = 0;
foreach ($sum as $key => $value) {
    if ($key!='root' && $value<=100000) {
        $total += $value;
    }
}
echo $total;


// print_r($pointer);
echo '<br>************<br><pre>';
print_r($pathValMap);
echo '</pre><br>************<br>';


$total = 0;
foreach ($pathValMap as $key => $value) {
    if ($key!='/' && $value<=100000) {
        $total += $value;
    }
}
echo $total;
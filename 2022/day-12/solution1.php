<?php

$start = [];
$end = [];
$map = [];
$endChar = 'E';
$startChar = 'S';
$surroundingTile = [[
            'x'=> 0,
            'y'=> -1
        ], [
            'x'=> 1,
            'y'=> 0
        ], [
            'x'=> 0,
            'y'=> 1
        ], [
            'x'=> -1,
            'y'=> 0
        ]];

class Position
{
    public $x;
    public $y;
    public $parentX;
    public $parentY;
    public $parent;
    function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}


function calculateMahattan($start, $end) {
    return abs($start->x - $end->x) + abs($start->y - $end->y);
}

function calculateShortest($start, $end) {
    return sqrt(pow(($end->x - $start->x), 2) + pow(($end->y - $start->y), 2));
}

function calculateHeight($elevation) {
    return abs(ord('z') - $elevation);
}

function bfs($map, $start, $end) {
    global $surroundingTile;
    global $endChar;
    global $startChar;
    $visited = [];
    $queue = [];
    $queue[] = $start;
    // 2d array to store visited position
    $visited = [];
    for ($y = 0; $y < count($map); $y++) {
        $row = [];
        for ($x = 0; $x < count($map[0]); $x++) {
            $row[] = 0;
        }
        $visited[] = $row;
    }
    $visited[$start->y][$start->x] = 1;
    while (count($queue)!=0) {
        // Get current position
        $currentPos = $queue[0];
        array_shift($queue);

        // Explore surrounding
        for ($i = 0; $i < count($surroundingTile); $i++) {
            $newPos = new Position($currentPos->x + $surroundingTile[$i]['x'], $currentPos->y + $surroundingTile[$i]['y']);

            // check valid
            if ($newPos->x<0 || $newPos->x >= count($map[0]) || $newPos->y<0 || $newPos->y >= count($map)) {
                continue;
            }

            // elevation check
            if ($map[$currentPos->y][$currentPos->x] == $startChar) {
                $currentElevation = ord('a');
            } else {
                $currentElevation = ord($map[$currentPos->y][$currentPos->x]);
            }
            if ($map[$newPos->y][$newPos->x] == $endChar) {
                $nextElevation = ord('z');
            } else {
                $nextElevation = ord($map[$newPos->y][$newPos->x]);
            }

            if ($newPos->x == $end->x && $newPos->y == $end->y && $nextElevation - $currentElevation < 2) {
                // Found end position, get full path from start to end
                $newPos->parentX = $currentPos->x;
                $newPos->parentY = $currentPos->y;
                $newPos->parent = $currentPos;
                return traceback($start, $newPos);
            } else {
                if ($nextElevation - $currentElevation < 2) {
                    // if current position is movable
                    if ($visited[$newPos->y][$newPos->x]==0) {
                        $newPos->parentX = $currentPos->x;
                        $newPos->parentY = $currentPos->y;
                        $newPos->parent = $currentPos;
                        $queue[] = $newPos;
                        $visited[$newPos->y][$newPos->x] = 1;
                    }
                }
            }
        }
    }
}


function traceback($start, $end) {
    $path = [$end];
    while (($path[count($path) - 1])->parent != null) {
        $path[] = ($path[count($path) - 1])->parent;
    }
    $path = array_reverse($path);
    return $path;
}


$lineCount = 0;
if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));
        $map[] = str_split($line);

        foreach ($map[$lineCount] as $char) {
            if ($char==$startChar) {
                $start = new Position(strpos($line, $char), $lineCount);
            } elseif ($char==$endChar) {
                $end = new Position(strpos($line, $char), $lineCount);
            }
        }
        $lineCount++;


    }
    fclose($file);
}

$result = bfs($map, $start, $end);
echo count($result) -1;
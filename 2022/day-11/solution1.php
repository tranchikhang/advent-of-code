<?php

class Monkey {
    public $items;
    public $testValue;
    public $firstTarget;
    public $secondTarget;
    public $count=0;

    function test($idx, $item) {
        $newVal = 0;
        switch ($idx) {
            case 0:
                $newVal = $item*17;
                break;
            case 1:
                $newVal = $item+8;
                break;
            case 2:
                $newVal = $item+6;
                break;
            case 3:
                $newVal = $item*19;
                break;
            case 4:
                $newVal = $item+7;
                break;
            case 5:
                $newVal = $item*$item;
                break;
            case 6:
                $newVal = $item+1;
                break;
            case 7:
                $newVal = $item+2;
                break;
        }
        $newVal = floor($newVal/3);
        $this->count +=1;
        if ($newVal%$this->testValue==0) {
            return ['target' => $this->firstTarget, 'item' => $newVal];
        }
        return ['target' => $this->secondTarget, 'item' => $newVal];
    }
}


$monkey0 = new Monkey();
$monkey0->items = [52, 60, 85, 69, 75, 75];
$monkey0->testValue = 13;
$monkey0->firstTarget = 6;
$monkey0->secondTarget = 7;


$monkey1 = new Monkey();
$monkey1->items = [96, 82, 61, 99, 82, 84, 85];
$monkey1->testValue = 7;
$monkey1->firstTarget = 0;
$monkey1->secondTarget = 7;

$monkey2 = new Monkey();
$monkey2->items = [95, 79];
$monkey2->testValue = 19;
$monkey2->firstTarget = 5;
$monkey2->secondTarget = 3;

$monkey3 = new Monkey();
$monkey3->items = [88, 50, 82, 65, 77];
$monkey3->testValue = 2;
$monkey3->firstTarget = 4;
$monkey3->secondTarget = 1;

$monkey4 = new Monkey();
$monkey4->items = [66, 90, 59, 90, 87, 63, 53, 88];
$monkey4->testValue = 5;
$monkey4->firstTarget = 1;
$monkey4->secondTarget = 0;

$monkey5 = new Monkey();
$monkey5->items = [92, 75, 62];
$monkey5->testValue = 3;
$monkey5->firstTarget = 3;
$monkey5->secondTarget = 4;

$monkey6 = new Monkey();
$monkey6->items = [94, 86, 76, 67];
$monkey6->testValue = 11;
$monkey6->firstTarget = 5;
$monkey6->secondTarget = 2;

$monkey7 = new Monkey();
$monkey7->items = [57];
$monkey7->testValue = 17;
$monkey7->firstTarget = 6;
$monkey7->secondTarget = 2;

$monkeys = [
    $monkey0,
    $monkey1,
    $monkey2,
    $monkey3,
    $monkey4,
    $monkey5,
    $monkey6,
    $monkey7
];

function printArr($arr) {
    echo "<br><pre>";
    print_r($arr);
    echo "</pre><br>";
}

$round = 20;
for ($i=0; $i<$round ; $i++) {
    for ($j=0; $j < count($monkeys) ; $j++) {
        // each monkey
        $actions = [];
        for ($k=0; $k < count($monkeys[$j]->items) ; $k++) {
            $actions[] = $monkeys[$j]->test($j, $monkeys[$j]->items[$k]);
        }
        for ($l=0; $l <count($actions) ; $l++) {
            {
                $item = array_shift($monkeys[$j]->items);
                $monkeys[$actions[$l]['target']]->items[] = $actions[$l]['item'];
            }
        }
    }
}


function monkeySort( $a, $b ) {
    return $a->count == $b->count ? 0 : ( $a->count > $b->count ) ? -1 : 1;
}
usort($monkeys, 'monkeySort' );

echo ($monkeys[0]->count * $monkeys[1]->count);
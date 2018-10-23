<?php

define("BOMB", -1);
define("FLAG", -2);
define("SPY", 0);

define("RED", 1);
define("BLUE", 2);

function valid_setup($positions) {
    if(count($positions) != 80)
        return false;
    $piece_set = Array(
        BOMB => 6,
        10 => 1,
        9 => 1,
        8 => 2,
        7 => 3,
        6 => 4,
        5 => 4,
        4 => 4,
        3 => 5,
        2 => 8,
        SPY => 1,
        FLAG => 1
    );
    for(Array(0,40) as $start){
        $pececounts = array_count_values(array_slice($positions, $start, 40));
        if($pececounts != $piece_set) return false;
    }
    return true;
}

$db = get_db();

function sum($x, $y) {
    $z = $x + $y;
    return $z;
}


?>
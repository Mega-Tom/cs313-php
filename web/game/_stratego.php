<?php

require "dbConnect.php";

define("BOMB", -1);
define("FLAG", -2);
define("SPY", 0);

define("RED",  1);
define("BLUE", 2);

class Piece {
    public $owner;
    public $value;
    
    function __construct($o, $v) {
        $this->owner = $o;
        $this->value = $v;
    }
    function attack($other) {
        if($this->value == SPY && $other->value == 10) {
            return true;
        }
        if($other->value == BOMB) {
            return $this->value == 3;
        }
        if($this->value > $other->value) {
            return true;
        }
        if($this->value < $other->value) {
            return false;
        }
        return "TIE";
    }
}

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
    foreach(Array(0,40) as $start){
        $pececounts = array_count_values(array_slice($positions, $start, 40));
        if($pececounts != $piece_set) return false;
    }
    return true;
}

function setup_board($positions) {
    if(!valid_setup($positions)) {throw new Error("invalid setup");}
    $board = array();
    for($i = 0; $i < 10; $i++) {
        $board[$i] = array_fill(0, 10, NULL);
    }
    foreach($positions as $i=>$v) {
        if($i <= 40){
            $board[intdiv($i, 10)][$i % 10] = new Piece(RED, $v);
        }else{
            $board[intdiv($i, 10) + 2][$i % 10] = new Piece(BLUE, $v);
        }
    }
    return $board;
}

function in_range($x1, $y1, $x2, $y2) {
    if($x1 == $x2){
        return $y2 = $y1 + 1 || $y2 = $y1 - 1;
    }
    else if($y1 == $y2){
        return $x2 = $x1 + 1 || $x2 = $x1 - 1;
    }
    return false;
}

function board_position($id) {
    $db = get_db();
    $q = $db->prepare("SELECT initalSetup FROM game where id = :id");
    $q->BindValue(":id", $id);
    $result = $q->Execute();
    
    foreach($result->fetch_all() as $row) {
        $board = setup_board($row["initalsetup"]);
    }
    
    $q = $db->prepare("SELECT fromsquare, tosquare, seq FROM move WHERE gameid = :id ORDER by seq");
    $q->BindValue(":id", $id);
    $result = $q->Execute();
    
    $old_i = 0;
    
    foreach($result->fetch_all() as $row) {
        $from = $row["fromsquare"];
        $fy = intdiv($from, 10);
        $fx = $from % 10;
        
        $to = $row["tosquare"];
        $ty = intdiv($to, 10);
        $tx = $to % 10;
        
        $i = $row["seq"];
        if($i != $old_i + 1) throw new Error("move jump between $old_i and $i");
        $current = array(RED, BLUE)[$i % 2];
        
        $mover = $board[$fy][$fy];
        if(
            $mover == NULL ||
            $mover->owner != $current ||
            $mover->value == BOMB ||
            $mover->value == FLAG) {throw new Error("cannot move from square $from (on move $i)");}
        $board[$fy][$fy] = NULL;
        $targ = $board[$ty][$tx];
        if(! in_range($fx, $fy, $tx, $ty)) {throw new Error("cannot move from square $from to $to (on move $i)");}
        if($targ == NULL) {
            $board[$ty][$tx] = $mover;
        }else {
            if($mover->owner == $targ->owner) {throw new Error("cannot attack own peice (on move $i)");}
            if($mover->attack($targ)){
                $board[$ty][$tx] = $mover;
            }
        }
    }
    return $board;
}

function get_player($gameid, $userid) {
    $db = get_db();
    $q = $db->prepare("SELECT fliped FROM gamedouble where id = :game and player1Id = :user");
    $q->BindValue(":game", $gameid);
    $q->BindValue(":user", $userid);
    $q->Execute();
    
    foreach($q->fetch_all() as $row) {
        return $row["fliped"] ? BLUE : RED;
    }
}


?>
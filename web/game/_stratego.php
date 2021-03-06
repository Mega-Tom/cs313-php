<?php

require_once "dbConnect.php";

define("BOMB", -1);
define("FLAG", -2);
define("SPY", 0);

define("RED",  1);
define("BLUE", 2);

define("PIECE_SET", Array(
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
    FLAG => 1));

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
    function str() {
        if($this->value == SPY) return "S";
        if($this->value == BOMB) return "Q";
        if($this->value == FLAG) return "F";
        return (string)$this->value;
    }
    function __toString() {
        return "{owner: ".$this->owner.", value: ".$this->str()."}";
    }
}

class Game {
    public $board;
    public $captured_pieces;
    
    
    function __construct($position) {
        $this->board = setup_board($position);
        $this->captured_pieces = array(RED=>array(), BLUE=>array());
    }
    
    function capture($p){
        if(!isset($this->captured_pieces[$p->owner][$p->str()]))
        {
            $this->captured_pieces[$p->owner][$p->str()] = 0;
        }
        $this->captured_pieces[$p->owner][$p->str()]++;
    }
    
    function do_move($from, $to, $i) {
        if($this->get_winner()) {
            throw new Exception("Cannot move, game is over.");
        }
        $fy = intdiv($from, 10);
        $fx = $from % 10;
        
        $ty = intdiv($to, 10);
        $tx = $to % 10;
        
        $current = array(RED, BLUE)[$i % 2];
        
        $mover = $this->board[$fy][$fx];
        
        if( $mover == NULL || $mover->owner != $current) 
        {
            throw new Exception("player $current cannot move from square $from (on move $i)");
        }
        if( $mover->value == BOMB || $mover->value == FLAG)
        {
            throw new Exception("cannot move immobile piece $mover from square $from (on move $i)");
        }
        
        $this->board[$fy][$fx] = NULL;
        $targ = $this->board[$ty][$tx];
        if(! in_range($fx, $fy, $tx, $ty)) {throw new Exception("cannot move from square $from to $to (on move $i)");}
        
        if($targ == NULL) {
            $this->board[$ty][$tx] = $mover;
        }else {
            if($mover->owner == $targ->owner) {throw new Exception("cannot attack own peice (on move $i)");}
            $attack = $mover->attack($targ);
            
            if($attack === 'TIE'){
                $this->capture($mover);
                $this->capture($targ);
                $this->board[$ty][$tx] = NULL;
            }elseif($attack){
                $this->capture($targ);
                $this->board[$ty][$tx] = $mover;
            }else{
                $this->capture($mover);
            }
        }
    }
    
    function get_winner(){
        if($this->captured_pieces[RED]["F"] == 1) return BLUE;
        if($this->captured_pieces[BLUE]["F"] == 1) return RED;
        return false;
    }
}

function valid_setup($positions) {
    if(count($positions) != 80 || $positions[79] === NULL)
        return false;
    
    foreach(Array(0,40) as $start){
        $pececounts = array_count_values(array_slice($positions, $start, 40));
        if($pececounts != PIECE_SET) return false;
    }
    return true;
}

function setup_board($positions) {
    if(!valid_setup($positions)) {throw new Exception("invalid setup");}
    $board = array();
    for($i = 0; $i < 10; $i++) {
        $board[$i] = array_fill(0, 10, NULL);
    }
    foreach($positions as $i=>$v) {
        if($i < 40){
            $board[intdiv($i, 10)][$i % 10] = new Piece(RED, $v);
        }else{
            $board[intdiv($i, 10) + 2][$i % 10] = new Piece(BLUE, $v);
        }
    }
    return $board;
}

function in_range($x1, $y1, $x2, $y2) {
    if($x1 == $x2){
        return $y2 == $y1 + 1 || $y2 == $y1 - 1;
    }
    else if($y1 == $y2){
        return $x2 == $x1 + 1 || $x2 == $x1 - 1;
    }
    return false;
}

function run_game($id) {
    $db = get_db();
    $query_string = "SELECT initalSetup[1]";
    for($i = 2; $i <= 80; $i++) {
        $query_string = $query_string . ",initalSetup[$i]";
    }
    $query_string = $query_string." FROM game where id = :id";
    
    $q = $db->prepare($query_string);
    $q->BindValue(":id", $id);
    $q->Execute();
    
    $game = NULL;
    foreach($q->fetchall(PDO::FETCH_NUM) as $row) {
        $game = new Game($row);
    }
    if(!$game){throw new Exception("Game not found:$id");}
    
    $q = $db->prepare("SELECT fromsquare, tosquare, seq FROM move WHERE gameid = :id ORDER by seq");
    $q->BindValue(":id", $id);
    $q->Execute();
    
    $old_i = 0;
    
    foreach($q->fetchall() as $row) {
        
        $i = $row["seq"];
        if($i != $old_i + 1) throw new Exception("move jump between $old_i and $i");
        $old_i = $i;
        
        $game->do_move($row["fromsquare"], $row["tosquare"], $i);
    }
    return $game;
}

function random_valid_start_position (){
    $red_setup = array();
    foreach(PIECE_SET as $piece => $count){
        for($i = 0; $i < $count; $i++){$red_setup[] = $piece;}
    }
    $blue_setup = array();
    foreach(PIECE_SET as $piece => $count){
        for($i = 0; $i < $count; $i++){$blue_setup[] = $piece;}
    }
    shuffle($red_setup);
    shuffle($blue_setup);
    
    return array_merge($red_setup, $blue_setup);
}

function generate_board (){
    return setup_board(random_valid_start_position());
}

function get_player($gameid, $userid) {
    $db = get_db();
    $q = $db->prepare("SELECT fliped FROM gamedouble WHERE id = :game AND player1Id = :user");
    $q->BindValue(":game", $gameid);
    $q->BindValue(":user", $userid);
    $q->Execute();
    
    foreach($q->fetchall() as $row) {
        return $row["fliped"] ? BLUE : RED;
    }
    return false;
}

function get_turn_number($gameid) {
    $db = get_db();
    $q = $db->prepare('select count(*) from move where gameid = :gameid');
    $q->bindValue(":gameid", $gameid, PDO::PARAM_INT);
    $q->Execute();
    
    $result = $q->fetchALL();
    
    return $result[0]["count"];
}

function current_player($gameid) {
    $db = get_db();
    $q = $db->prepare('select count(*) from move where gameid = :gameid');
    $q->bindValue(":gameid", $gameid, PDO::PARAM_INT);
    $q->Execute();
    
    $result = $q->fetchALL();
    
    if(isSet($result[0]))
        return array(BLUE, RED)[$result[0]["count"] % 2];
    return false;
}

function gamestate($gameid) {
    $db = get_db();
    $q = $db->prepare("select state from game where id = :gameid");
    $q->bindValue(":gameid", $gameid, PDO::PARAM_INT);
    $q->Execute();
    
    $result = $q->fetchALL();
    
    if(isSet($result[0]))
        return $result[0]["state"];
    return false;
}
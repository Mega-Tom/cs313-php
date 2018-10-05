<?php 
class Good { 
    public $price = 7; 
    public $name = Watter;
    public $discription = "a nice drink.";
    
    
    function __construct($p, $n, $d) {
        $this->price = $p;
        $this->name = $n;
        $this->discription = $d;
    }
    function display() { 
        echo "\n<h3>" . $this->name;
        echo money_format(" <span>%i</span></h3>", $this->price);
        echo "\n<p> " . $this->discription . " </p>"; 
    } 
} 

$goods = array(
    new Good(5, "Wood", "Cut fresh from a pine tree."),
    new Good(8, "Iron", "Atomic symbl Fe."),
    new Good(3, "Stone", "Five thosend years old volcanic rock.")
);
?> 

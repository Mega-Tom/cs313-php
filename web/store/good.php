<?php 
class Good { 
    public $price; 
    public $name;
    public $discription;
    
    
    function __construct($p, $n, $d) {
        $this->price = $p;
        $this->name = $n;
        $this->discription = $d;
    }
    function display() { 
        echo "\n<h3>" . $this->name;
        echo money_format(" <span>\$%i</span></h3>", $this->price);
        echo "\n<p> " . $this->discription . " </p>"; 
    } 
} 


//This is where to add any goods we want to sell.
//I was going to change these, but ran out of time.
$goods = array(
    new Good(5.00, "Wood", "Cut fresh from a pine tree."),
    new Good(8.25, "Iron", "Atomic symbol Fe."),
    new Good(3.99, "Stone", "Five-million-year-old volcanic rock.")
);
?> 

<?php

    class Animal{
        const numLegs = 4;
        private $weight;
        private $species;
        private $colour;
        
        public function __get($name){
            return $this->$name;
        }
        
        public function __set($name, $value){
            $this->$name = $value;
        }

        public function __construct($weight, $species, $colour) {
            $this->weight = $weight;
            $this->species = $species;
            $this->colour = $colour;
        }
        
        function __destruct(){
            //this is called when the object gets removed from memory.
            echo "<BR>Object destroyed<BR>";
        }
        
        static function MakeNoise(){
            echo "ARP ARP ARP<BR>";
        }
        
        //abstract function SomeMethod();
        
    }//end animal class
    
    $myAnimal = new Animal(150, "Zebra", "Black and white");
    echo $myAnimal->colour . "<BR>";
    
    echo $myAnimal->weight . "<BR>";
    $myAnimal->weight = 400;
    echo $myAnimal->weight . "<BR>";
    echo Animal::MakeNoise();
    
    //type-hinting
    function PrintAnimal(Animal $animal){
        echo $animal->colour . " " . $animal->species. " that weighs " . $animal->weight . " pounds.<BR>";
    }
    
    PrintAnimal($myAnimal);
    
   
    
?>


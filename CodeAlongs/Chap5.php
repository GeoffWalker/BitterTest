<?php

//
// ARRAYS
//

$colours[] = "red";
$colours[] = "blue";
$colours[] = "green";

//quicker
$colours = array(0 => "red", 1 => "blue", 2 => "green");
$colours = array("red", "blue", "green");

//associative arrays
$colours = array("R" => "red", "B" => "blue", "G" => "green");

echo $colours["B"] . "<BR>";

//2D arrays
$grades1 = array("Jimmy" => array("Math" => 90, "French" => 60),
                "Johnny" => array("Math" => 50, "French" => 50),
                "Suzie" => array("Math" => 100, "French" => 99));

echo $grades1["Suzie"]["French"] . "<BR>";



//
//PROCESSION A TXT FILE INTO AN ARRAY
//
$studentFile = fopen("students.txt", "r");

while($line = fgets($studentFile)){
    list($name, $hometown, $GPA) = explode("|", $line);
    echo $name . " " . $hometown . " " . $GPA . "<BR>";
}
fclose($studentFile); //CLOSE


//
// POPULATE WITH A RANGE OF DATA
//

$grades = range("A", "F");
echo is_array($grades) . "<BR>";

foreach ($grades as $grade){
    echo $grade . "<BR>";
}

//print array for testing purposes
print_r($grades1);



//
// ALTERING ARRAYS
//

array_unshift($colours, "purple"); //adds to the beginning of the array

print_r($colours);

array_push($colours, "pink"); //adds to the end of the array

//array_shift($colours); //take 1 off the start of the array

//array_pop($colours); //take 1 off the end of the array

//search array
if(in_array("red", $colours)){
    echo "Found RED" . "<BR>";
}
else{
    echo"RED not found" . "<BR>";
}

//counting array elements
echo sizeof($colours) . " elements in my array <BR>";
echo count($colours) . " elements in my array <BR>";

//sorting
print_r($colours);
echo "<BR>";
sort($colours, SORT_STRING); //SORT_REGULAR is ASCII chars. SORT_NUMERIC for numbers
natcasesort($colours); //case insensitive sorting
print_r($colours);
echo "<BR>";


// merge an array
$colours2 = array("W" => "white", "B" => "black");
$newColours = array_merge($colours, $colours2);
print_r($newColours);





?>

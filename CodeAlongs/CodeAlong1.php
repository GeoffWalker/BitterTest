<html>
    <body>
    <p1>Hello World!</p1>
    <?php
        //comment
        
        /* multi
         * line
         * comment
         */
         
        //declare some variables
        $name = "Jimmy";
        $value = 53;
        echo "value of name is " . $name . " " . $value . "<BR>";
        
        //dynamic
        echo "Hello $name<BR>";
        
        print "hello<BR>"; //effectively same as echo
        
        $numCans = 6;
        $price = 15.99;
        
        printf("%d cans of beer cost $%.2f<BR>", $numCans, $price);
        
        $value = false;
        echo $value . "<BR>";
        
        $student[0] = "billie";
        $student[1] = "jimmy";
        $student[2] = 9;
        $student[3] = "clarence";
        echo $student[2] . " " . $student[3] . "<BR>";
        
        
        //type juggling
        $myVar = "5";
        $myVar2 = "20";
        
        $myVar += $myVar2;
        echo $myVar . "<BR>";
        
        $myVar = "5";
        $myVar .= $myVar2;
        echo $myVar . "<BR>";
         
        // & is a pointer to something.
        $myVar2 =& $myVar;
        $myVar = 99;
        echo "myVar2 is : " . $myVar2 . "<BR>";
        
        echo "Value of myVar + 1 = " . ++$myVar . "<BR>";
                
        //constants
        define("PI", 3.14159);
        echo "PI is: " . PI . "<BR>";
        
        $var1 = 5;
        $var2 = "5";
        
        //compare value and type.
        if ($var1 === $var2){
            echo "equal <BR>";
        }
        else{
            echo "not equal <BR>";
        }
        
        //while loop
        $i = 0;
        while ($i < 10){
            echo "i = " . $i++ . "<BR>";
        }
        
        $i = -1;
        do{
            echo "i equals $i<BR>";
        } while ($i > 0);
        
        for ($i = 0; $i < 4; $i++){
            echo "i is: $i<BR>";
        }
        
        
        
        
    ?>
        
    </body>
</html>
<?php 

// Array for shuffle 
$a=array(1,2,3,4,5);

// Get random number from array 
$random_keys=array_rand($a,2);

// Display the number
echo $a[$random_keys[1]];


?>
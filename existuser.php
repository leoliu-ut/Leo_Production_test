<?php

// Connect to the MySQL database
$host = "fall-2019.cs.utexas.edu";
$user = "cs329e_mitra_zhenyi";
$pwd = "Rage=Arm_regent";
$dbs = "cs329e_mitra_zhenyi";
$port = "3306";

$connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

if (empty($connect)) {
    die("mysqli_connect failed: " . mysqli_connect_error());
}
//print "Connected to " . mysqli_get_host_info($connect) . "<br /><br />\n";
//print "<br /><br />\n";

$username = mysqli_real_escape_string($connect,$_POST["username"]);
$email = mysqli_real_escape_string($connect,$_POST["email"]);
$table = "signup";

//echo $username;

$result = mysqli_query($connect, "select * from $table where username =\"$username\"");
//$resultemail=mysqli_query($connect,"select * from $table where username =\"$email\"");
switch(true){
    case ($result->num_rows != 0):
        $response="Username has been taken";
        break;
//    case($resultemail->num_rows !=0):
//        $response="Email has been used";
//        break;
    default:
        $response = "5-10 characters long, only letters and/or digits, and cannot begin with a digit.";
}
echo $response;
//$response="";
$result->free();

// Close connection to the database
mysqli_close($connect);
?>
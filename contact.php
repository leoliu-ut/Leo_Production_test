<?php
session_start();
$_SESSION["username"] = $_POST["username"];

// Connect to the MySQL database
$host = "fall-2019.cs.utexas.edu";
$user = "cs329e_mitra_zhenyi";
$pwd = "Rage=Arm_regent";
$dbs = "cs329e_mitra_zhenyi";
$port = "3306";

$connect = mysqli_connect($host, $user, $pwd, $dbs, $port);
//print "Connected to ". $connect->host_info . "\n";
if (empty($connect)) {
    die("mysqli_connect failed: " . mysqli_connect_error());
}

$name = mysqli_real_escape_string($connect,$_POST["name"]);
$email = mysqli_real_escape_string($connect,$_POST["email"]);
$comment=mysqli_real_escape_string($connect,$_POST["comments"]);

$table = "contact";
//print $name;


if (isset($_POST["submitcontact"])) {
    if (!empty($name) and !empty($email) and !empty($comment)) {
        $stmt = mysqli_prepare($connect, "INSERT INTO $table VALUES (?, ?, ?)"); //(?,?,?,?)is placeholders to hold values
        mysqli_stmt_bind_param($stmt, 'sss', strval($name), strval($email), strval($comment));//filling the ? with $last, $first..., ssss is format showing all are strings
        mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo "<script>
            alert('Thank you');
            window.location.href='./index.html';
            </script>";
        }else {
        echo "<script>
            alert('Please fill all the blanks');
            window.location.href='./contact.html';
            </script>";
    }
}
$result->free();

// Close connection to the database
mysqli_close($connect);
?>
?>
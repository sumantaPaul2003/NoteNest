<?php
ini_set('display_errors','off');
$servername="localhost";
$username="root";
$password="";
$database="takenotes";

$con=mysqli_connect($servername,$username,$password,$database);

if(!$con){
    die("failed to connect: ".mysqli_connect_error());
}
?>

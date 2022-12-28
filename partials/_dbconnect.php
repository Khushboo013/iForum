<?php
$servername= 'localhost';
$username= 'root';
$password= '';
$database= 'iforum';

$conn = mysqli_connect($servername,$username,$password,$database);

if (!$conn) {
    die("connection is not successful");
}

?>
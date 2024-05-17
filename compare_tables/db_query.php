<?php
$db1 = $_POST['db1'];
$db2 = $_POST['db2'];
$conn1 = new mysqli($servername,$username,$password,$db1);
if($conn1->connect_error){
    die("Connection failed: ".$conn1->connect_error);
}
$conn2 = new mysqli($servername,$username,$password,$db2);
if($conn2->connect_error){
    die("Connection failed: ".$conn2->connect_error);
}
?>
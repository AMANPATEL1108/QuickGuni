<?php

if(isset($_GET["id"])){
    $id = $_GET['id'];
}

$servername="localhost";
$username="root";
$password="";
$database="quickguni";

$connection=new mysqli($servername,$username,$password,$database);

$sql="DELETE FROM teacher WHERE id=$id";
$connection->query($sql);
header("Location:faculty_dashboard.php");

?>
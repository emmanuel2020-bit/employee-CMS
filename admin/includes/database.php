<?php

$connect = mysqli_connect("localhost","root","","employee_cms");

if(!$connect){
    die("Connection failed");
}

mysqli_set_charset($connect,'UTF8');

?>

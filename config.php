<?php
$servername='localhost';
$username='root';
$password='';
$db_name='dukamojadb';
//php has helper functions that will make database interaction ey
//to connet to a database use the funtion called mysqli_connect()
//myqli function return a boolean datatype
$conn = mysqli_connect($servername,$username,$password,$db_name);
//check if conn is successful
if(!$conn){
    die("connection to the database unsuccessful<br>".mysqli_connect_error());
}
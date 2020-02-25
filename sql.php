<?php

$_db_host = "localhost";
$_db_datenbank = "web";
$_db_username = "web";
$_db_passwort = "web";

session_start();

$conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

if($conn->connect_error){
    
}
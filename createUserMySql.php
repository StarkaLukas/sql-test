<?php

$_db_host = "localhost";
$_db_database = "web";
$_db_username = "web";
$_db_password = "web";

session_start();

$conn = new mysqli($_db_host, $_db_username, $_db_password, $_db_database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if((!isset($_POST["submit"])) && !empty($_POST["submit"])){
    $_username = $conn->real_escape_string($_POST["username"]);
    $_password = $conn->real_escape_string($_POST["password1"]);
    if(strcmp($_password, $conn->real_escape_string($_POST["password2"])) != 0){
        # password is not repeated correctly
        include("create_user_form.html");
        exit;
    }

    $_password = "saver" . $_password;
    $insertStatement = "INSERT INTO login_username (username, password, user_deleted, last_login) VALUES('$_username', md5('$_password'), 0, NOW());";
}

$conn->close();
echo "end of php file";
?>
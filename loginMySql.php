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

if((isset($_POST["submit"])) && !empty($_POST["submit"])){
    $_username = $conn->real_escape_string($_POST["username"]);
    $_password = $conn->real_escape_string($_POST["password"]);

    $_password = "saver" . $_password;
    $_sql = "SELECT * FROM login_username WHERE username='$_username' AND password=md5('$_password') AND user_deleted=0 LIMIT 1";

    if($_res = $conn->query($_sql)){
        if($_res->num_rows > 0){
            echo "Der Login war erfolgreich.<br>";
            $_SESSION["login"] = 1;
            $_SESSION["user"] = $_res->fetch_assoc();

            $_sql = "UPDATE login_username SET last_login=NOW() WHERE id=" . $_SESSION["user"]["id"];
            $conn->query($_sql);
        }
    }else{
        echo "Die Logindaten sind nicht korrekt.<br>";
        include("login_form.html");
        exit;
    }
} else{
    include("login_form.html");
}

$conn->close();

if($_SESSION["login"] != 1){
    include("login_form.html");
    exit;
}

echo "<br>User " . $_SESSION["user"]["username"] . " is logged in since " . $_SESSION["user"]["last_login"] . "<br>";
?>
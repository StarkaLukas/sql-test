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

$_table = "login_username";
$_query = "SELECT * FROM $_table";
if($result = $conn->query($_query)){
    echo "<br>Select returned " . $result->num_rows . " rows.<br>";


    if($result->num_rows > 0){
        echo "<table><tr><th>ID</th><th>User</th><th>Last Login</th></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["last_login"] . "</td></tr>";
        }
    }else{
        "0 results";
    }

    $result->close();
}
?>
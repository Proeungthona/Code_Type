<?php

$servername="127.0.0.1";
$dbusername="db";
$password="db-password";
$dBName="db";

$conn = mysqli_connect($servername, $dbusername, $password, $dBName);

if(!$conn){
	die("Connection failed: ".mysqli_connect_error());
}

function get_user($user){
    global $conn;

    $sql = "SELECT * FROM users WHERE username=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL Error";
        exit();
    }

    // execute query
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // check result
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    }
    return null;
}

function get_admin_info(){
    return file_get_contents('/secretadmininfo.txt');
}

function pw_hash($password){
    return hash('sha256', $password);
}
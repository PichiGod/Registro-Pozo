<?php

$host = "sql210.infinityfree.com";
$user = "if0_34576358";
$pass = "NX0galkfJvGQ0S";
$db   = "if0_34576358_pozos";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die(mysqli_error($conn));
}else{
    //echo "Conectado", "<br>";
}

?>
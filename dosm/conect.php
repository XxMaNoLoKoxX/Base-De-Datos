<?php

$host = 'DESKTOP-E3HVG6D\SQLEXPRESS';
$dbname = 'TallerPC';
$username = 'usuario1';
$pasword = '12345678';


try {
    $conn = new PDO("sqlsrv:Server=$host;Database=$dbname", $username, $pasword);
    echo "Se conectó correctamente a la base de datos";
} 
catch (PDOException $exp) {
    echo "No se logró conectar correctamente a la base de datos: " . $exp->getMessage();
}

?>

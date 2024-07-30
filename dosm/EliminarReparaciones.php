<?php
include_once 'conect.php';

if (isset($_GET['id'])) {
    $id_reparacion = $_GET['id'];
    
    $query = "DELETE FROM Reparaciones WHERE id_reparacion = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id_reparacion]);

    header("Location: Reparaciones.php");
}
?>

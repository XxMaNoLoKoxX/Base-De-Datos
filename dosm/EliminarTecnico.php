<?php
include_once 'conect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el técnico
    $query = "DELETE FROM Técnicos WHERE id_tecnico = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
} else {
    die("ID del técnico no especificado.");
}
?>

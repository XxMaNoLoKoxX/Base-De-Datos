<?php
include_once 'conect.php';

// Verifica si se ha proporcionado un ID para eliminar
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    try {
        // Comienza una transacción
        $conn->beginTransaction();

        // Elimina las reparaciones que están asociadas con los equipos del cliente
        $deleteReparacionesQuery = "
            DELETE FROM Reparaciones
            WHERE id_equipo IN (
                SELECT id_equipo FROM Equipos WHERE id_cliente = :id_cliente
            )
        ";
        $deleteReparacionesStmt = $conn->prepare($deleteReparacionesQuery);
        $deleteReparacionesStmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $deleteReparacionesStmt->execute();

        // Elimina los equipos que están asociados con el cliente
        $deleteEquiposQuery = "DELETE FROM Equipos WHERE id_cliente = :id_cliente";
        $deleteEquiposStmt = $conn->prepare($deleteEquiposQuery);
        $deleteEquiposStmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $deleteEquiposStmt->execute();

        // Elimina el cliente
        $deleteClienteQuery = "DELETE FROM Clientes WHERE id_cliente = :id_cliente";
        $deleteClienteStmt = $conn->prepare($deleteClienteQuery);
        $deleteClienteStmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $deleteClienteStmt->execute();

        // Confirma la transacción
        $conn->commit();

        // Redirige a la página principal después de eliminar
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        // Revierte la transacción si hay un error
        $conn->rollBack();
        echo 'Error al eliminar el cliente: ' . $e->getMessage();
    }
} else {
    echo 'ID de cliente no proporcionado.';
}
?>

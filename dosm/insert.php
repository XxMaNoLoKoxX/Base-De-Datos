<?php
include_once 'conect.php';

// Inicializa variables para los mensajes y datos del formulario
$nombre = $direccion = $telefono = $email = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    try {
        // Prepara la consulta de inserción
        $insertQuery = "INSERT INTO Clientes (nombre, direccion, telefono, email) VALUES (:nombre, :direccion, :telefono, :email)";
        $insertStmt = $conn->prepare($insertQuery);

        // Vincula los parámetros
        $insertStmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $insertStmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $insertStmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Ejecuta la consulta
        $insertStmt->execute();

        // Mensaje de éxito
        $mensaje = 'Cliente añadido correctamente.';

        // Opcionalmente, puedes redirigir a otra página después de la inserción
        // header('Location: index.php');
        // exit();
    } catch (PDOException $e) {
        $mensaje = 'Error al añadir el cliente: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 class="text-center">Agregar Nuevo Cliente</h1>

    <div class="container">
        <form method="post" action="insert.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Cliente</button>
        </form>

        <?php if ($mensaje): ?>
            <p><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>
    </div>
    <a href="Clientes.php">Regresar</a>
</body>
</html>

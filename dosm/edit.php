<?php
include_once 'conect.php';

// Verifica si se ha proporcionado un ID a través de GET
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];
    
    // Consulta para obtener los datos del cliente
    $query = "SELECT * FROM Clientes WHERE id_cliente = :id_cliente";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_OBJ);

    // Verifica si se encontró el cliente
    if (!$cliente) {
        die('Cliente no encontrado.');
    }

    // Procesa el formulario cuando se envía
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        // Actualiza el registro en la base de datos
        $updateQuery = "UPDATE Clientes SET nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE id_cliente = :id_cliente";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':nombre', $nombre);
        $updateStmt->bindParam(':direccion', $direccion);
        $updateStmt->bindParam(':telefono', $telefono);
        $updateStmt->bindParam(':email', $email);
        $updateStmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            header('Location: index.php'); // Redirige a la página principal después de actualizar
            exit();
        } else {
            echo 'Error al actualizar el cliente.';
        }
    }
} else {
    die('ID de cliente no proporcionado.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Editar Cliente</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente->nombre); ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($cliente->direccion); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($cliente->telefono); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($cliente->email); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>

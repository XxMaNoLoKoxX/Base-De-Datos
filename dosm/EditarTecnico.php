<?php
include_once 'conect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitizar el ID

    // Obtener los datos del técnico
    $query = "SELECT * FROM Técnicos WHERE id_tecnico = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $tecnico = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$tecnico) {
        die("Técnico no encontrado.");
    }
} else {
    die("ID del técnico no especificado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar datos
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $especialidad = htmlspecialchars(trim($_POST['especialidad']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido.");
    }

    // Actualizar los datos del técnico
    $updateQuery = "UPDATE Técnicos SET nombre = :nombre, telefono = :telefono, email = :email, especialidad = :especialidad WHERE id_tecnico = :id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':nombre', $nombre);
    $updateStmt->bindParam(':telefono', $telefono);
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':especialidad', $especialidad);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($updateStmt->execute()) {
        header("Location: index.php?status=success");
        exit();
    } else {
        die("Error al actualizar el técnico.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Técnico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Editar Técnico</h1>
        <form action="EditarTecnico.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($tecnico->nombre); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($tecnico->telefono); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($tecnico->email); ?>" required>
            </div>
            <div class="form-group">
                <label for="especialidad">Especialidad</label>
                <input type="text" class="form-control" id="especialidad" name="especialidad" value="<?php echo htmlspecialchars($tecnico->especialidad); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>

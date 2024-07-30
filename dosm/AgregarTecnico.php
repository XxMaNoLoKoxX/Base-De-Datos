<?php
include_once 'conect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $especialidad = $_POST['especialidad'];

    $query = "INSERT INTO Técnicos (nombre, telefono, email, especialidad) VALUES (:nombre, :telefono, :email, :especialidad)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':especialidad', $especialidad);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Técnico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Agregar Técnico</h1>
        <form action="AgregarTecnico.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="especialidad">Especialidad</label>
                <input type="text" class="form-control" id="especialidad" name="especialidad" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>

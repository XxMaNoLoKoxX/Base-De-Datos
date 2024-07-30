<?php
include_once 'conect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de añadir reparación
    $id_equipo = $_POST['id_equipo'];
    $fecha_salida = $_POST['fecha_salida'];
    $estado = $_POST['estado'];
    $descripcion_problema = $_POST['descripcion_problema'];
    $descripcion_reparacion = $_POST['descripcion_reparacion'];

    $query = "INSERT INTO Reparaciones (id_equipo, fecha_salida, estado, descripcion_problema, descripcion_reparacion) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id_equipo, $fecha_salida, $estado, $descripcion_problema, $descripcion_reparacion]);

    header("Location: Reparaciones.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Reparación</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Barra de navegación -->
  

    <br><br>

    <div class="container">
        <h1 class="text-center">Añadir Reparación</h1>
        <form method="POST">
            <div class="form-group">
                <label for="id_equipo">ID Equipo:</label>
                <input type="text" class="form-control" id="id_equipo" name="id_equipo" required>
            </div>
            <div class="form-group">
                <label for="fecha_salida">Fecha de Salida:</label>
                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" required>
            </div>
            <div class="form-group">
                <label for="descripcion_problema">Descripción del Problema:</label>
                <textarea class="form-control" id="descripcion_problema" name="descripcion_problema" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="descripcion_reparacion">Descripción de la Reparación:</label>
                <textarea class="form-control" id="descripcion_reparacion" name="descripcion_reparacion" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="Reparaciones.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>

<?php
include_once 'conect.php';

if (isset($_POST['update'])) {
    $id_reparacion = $_POST['id_reparacion'];
    $id_equipo = $_POST['id_equipo'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_salida = $_POST['fecha_salida'];
    $estado = $_POST['estado'];
    $descripcion_problema = $_POST['descripcion_problema'];
    $descripcion_reparacion = $_POST['descripcion_reparacion'];

    $query = "UPDATE Reparaciones SET id_equipo = ?, fecha_ingreso = ?, fecha_salida = ?, estado = ?, descripcion_problema = ?, descripcion_reparacion = ? WHERE id_reparacion = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id_equipo, $fecha_ingreso, $fecha_salida, $estado, $descripcion_problema, $descripcion_reparacion, $id_reparacion]);

    header("Location: Reparaciones.php");
}

$id_reparacion = $_GET['id'];
$query = "SELECT * FROM Reparaciones WHERE id_reparacion = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$id_reparacion]);
$reparacion = $stmt->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reparación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Reparación</h1>
        <form method="POST" action="EditarReparaciones.php">
            <input type="hidden" name="id_reparacion" value="<?php echo $reparacion->id_reparacion; ?>">
            <div class="form-group">
                <label for="id_equipo">ID Equipo</label>
                <input type="text" class="form-control" id="id_equipo" name="id_equipo" value="<?php echo $reparacion->id_equipo; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $reparacion->fecha_ingreso; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_salida">Fecha de Salida</label>
                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" value="<?php echo $reparacion->fecha_salida; ?>">
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $reparacion->estado; ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion_problema">Descripción del Problema</label>
                <textarea class="form-control" id="descripcion_problema" name="descripcion_problema" required><?php echo $reparacion->descripcion_problema; ?></textarea>
            </div>
            <div class="form-group">
                <label for="descripcion_reparacion">Descripción de la Reparación</label>
                <textarea class="form-control" id="descripcion_reparacion" name="descripcion_reparacion"><?php echo $reparacion->descripcion_reparacion; ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
            <a href="Reparaciones.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <footer>
        <h5>Todos los derechos reservados Emmanuel López García @2024</h5>
        <h5>
            <a href="/index.html">REGRESAR |</a>
        </h5>
    </footer>
</body>
</html>

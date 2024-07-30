<?php
include_once 'conect.php';

if (isset($_GET['id'])) {
    $id_equipo = $_GET['id'];
    $query = "SELECT * FROM Equipos WHERE id_equipo = :id_equipo";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_equipo', $id_equipo);
    $stmt->execute();
    $equipo = $stmt->fetch(PDO::FETCH_OBJ);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_equipo = $_POST['id_equipo'];
    $id_cliente = $_POST['id_cliente'];
    $tipo_equipo = $_POST['tipo_equipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $numero_serie = $_POST['numero_serie'];

    $query = "UPDATE Equipos SET id_cliente = :id_cliente, tipo_equipo = :tipo_equipo, marca = :marca, modelo = :modelo, numero_serie = :numero_serie WHERE id_equipo = :id_equipo";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_equipo', $id_equipo);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->bindParam(':tipo_equipo', $tipo_equipo);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':numero_serie', $numero_serie);

    if ($stmt->execute()) {
        $mensaje = "Equipo actualizado exitosamente.";
    } else {
        $mensaje = "Error al actualizar el equipo.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Editar Equipo</h1>

        <?php if (isset($mensaje)) : ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form action="EditarEquipos.php?id=<?php echo $id_equipo; ?>" method="post">
            <input type="hidden" name="id_equipo" value="<?php echo $equipo->id_equipo; ?>">
            <div class="form-group">
                <label for="id_cliente">ID Cliente</label>
                <input type="text" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $equipo->id_cliente; ?>" required>
            </div>
            <div class="form-group">
                <label for="tipo_equipo">Tipo de Equipo</label>
                <input type="text" class="form-control" id="tipo_equipo" name="tipo_equipo" value="<?php echo $equipo->tipo_equipo; ?>" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $equipo->marca; ?>" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $equipo->modelo; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero_serie">Número de Serie</label>
                <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="<?php echo $equipo->numero_serie; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Equipo</button>
        </form>
    </div>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>

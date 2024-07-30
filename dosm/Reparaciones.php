<?php
include_once 'conect.php';
include_once 'fpdf.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reparaciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <h1>Editar Reparaciones</h1>
                <a href="AgregarReparaciones.php"  class="btn btn-primary mb-3">Agregar Reparación</a>
                <table id="registros" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Reparacion</th>
                            <th>Equipo</th>
                            <th>Fecha Ingreso</th>
                            <th>Fecha Salida</th>
                            <th>Estado</th>
                            <th>Descripcion Problema</th>
                            <th>Descripcion Reparacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <a href="GenpdfRep.php" target="_blank" class="btn btn-secondary mb-3">Exportar a PDF</a>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM Reparaciones";
                        $stmt = $conn->query($query);
                        $registros = $stmt->fetchAll(PDO::FETCH_OBJ);

                        foreach ($registros as $fila) {
                            echo "<tr>";
                            echo "<td>{$fila->id_reparacion}</td>";
                            echo "<td>{$fila->id_equipo}</td>";
                            echo "<td>{$fila->fecha_ingreso}</td>";
                            echo "<td>{$fila->fecha_salida}</td>";
                            echo "<td>{$fila->estado}</td>";
                            echo "<td>{$fila->descripcion_problema}</td>";
                            echo "<td>{$fila->descripcion_reparacion}</td>";
                            echo "<td>
                                    <a href='EditarReparaciones.php?id={$fila->id_reparacion}' class='btn btn-warning btn-sm'>Editar</a>
                                    <a href='eliminar_reparacion.php?id={$fila->id_reparacion}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar esta reparación?\");'>Eliminar</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

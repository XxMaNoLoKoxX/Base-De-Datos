<?php
include_once 'conect.php';

$cantidad = 0;
$query = "SELECT * FROM Técnicos";
$stmt = $conn->query($query);
$registros = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Talleres</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    <!--  Datatables Responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <style>
        thead {
            background-color: rgb(16, 105, 179);
            color: #fff;
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <br><br>

    <h1 class="text-center">Listado de Talleres</h1>

    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="AgregarTecnico.php" class="btn btn-success">Agregar Técnico</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="registros" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Técnico</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Especialidad</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <a href="GenpdfTec.php" target="_blank" class="btn btn-secondary mb-3">Exportar a PDF</a>
                    <tbody>
                        <?php foreach($registros as $fila) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fila->id_tecnico); ?></td>
                                <td><?php echo htmlspecialchars($fila->nombre); ?></td>
                                <td><?php echo htmlspecialchars($fila->telefono); ?></td>
                                <td><?php echo htmlspecialchars($fila->email); ?></td>
                                <td><?php echo htmlspecialchars($fila->especialidad); ?></td>
                                <td>
                                    <a href="EditarTecnico.php" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="EliminarTecnico.php" class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <!-- Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
    <!-- Datatables responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#registros').DataTable({
                responsive: true
            });
        });
    </script>

    <footer>
        <h5>Todos los derechos reservados Emmanuel López García @2024</h5>
        <h5><a href="/index.html">REGRESAR</a></h5>
    </footer>
</body>
</html>

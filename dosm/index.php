<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Responsivo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="menu">
        <span class="menu-toggle">&#9776;</span>
        <div class="menu-items">
            <a href="Reparaciones.php">Reparaciones</a>
            <a href="Clientes.php">Clientes</a>
            <a href="Equipos.php">Equipos</a>
            <a href="Tecnicos.php">Técnicos</a>
            
        </div>
    </div>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const menuItems = document.querySelector('.menu-items');

        menuToggle.addEventListener('click', () => {
            menuItems.classList.toggle('active');
        });
    </script>
</body>
</html>

<?php
session_start();

// Array de páginas protegidas
$protectedPages = ["registrar.php", "leer.php", "actualizar.php", "borrar.php"];

// Obtener el nombre de la página actual
$currentPage = basename($_SERVER["PHP_SELF"]);

// Verificar si el usuario tiene acceso a la página actual
if (in_array($currentPage, $protectedPages) && $_SESSION["userRole"] !== "admin") {
  header("Location: login.php");
  exit();
}

// Cerrar sesión
if (isset($_GET["logout"])) {
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Datos Automovilisticos</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="script.js"></script>
</head>
<body>
  <!-- Barra de navegación -->
  <nav>
    <div class="dropdown">
      <button class="dropbtn">Usuarios</button>
      <div class="dropdown-content">
        <a href="db.php" onclick="mostrarOpcion('Nuevo Usuario')">Nuevo Usuario</a>
        <a href="actualizardb.php" onclick="mostrarOpcion('Actualizar Usuario')">Actuallizar Usuario</a>
      </div>
    </div>
    <div class="dropdown">
      <button class="dropbtn">Menú</button>
      <div class="dropdown-content">
        <a href="registrar.php" onclick="mostrarOpcion('Registrar')">Registrar</a>
        <a href="leer.php" onclick="mostrarOpcion('Leer')">Leer</a>
        <a href="actualizar.php" onclick="mostrarOpcion('Actualizar')">Actualizar</a>
        <a href="borrar.php" onclick="mostrarOpcion('Borrar')">Borrar</a>
      </div>
    </div>
   <div class="dropdown">
      <button class="dropbtn">Ventas</button>
      <div class="dropdown-content">
        <a href="venta.php" onclick="mostrarOpcion('Vender')">Vender</a>
        <a href="factura.php" onclick="mostrarOpcion('Leer')">Factura</a>
        <a href="borrarpers.php" onclick="mostrarOpcion('Actualizar')">Clientes</a>
        
      </div>
      <div class="dropdown">
      <button class="dropbtn">Datos</button>
      <div class="dropdown-content">
       <a href="archi.html" onclick="mostrarOpcion('Leer')">Descargar Datos</a>
        <a href="archivomodi.php" onclick="mostrarOpcion('Actualizar')">Modificar Datos</a>
      </div>
    </div> 
    <a href="login.php" class="logout-btn">Cerrar sesión</a>
  </nav>

  <br>
  <br>
  <br>

  <center><h1 style="color: green">Bienvenido</h1></center>

    <?php
    // Establecer el título y el contenido de la página
    $tituloPagina = "Actualizar";
    $contenidoPagina = "contenido-actualizar.php";
    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <title>Actualizar - Datos Automovilisticos</title>
      <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
      <!-- Contenido de la página -->
      <center><p style="color: green">Seleccione desde el menú.</p></center>
    </body>
    </html>
  </div>
</body>
</html>

<style>
body {
  font-family: Arial, sans-serif;
  background-color: #333;
  color: #fff;
  margin: 0;
}

h1 {
  color: #0f0;
  text-align: center;
  margin-top: 50px;
}

nav {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #000;
  padding: 10px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropbtn {
  background-color: #0f0;
  color: #000;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  z-index: 1;
  background-color: #000;
}

.dropdown-content a {
  color: #0f0;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.logout-btn {
  background-color: #f00;
  color: #fff;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease-in-out;
}

.logout-btn:hover {
  background-color: #c00;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 50px;
  background-color: #222;
  border-radius: 10px;
}

form label {
  display: block;
  margin-bottom: 10px;
  color: #0f0;
}

form input[type="text"],
form input[type="number"] {
  padding: 10px;
  font-size: 16px;
  border: none;
  background-color: #333;
  color: #fff;
  border-radius: 5px;
  margin-bottom: 20px;
}

form input[type="submit"] {
  background-color: #0f0;
  color: #000;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease-in-out;
}

form input[type="submit"]:hover {
  background-color: #c00;
}
</style>
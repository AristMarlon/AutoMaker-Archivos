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
      <div>
          <button class="dropdown">Usuario</button>
      </div>
  </nav>
  <nav>
    <div class="dropdown">
      <button class="dropbtn">Usuario</button>
      <div class="dropdown-content">
        
       <a href="db.php" onclick="mostrarOpcion('Usuario')">Nuevo Usuario</a>
       >
        
      </div>
    </div>
    <a href="aaa.php" class="logout-btn">Menu Principal</a>
  </nav>
  
 <br>
 <br>
 <br>



<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$db = "vehiculos";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['actualizar'])) {
        $nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : '';
        $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET nombre_usuario = :nombre_usuario, contrasena = :contrasena WHERE id = :id");

        $sentenciaSQL->bindParam(':nombre_usuario', $nombre_usuario);
        $sentenciaSQL->bindParam(':contrasena', $contrasena);
        $sentenciaSQL->bindParam(':id', $_POST['id']);
        $sentenciaSQL->execute();

        echo "Registro actualizado correctamente.";
    }

    $sentenciaSQL = $conexion->prepare("SELECT * FROM `usuarios`");
    $sentenciaSQL->execute();
    $resultados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    echo "<table style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background-color: green;'>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>ID</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Usuario</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>contraseña</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Acciones</th>";
    echo "</tr>";

    foreach ($resultados as $fila) {
        echo "<tr style='border: 3px solid #3e8e41;'>";
        echo "<form method='POST'>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['id'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'><input type='text' name='nombre_usuario' value='" . $fila['nombre_usuario'] . "'></td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'><input type='text' name='contrasena' value='" . $fila['contrasena'] . "'></td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>";
        echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
        echo "<input type='submit' name='actualizar' value='Actualizar'>";
        echo "</td>";
        echo "</form>";
        echo "</tr>";
    }

    echo "</table>";
    $conexion = null;

} catch (PDOException $ex) {
    echo "<p style='color:red'>Error al conectar a la base de datos: " . $ex->getMessage() . "</p>";
}
?>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  margin: 0;
}

h1 {
  color: #333;
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
  background-color: black;
  padding: 10px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropbtn {
  background-color: green;
  color: white;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  z-index: 1;
}

.dropdown-content a {
  color:green;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown:hover .dropdown-content {
  display: block;
  background-color:black;
}

.logout-btn {
  background-color: #f44336;
  color: white;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease-in-out;
}

.logout-btn:hover {
  background-color: #cc0000;
}

#error-message {
  color: red;
  text-align: center;
}
</style>
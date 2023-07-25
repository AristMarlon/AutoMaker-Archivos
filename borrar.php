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
      <button class="dropbtn">Menú</button>
      <div class="dropdown-content">
        <a href="registrar.php" onclick="mostrarOpcion('Registrar')">Registrar</a>
        <a href="leer.php" onclick="mostrarOpcion('Leer')">Leer</a>
        <a href="actualizar.php" onclick="mostrarOpcion('Actualizar')">Actualizar</a>
        
      </div>
    </div>
    <a href="aaa.php" class="logout-btn">Menu Principal</a>
  </nav>
<br>
<br>
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

    if (isset($_POST['eliminar'])) {
        // Obtener el ID del registro a eliminar
        $id = $_POST['id'];

        // Eliminar el registro de la base de datos
        $sentenciaSQL = $conexion->prepare("DELETE FROM registro WHERE id = :id");
        $sentenciaSQL->bindParam(':id', $id);
        $sentenciaSQL->execute();

        echo "Registro eliminado correctamente.";
    }

    // Preparar y ejecutar la consulta SELECT
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `registro`");
    $sentenciaSQL->execute();

    // Obtener los resultados de la consulta
    $resultados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    // Imprimir los resultados en una tabla HTML con estilos CSS
    echo "<table style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background-color:green;'>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>ID</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Modelo</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Marca</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>ID del motor</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Color</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Número de Asientos</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Placa</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Precio</th>";
    echo "<th style='border: 3px solid #21333a; padding: 8px;'>Acciones</th>";
    echo "</tr>";
    foreach ($resultados as $fila) {
        echo "<tr style='border: 3px solid #3e8e41;'>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['id'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['modelo'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['marca'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['id del motor'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['color'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['num de asientos'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['placa'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>" . $fila['precio'] . "</td>";
        echo "<td style='border: 3px solid #21333a; padding: 8px;'>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
        echo "<input type='submit' name='eliminar' value='Eliminar'>";
        echo "</form>";
        echo "</td>";
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
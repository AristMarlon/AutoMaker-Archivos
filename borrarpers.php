<!DOCTYPE html>
<html>
<head>
    <title>Clientes</title>
    <nav>
   
    
    </div>
   <div class="dropdown">
      <button class="dropbtn">Ventas</button>
      <div class="dropdown-content">
        
        <a href="factura.php" onclick="mostrarOpcion('Leer')">Factura</a>
       
        <a href="venta.php" onclick="mostrarOpcion('venta')">Vender</a>
      </div>
    </div> 
    <a href="aaa.php" class="logout-btn">Menu Principal</a>
  </nav>
  <br>
  <br>
  <br>
  <br>
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

<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$db = "vehiculos";

try {
    // Conectar a la base de datos
    $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $contraseña);

    if (isset($_POST['borrar'])) {
        // Obtener el ID del producto a borrar
        $id = $_POST['id'];

        // Ejecutar la consulta DELETE para borrar el producto correspondiente
        $sentenciaSQL = $conexion->prepare("DELETE FROM personas WHERE id_producto = :id");
        $sentenciaSQL->bindParam(':id', $id);
        $sentenciaSQL->execute();

        echo "Registro borrado correctamente.";
    }

    // Ejecutar la consulta SELECT para obtener la lista de productos
    $sentenciaSQL = $conexion->prepare("SELECT nombre, ubicacion, telefono, precio, id_producto FROM personas");
    $sentenciaSQL->execute();
    $productos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar la lista de productos en una tabla
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Ubicación</th><th>Teléfono</th><th>Precio</th><th>Acciones</th></tr>";
    foreach ($productos as $producto) {
        echo "<tr>";
        echo "<td>" . $producto['nombre'] . "</td>";
        echo "<td>" . $producto['ubicacion'] . "</td>";
        echo "<td>" . $producto['telefono'] . "</td>";
        echo "<td>" . $producto['precio'] . "</td>";
        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='id' value='" . $producto['id_producto'] . "'>";
        echo "<input type='submit' name='borrar' value='Borrar'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
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
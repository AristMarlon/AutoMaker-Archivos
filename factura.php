 </div>
   <div class="dropdown">
      <button class="dropbtn">Ventas</button>
      <div class="dropdown-content">
        
        <a href="venta.php" onclick="mostrarOpcion('Leer')">Vender</a>
        <a href="borrarpers.php" onclick="mostrarOpcion('Actualizar')">Clientes</a>
      
      </div>
    </div> 
    <a href="aaa.php" class="logout-btn">Menu Principal</a>
  </nav>
  <br>
  <br>
  <br>
<?php
// Conexión a la base de datos
$servername = "localhost"; // Nombre del servidor de base de datos
$username = "root"; // Nombre de usuario para conectarse a la base de datos
$password = ""; // Contraseña del usuario para conectarse a la base de datos
$dbname = "vehiculos"; // Nombre de la base de datos a la que se conectará

$conn = new mysqli($servername, $username, $password, $dbname); // Crear una nueva conexión a la base de datos utilizando los parámetros proporcionados

if ($conn->connect_error) { // Verificar si hay un error de conexión
  die("Conexión fallida: " . $conn->connect_error); // Si hay un error, mostrar un mensaje de error y detener el script
}

// Consulta a la base de datos
$sql = "SELECT nombre, ubicacion, telefono, precio, id_producto FROM personas"; // Consulta SQL para obtener los datos de la factura

$result = $conn->query($sql); // Ejecutar la consulta SQL y almacenar el resultado en la variable $result

// Array para almacenar los datos de la factura
$facturas = array();

// Generar una factura individual para cada registro en la tabla "personas"
if ($result->num_rows > 0) { // Verificar si la consulta devolvió algún resultado
  while ($row = $result->fetch_assoc()) { // Recorrer el resultado de la consulta y almacenar cada fila en la variable $row
    // Almacenar los datos de la factura en un array
    $factura = array(
      "fecha" => date("Y-m-d"), // Fecha actual
      "hora" => date("H:i:s"), // Hora actual
      "lugar" => "AutoMaker", // Lugar de la compra
      "nombre" => $row["nombre"], // Nombre del producto
      "ubicacion" => $row["ubicacion"], // Ubicación del vendedor
      "telefono" => $row["telefono"], // Teléfono del vendedor
      "precio" => $row["precio"], // Precio del producto
      "id_producto" => $row["id_producto"], // ID del producto
      "subtotal" => $row["precio"], // Subtotal de la factura
      "impuesto" => $row["precio"] * 1, // Impuesto de la factura 
      "total" => $row["precio"] * 1 // Total de la factura (precio más impuesto)
    );
    // Agregar la factura al array de facturas
    $facturas[] = $factura;
  }
}

$conn->close(); // Cerrar la conexión a la base de datos
?>

<!-- Imprimir las facturas en formato de tabla HTML -->
<?php foreach($facturas as $factura): ?>
  <table border="1">
    <thead>
      <tr>
        <th>Factura de compra</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Fecha: <?php echo $factura["fecha"]; ?></td>
      </tr>
      <tr>
        <td>Hora: <?php echo $factura["hora"]; ?></td>
      </tr>
      <tr>
        <td>Lugar: <?php echo $factura["lugar"]; ?></td>
      </tr>
      <tr>
        <th>Nombre</th>
        <th>Ubicación</th>
        <th>Teléfono</th>
        <th>Precio</th>
        <th>Vehiculo Número</th>
      </tr>
      <tr>
        <td><?php echo $factura["nombre"]; ?></td>
        <td><?php echo $factura["ubicacion"]; ?></td>
        <td><?php echo $factura["telefono"]; ?></td>
        <td><?php printf("%.2f", $factura["precio"]); ?></td>
        <td><?php echo $factura["id_producto"]; ?></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" align="right">Subtotal:</td>
        <td><?php printf("%.2f", $factura["subtotal"]); ?></td>
      </tr>
      <tr>
        <td colspan="4" align="right">Impuesto:</td>
        <td><?php printf("%.2f", $factura["impuesto"]); ?></td>
      </tr>
      <tr>
        <td colspan="4" align="right">Total:</td>
        <td><?php printf("%.2f", $factura["total"]); ?></td>
      </tr>
    </tfoot>
  </table>
<?php endforeach; ?>
<title>Formulario de venta</title>
    <style>
        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        form {
            background-color: #444;
            border-radius: 10px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input, select {
            background-color: #ddd;
            border: none;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #333;
            font-size: 1em;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #0f0;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        #precio {
            font-size: 1.2em;
            font-weight: bold;
            color: #0f0;
            margin-bottom: 20px;
        }
    </style>
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

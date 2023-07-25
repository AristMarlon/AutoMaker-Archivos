<!DOCTYPE html>
<html>
<head>
    <title>Formulario de venta</title>
    <nav>
   
    
    </div>
   <div class="dropdown">
      <button class="dropbtn">Ventas</button>
      <div class="dropdown-content">
        
        <a href="factura.php" onclick="mostrarOpcion('Leer')">Factura</a>
        <a href="borrarpers.php" onclick="mostrarOpcion('Actualizar')">Clientes</a>
       
      </div>
    </div> 
    <a href="aaa.php" class="logout-btn">Menu Principal</a>
  </nav>
  <br>
  <br>
  <br>
    
  <style >body {
  background-color: #1d1d1d;
  color: #fff;
  font-family: Arial, sans-serif;
}

form {
  background-color: #3a3a3a;
  border-radius: 10px;
  padding: 20px;
  max-width: 400px;
  margin: 0 auto;
}

label {
  display: block;
  margin-bottom: 10px;
}

input,
select {
  background-color: #222;
  border: none;
  padding: 5px;
  border-radius: 5px;
  margin-bottom: 20px;
  color: #fff;
  font-size: 1em;
  width: 100%;
}

input[type="submit"] {
  background-color: #5cb85c;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #449d44;
}
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
  
</head>
<body>
    <?php
    // Conectar a la base de datos
    $host = "localhost";
    $usuario = "root";
    $contraseña = "";
    $db = "vehiculos";
    $conexion = mysqli_connect($host, $usuario, $contraseña, $db);

    if (!$conexion) {
        die("La conexión ha fallado: " . mysqli_connect_error());
    }

    // Obtener la lista de productos de la tabla "registro"
    $query = "SELECT * FROM registro";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("Error al obtener la lista de productos: " . mysqli_error($conexion));
    }

    // Crear un array con la lista de productos
    $productos = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $producto = array(
            "id" => $fila["id"],
            "modelo" => $fila["modelo"],
            "marca" => $fila["marca"],
            "precio" => $fila["precio"]
        );
        array_push($productos, $producto);
    }

    // Verificar si se ha enviado el formulario de venta
    if (isset($_POST["submit"])) {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $ci = $_POST["ci"];
        $ubicacion = $_POST["ubicacion"];
        $telefono = $_POST["telefono"];
        $id_producto = $_POST["id_producto"];

        // Obtener el precio del producto seleccionado
        $precio_producto = null;
        foreach ($productos as $producto) {
            if ($producto["id"] == $id_producto) {
                $precio_producto = $producto["precio"];
                break;
            }
        }

        // Verificar si se encontró el precio del producto
        if ($precio_producto === null) {
            die("No se encontró el precio del producto seleccionado");
        }

        // Calcular el precio total de la venta
        $precio_total = $precio_producto;

        // Insertar los datos del cliente y su compra en la tabla "personas"
        $query = "INSERT INTO personas (nombre, ci, ubicacion, telefono, precio, id_producto) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $query);
        if (!$stmt) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        mysqli_stmt_bind_param($stmt, "ssssii", $nombre, $ci, $ubicacion, $telefono, $precio_total, $id_producto);
        $resultado = mysqli_stmt_execute($stmt);

        if (!$resultado) {
            die("Error al insertar los datos de la venta: " . mysqli_error($conexion));
        }

        // Mostrar un mensaje de éxito
        echo "La venta se ha realizado correctamente.";
    }

    // Mostrar el formulario de venta
    echo '<form method="post">';
    echo '<label>Nombre:</label> <input type="text" name="nombre" required><br>';
    echo '<label>Cédula:</label> <input type="text" name="ci" required><br>';
    echo '<label>Ubicación:</label> <input type="text" name="ubicacion" required><br>';
    echo '<label>Teléfono:</label> <input type="text" name="telefono" required><br>';
    echo '<label>Vehículo:</label><select name="id_producto" onchange="mostrarPrecio()">';
    foreach ($productos as $producto) {
        echo '<option value="' . $producto["id"] . '">' . $producto["marca"] . ' ' . $producto["modelo"] . ' - $' . $producto["precio"] . '</option>';
    }
    echo '</select><br>';

    echo '<div id="precio"></div>';

    echo '<input type="submit" name="submit" value="Vender">';
    echo '</form>';

    // Mostrar el script para mostrar el precio del producto seleccionado
    echo '<script>
        function mostrarPrecio() {
            var select = document.getElementsByName("id_producto")[0];
            var precio = document.getElementById("precio");
            var precio_producto = ' . json_encode($productos) . '[select.selectedIndex - 1].precio;
            
    </script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
    ?>
    <?php
// Verificar que los índices estén definidos en $_POST
if (isset($_POST["nombre"]) && isset($_POST["ci"]) && isset($_POST["ubicacion"]) && isset($_POST["telefono"]) && isset($_POST["id_producto"])) {
    // Obtener los datos del formulario de venta
    $nombre = $_POST["nombre"];
    $ci = $_POST["ci"];
    $ubicacion = $_POST["ubicacion"];
    $telefono = $_POST["telefono"];
    $id_producto = $_POST["id_producto"];

    // Obtener los datos del producto seleccionado
    $producto_seleccionado = null;
    foreach ($productos as $producto) {
        if ($producto["id"] == $id_producto) {
            $producto_seleccionado = $producto;
            break;
        }
    }

    // Verificar si se encontró el producto seleccionado
    if ($producto_seleccionado === null) {
        die("No se encontró el producto seleccionado");
    }

    // Calcular el precio total de la venta
    $precio_total = $producto_seleccionado["precio"];

    // Generar la factura
    $factura = array(
        "cliente" => array(
            "nombre" => $nombre,
            "ci" => $ci,
            "ubicacion" => $ubicacion,
            "telefono" => $telefono
        ),
        "producto" => array(
            "marca" => $producto_seleccionado["marca"],
            "modelo" => $producto_seleccionado["modelo"],
            "precio" => $producto_seleccionado["precio"]
        ),
        "precio_total" => $precio_total
    );

    // Mostrar la factura
    echo "<h1>Factura</h1>";
    echo "<p>Cliente:</p>";
    echo "<ul>";
    echo "<li>Nombre: " . $factura["cliente"]["nombre"] . "</li>";
    echo "<li>Cédula: " . $factura["cliente"]["ci"] . "</li>";
    echo "<li>Ubicación: " . $factura["cliente"]["ubicacion"] . "</li>";
    echo "<li>Teléfono: " . $factura["cliente"]["telefono"] . "</li>";
    echo "</ul>";
    echo "<p>Producto:</p>";
    echo "<ul>";
    echo "<li>Marca: " . $factura["producto"]["marca"] . "</li>";
    echo "<li>Modelo: " . $factura["producto"]["modelo"] . "</li>";
    echo "<li>Precio: $" . $factura["producto"]["precio"] . "</li>";
    echo "</ul>";
    echo "<p>Precio total: $" . $factura["precio_total"] * 0.12 . "</p>";
} else {
    // Si alguno de los índices no está definido en $_POST, mostrar un mensaje de error
    die("No se han recibido los datos del formulario");
}
?>
</body>
</html>

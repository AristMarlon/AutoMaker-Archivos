<!DOCTYPE html>
<html>
<head>
  <title>Datos Automovilisticos</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <!-- Barra de navegación -->
  <nav>
    <div class="dropdown">
      <button class="dropbtn">Menú</button>
      <div class="dropdown-content">
        <a href="leer.php" onclick="mostrarOpcion('Leer')">Leer</a>
        <a href="actualizar.php" onclick="mostrarOpcion('Actualizar')">Actualizar</a>
        <a href="borrar.php" onclick="mostrarOpcion('Borrar')">Borrar</a>
      </div>
    </div>
    <a href="aaa.php" class="logout-btn">Menu Principal</a>
  </nav>

  <div class="container">
    <h1>Registre los Datos de los Vehículos</h1>

    <?php
      if (isset($_POST['enviado'])) {
        $modelo = filter_var($_POST["modelo"], FILTER_SANITIZE_STRING);
        $marca = filter_var($_POST["marca"], FILTER_SANITIZE_STRING);
        $idmotor = filter_var($_POST["idmotor"], FILTER_SANITIZE_STRING);
        $color = filter_var($_POST["color"], FILTER_SANITIZE_STRING);
        $num_asientos = filter_var($_POST["num_asientos"], FILTER_VALIDATE_INT);
        $placa = filter_var($_POST["placa"], FILTER_SANITIZE_STRING);
        $precio = filter_var($_POST["precio"], FILTER_VALIDATE_FLOAT);

        if (!empty($modelo) && !empty($marca) && !empty($idmotor) && !empty($color) && !empty($num_asientos) && !empty($placa) && !empty($precio)) {
          $host = "localhost";
          $usuario = "root";
          $contraseña = "";
          $db = "vehiculos";

          try {
            $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $contraseña);
            $sentenciaSQL = $conexion->prepare("INSERT INTO `registro` (`id`, `modelo`, `marca`, `id del motor`, `color`, `num de asientos`, `placa`, `precio`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);");
            $sentenciaSQL->execute([$modelo, $marca, $idmotor, $color, $num_asientos, $placa, $precio]);
            $conexion = null;
            echo "<p style='color:green'>Datos registrados correctamente.</p>";
          } catch (PDOException $ex) {
            echo "<p style='color:red'>Error al conectar a la base de datos: " . $ex->getMessage() . "</p>";
          }
        } else {
          echo "<p style='color:red'>Por favor, ingrese todos los datos requeridos.</p>";
        }
      }
    ?>

    <form method="post" action="">
      <label for="modelo">Modelo del Vehículo:</label>
      <input type="text" id="modelo" name="modelo" placeholder="Ingrese el modelo del Vehiculo" required>

      <label for="marca">Marca:</label>
      <input type="text" id="marca" name="marca" placeholder="Ingrese la marca del vehículo" required>

      <label for="idmotor">ID del Motor:</label>
      <input type="text" id="idmotor" name="idmotor" placeholder="Ingrese el ID del motor" required>

      <label for="color">Color:</label>
      <input type="text" id="color" name="color" placeholder="Ingrese el color del vehículo" required>

      <label for="num_asientos">Número de Asientos:</label>
      <input type="number" id="num_asientos" name="num_asientos" placeholder="Ingrese el número de asientos" required>

      <label for="placa">Placa:</label>
      <input type="text" id="placa" name="placa" placeholder="Ingrese la Placa" required>

      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" placeholder="Ingrese el precio" step="0.01" required>

      <input type="submit" value="Guardar" name="enviado">
    </form>
  </div>

  <script src="script.js"></script>
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
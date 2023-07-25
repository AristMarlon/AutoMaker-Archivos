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
      <button class="dropbtn">Usuario</button>
      <div class="dropdown-content">
        <a href="actualizardb.php" onclick="mostrarOpcion('Actualizar')">Actualizar Usuario</a>
        
      </div>
    </div>
    <a href="aaa.php" class="logout-btn">Menu Principal</a>
  </nav>
  
 <br>
 <br>
<?php
// Conección a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehiculos";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conección
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del nuevo usuario desde el formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para insertar los datos del usuario en la tabla 'usuarios'
    $sql = "INSERT INTO usuarios (nombre_usuario, contrasena)
            VALUES ('$nombre_usuario', '$contrasena')";

    if (mysqli_query($conn, $sql)) {
        echo "El usuario ha sido registrado correctamente";
    } else {
        echo "Error al registrar al usuario: " . mysqli_error($conn);
    }
}

// Cerrar la conección
mysqli_close($conn);
?>


<style>
    /* Estilos para el formulario */
    form {
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px #ccc;
        background-color: #fff;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #3e8e41;
    }

    /* Estilos para el botón de visualización de contraseña */
    .password-toggle {
        position: relative;
    }

    .password-toggle input[type="checkbox"] {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>

<!-- Formulario HTML para registrar un nuevo usuario -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h2>Registro de Usuario</h2>
    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" name="nombre_usuario" id="nombre_usuario" required>
    <div class="password-toggle">
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <input type="checkbox" id="show-password">
        
    </div>
    <input type="submit" value="Registrar">
</form>

<script>
    // Script para cambiar el tipo de campo de entrada de contraseña
    const passwordField = document.getElementById("contrasena");
    const showPasswordCheckbox = document.getElementById("show-password");
    showPasswordCheckbox.addEventListener("change", function() {
        if (this.checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    });
</script>
</body>
</html>

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
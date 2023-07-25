<!DOCTYPE html>
<html lang="es">
<head>
  <title>Sistema de login</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    form {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      margin: auto;
      margin-top: 50px;
      padding: 20px;
      width: 400px;
    }

    h1 {
      text-align: center;
      margin-top: 0;
    }

    input[type=text], input[type=password] {
      padding: 10px;
      display: block;
      margin: 10px auto;
      border-radius: 5px;
      border: none;
      width: 100%;
    }

    input[type=submit] {
      background-color: #4CAF50;
      border: none;
      color: #fff;
      cursor: pointer;
      border-radius: 5px;
      padding: 10px;
      display: block;
      margin: 10px auto;
      width: 100%;
    }

    input[type=submit]:hover {
      background-color: #3e8e41;
    }

    .error {
      background-color: #f44336;
      color: #fff;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      text-align: center;
    }

    .success {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      text-align: center;
    }

    /* Estilos para el botón de mostrar/ocultar contraseña */
    .show-password {
      position: relative;
    }

    .show-password input[type="checkbox"] {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
    }
  </style>
  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById("password-input");
      var showPasswordCheckbox = document.getElementById("show-password-checkbox");
      if (showPasswordCheckbox.checked) {
        passwordInput.setAttribute("type", "text");
      } else {
        passwordInput.setAttribute("type", "password");
      }
    }
  </script>
</head>
<body>
  <?php
    // Iniciar sesión
    session_start();

   
      // Verificar si se han enviado los datos del formulario
      if(isset($_POST['usuario']) && isset($_POST['contraseña'])){
        // Conectar a la base de datos
        $conexion = mysqli_connect('localhost', 'root', '', 'vehiculos');
        if(!$conexion){
          die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }

        // Escapar los datos para evitar inyección SQL
        $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
        $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);

        // Consultar la base de datos
        $consulta = "SELECT * FROM usuarios WHERE nombre_usuario='$usuario' AND contrasena='$contraseña'";
        $resultado = mysqli_query($conexion, $consulta);

        // Verificar si la consulta SQL se ejecutó correctamente
        if($resultado){
          // Verificar si se encontraron resultados
          if(mysqli_num_rows($resultado) == 1){
            // Iniciar sesión y redirigir al usuario a la página principal
            $_SESSION['usuario'] = $usuario;
            header('Location: aaa.php');
          }else{
            // Mostrar mensaje de error
            echo '<div class="error">Usuario o contraseña incorrecto</div>';
          }
        }else{
          // Mostrar mensaje de error
          echo '<div class="error">Error al ejecutar la consulta SQL: ' . mysqli_error($conexion) . '</div>';
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
      }
      // Mostrar formulario de inicio de sesión
      echo '<form method="post">
              <h1>Sistema de Usuarios</h1> <!-- Corregir el cierre de la etiqueta h1 -->
              <p>Usuario<input type="text" placeholder="Ingrese su nombre" name="usuario"></p>
              <p class="show-password">Contraseña<input type="password" placeholder="Ingrese su contraseña" name="contraseña" id="password-input"><input type="checkbox" id="show-password-checkbox" onclick="togglePasswordVisibility()"></p>
              <input type="submit" value="Ingresar">
            </form>';
    

    // Verificar si se ha enviado el formulario de cierre de sesión
    if(isset($_POST['cerrar_sesion'])){
      // Destruir la sesión y redirigir al usuario a la página de inicio de sesión
      session_destroy();
      header('Location: login.php');
    }
  ?>
</body>
</html>
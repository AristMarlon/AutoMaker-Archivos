<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestión de archivos</title>
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    h1 {
      text-align: center;
      margin-top: 50px;
    }

    form {
      width: 400px;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      color: #333;
    }

    select, input[type="text"] {
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 3px;
      border: 1px solid #ccc;
      width: 100%;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      margin-top: 20px;
      transition: background-color 0.2s ease;
    }

    input[type="submit"]:hover {
      background-color: #0062cc;
    }

    /* Estilos para la barra de navegación */

    nav {
      background-color: #333;
      overflow: hidden;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      padding: 14px 16px;
      display: block;
      float: left;
      text-align: center;
    }

    nav a:hover {
      background-color: #ddd;
      color: #333;
    }

    .dropdown {
      float: left;
      overflow: hidden;
    }

    .dropdown .dropbtn {
      font-size: 16px;
      border: none;
      outline: none;
      color: #fff;
      padding: 14px 16px;
      background-color: inherit;
      font-family: inherit;
      margin: 0;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      z-index: 1;
    }

    .dropdown-content a {
      float: none;
      color: #333;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .logout-btn {
      float: right;
      display: block;
      color: #fff;
      text-decoration: none;
      padding: 14px 16px;
      text-align: center;
    }

    .logout-btn:hover {
      background-color: #ddd;
      color: #333;
    }

  </style>
</head>

<body>
  <nav>
    <div class="dropdown">
      <button class="dropbtn">Datos</button>
      <div class="dropdown-content">
        <a href="archi.html">Descargar Datos</a>
       
      </div>
    </div>
    
    
  
    <a href="aaa.php" class="logout-btn">Pagina Princial</a>
  </nav>
</head>
<body>
  <h1>Gestión de archivos</h1>

  <?php
  // Verificar si se hizo una petición POST
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores de los campos del formulario
    $nombre_archivo = trim($_POST['nombre_archivo']);
    $nuevo_nombre_archivo = trim($_POST['nuevo_nombre_archivo']);
    $operacion = $_POST['operacion'];

    // Verificar si el campo "Nombre del archivo" no está vacío
    if (!empty($nombre_archivo)) {
      // Verificar si el archivo existe
      if (file_exists($nombre_archivo)) {
        switch ($operacion) {
          case 'borrar':
            // Borrar el archivo
            if (unlink($nombre_archivo)) {
              echo '<p class="success">El archivo ha sido borrado correctamente</p>';
            } else {
              echo '<p class="error">No se ha podido borrar el archivo</p>';
            }
            break;

          case 'copiar':
            // Verificar si se especificó un nuevo nombre para el archivo
            if (!empty($nuevo_nombre_archivo)) {
              // Copiar el archivo con el nuevo nombre
              if (copy($nombre_archivo, $nuevo_nombre_archivo)) {
                echo '<p class="success">El archivo ha sido copiado correctamente</p>';
              } else {
                echo '<p class="error">No se ha podido copiar el archivo</p>';
              }
            } else {
              echo '<p class="error">Debes especificar un nuevo nombre para el archivo</p>';
            }
            break;

          case 'renombrar':
            // Verificar si se especificó un nuevo nombre para el archivo
            if (!empty($nuevo_nombre_archivo)) {
              // Renombrar o mover el archivo
              if (rename($nombre_archivo, $nuevo_nombre_archivo)) {
                echo '<p class="success">El archivo ha sido renombrado o movido correctamente</p>';
              } else {
                echo '<p class="error">No se ha podido renombrar o mover el archivo</p>';
              }
            } else {
              echo '<p class="error">Debes especificar un nuevo nombre para el archivo</p>';
            }
            break;

          default:
            echo '<p class="error">Operación no válida</p>';
            break;
        }
      } else {
        echo '<p class="error">El archivo no existe</p>';
      }
    } else {
      echo '<p class="error">Debes especificar el nombre del archivo</p>';
    }
  }
  ?>

  <form method="POST">
    <label for="nombre_archivo">Nombre del archivo:</label>
    <input type="text" id="nombre_archivo" name="nombre_archivo">
    <label for="operacion">Operación:</label>
    <select id="operacion" name="operacion">
      <option value="borrar">Borrar</option>
      <option value="copiar">Copiar</option>
      <option value="renombrar">Renombrar o mover</option>
    </select>
    <label for="nuevo_nombre_archivo">Nuevo nombre (solo para renombrar o copiar):</label>
    <input type="text" id="nuevo_nombre_archivo" name="nuevo_nombre_archivo">
    <input type="submit" value="Ejecutar">
  </form>
</body>
</html>
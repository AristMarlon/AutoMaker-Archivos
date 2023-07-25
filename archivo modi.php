<!DOCTYPE html>
<html>
<head>
  <title>Gestión de archivos</title>
</head>
<body>
  <h1>Gestión de archivos</h1>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_archivo = $_POST['nombre_archivo'];
    $operacion = $_POST['operacion'];
    $nuevo_nombre = $_POST['nuevo_nombre'];

    $mensaje = gestionar_archivo($nombre_archivo, $operacion, $nuevo_nombre);

    echo '<p>' . $mensaje . '</p>';
  }
  ?>

  <form method="POST">
    <label for="nombre_archivo">Nombre del archivo:</label>
    <input type="text" id="nombre_archivo" name="nombre_archivo">
    <br>
    <label for="operacion">Operación:</label>
    <select id="operacion" name="operacion">
      <option value="renombrar">Renombrar</option>
      <option value="borrar">Borrar</option>
      <option value="copiar">Copiar</option>
    </select>
    <br>
    <label for="nuevo_nombre">Nuevo nombre (solo para renombrar o copiar):</label>
    <input type="text" id="nuevo_nombre" name="nuevo_nombre">
    <br>
    <input type="submit" value="Ejecutar">
  </form>
</body>
</html>
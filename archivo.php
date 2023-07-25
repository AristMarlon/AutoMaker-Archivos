<?php
// Función para conectar a la base de datos
function conectar_bd() {
  $conexion = mysqli_connect("localhost", "root", "", "vehiculos");
  if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
  }
  mysqli_set_charset($conexion, "utf8mb4");
  return $conexion;
}

// Función para obtener los datos de la tabla
function obtener_datos() {
  $conexion = conectar_bd();
  $query = "SELECT id, modelo, marca, `id del motor`, color, `num de asientos`, placa, precio FROM registro";
  $resultado = mysqli_query($conexion, $query);
  if (!$resultado) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
  }
  $datos = [];
  while ($fila = mysqli_fetch_assoc($resultado)) {
    $datos[] = $fila;
  }
  mysqli_close($conexion);
  return $datos;
}

// Función para exportar los datos en el formato seleccionado
function exportar_datos($datos, $tipo_archivo, $nombre_archivo) {
  if ($tipo_archivo === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="' . $nombre_archivo . '.json"');
    ob_start();
    echo json_encode($datos);
    $output = ob_get_clean();
    header('Content-Length: ' . strlen($output));
    echo $output;
  } elseif ($tipo_archivo === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $nombre_archivo . '.csv"');
    ob_start();
    $salida = fopen('php://output', 'w');
    fputcsv($salida, array_keys($datos[0]));
    foreach ($datos as $fila) {
      fputcsv($salida, $fila);
    }
    fclose($salida);
    $output = ob_get_clean();
    header('Content-Length: ' . strlen($output));
    echo $output;
  } elseif ($tipo_archivo === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Type: text/plain; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $nombre_archivo . '.txt"');
    ob_start();
    $salida = fopen('php://output', 'w');
    $cabecera = implode("\t", array_keys($datos[0])) . "\n";
    fwrite($salida, $cabecera);
    foreach ($datos as $fila) {
      $linea = implode("\t", $fila) . "\n";
      fwrite($salida, $linea);
    }
    fclose($salida);
    $output = ob_get_clean();
    header('Content-Length: ' . strlen($output));
    echo $output;
  } else {
    echo "Tipo de archivo no válido";
  }
}

// Si se ha enviado el formulario, exportar los datos
if (isset($_POST['tipo_archivo'])) {
  $tipo_archivo = $_POST['tipo_archivo'];
  $nombre_archivo = isset($_POST['nombre_archivo']) ? $_POST['nombre_archivo'] : 'datos';
  $datos = obtener_datos();
  exportar_datos($datos, $tipo_archivo, $nombre_archivo);
}
?>
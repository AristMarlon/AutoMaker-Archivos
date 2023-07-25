<?php
require_once 'C:/xampp/htdocs/marlon/pdf/dompdf/autoload.inc.php'; // Incluir la clase Dompdf

use Dompdf\Dompdf;

$host = "localhost";
$usuario = "root";
$contraseña = "";
$db = "vehiculos";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $contraseña);

    // Preparar y ejecutar la consulta SELECT
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `registro`");
    $sentenciaSQL->execute();

    // Obtener los resultados de la consulta
    $resultados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    // Crear un objeto Dompdf
    $pdf = new Dompdf();

    // Crear el contenido HTML del archivo PDF
    $html = '<html><body>';
    $html .= '<h1>Datos Automovilísticos</h1>';
    $html .= '<table style="border-collapse: collapse; width: 100%;">';
    $html .= '<tr style="background-color: #87ceeb;">';
    $html .= '<th style="border: 3px solid #21333a; padding: 8px;">ID</th>';
    $html .= '<th style="border: 3px solid #21333a; padding: 8px;">Modelo</th>';
    $html .= '<th style="border: 3px solid #21333a; padding: 8px;">Marca</th>';
    $html .= '<th style="border: 3px solid #21333a; padding: 8px;">ID del motor</th>';
    $html .= '<th style="border: 3px solid #21333a; padding: 8px;">Color</th>';
    $html .= '<th style="border: 3px solid #21333a; padding: 8px;">Número de Asientos</th>';
    $html .= '<th style="border: 3px solid #21333a; padding: 8px;">Placa</th>';
    $html .= '</tr>';
    foreach ($resultados as $fila) {
        $html .= '<tr style="border: 2px solid #3e8e41;">';
        $html .= '<td style="border: 2px solid #21333a; padding: 3px;">' . $fila['id'] . '</td>';
        $html .= '<td style="border: 2px solid #21333a; padding: 3px;">' . $fila['modelo'] . '</td>';
        $html .= '<td style="border: 2px solid #21333a; padding: 3px;">' . $fila['marca'] . '</td>';
        $html .= '<td style="border: 2px solid #21333a; padding: 3px;">' . $fila['id del motor'] . '</td>';
        $html .= '<td style="border: 2px solid #21333a; padding: 3px;">' . $fila['color'] . '</td>';
        $html .= '<td style="border: 2px solid #21333a; padding: 3px;">' . $fila['num de asientos'] . '</td>';
        $html .= '<td style="border: 2px solid #21333a; padding: 3px;">' . $fila['placa'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    $html .= '</body></html>';

    // Cargar el contenido HTML en el objeto Dompdf
    $pdf->loadHtml($html);

    // Renderizar el archivo PDF
    $pdf->render();

    // Descargar el archivo PDF
    $pdf->stream('datos_automovilisticos.pdf');

    $conexion = null;

} catch (PDOException $ex) {
    echo "<p style='color:red'>Error al conectar a la base de datos: " . $ex->getMessage() . "</p>";
}
?>
<?php
require_once('tcpdf/tcpdf.php');

$host = 'localhost';
$dbname = 'adopcion_mascotas';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
}

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetTitle('Registro de adopciones');

$pdf->SetMargins(25, 25, 25);

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 12);

// Generate the HTML table with the adoptions data
$html = '<h1>Reporte de adopciones</h1>';
$html .= '<table border="1">';
$html .= '<tr><th>ID Adopcion</th><th>Nombre Mascota</th><th>Nombre Persona</th><th>Fecha de Adopcion</th></tr>';

$sql = "SELECT adopciones.id, animales.nombre AS nombre_mascota, personas.nombre AS nombre_persona, adopciones.fecha_adopcion FROM adopciones JOIN animales ON adopciones.id_animal = animales.id JOIN personas ON adopciones.id_persona = personas.id";
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {
    $html .= '<tr>';
    $html .= '<td>' . $row['id'] . '</td>';
    $html .= '<td>' . $row['nombre_mascota'] . '</td>';
    $html .= '<td>' . $row['nombre_persona'] . '</td>';
    $html .= '<td>' . $row['fecha_adopcion'] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

// Write the HTML table to the PDF document
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF as a file download
$pdf->Output('Repoerte_adopciones.pdf', 'D');

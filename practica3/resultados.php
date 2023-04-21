
<?php 
// Include the Libchart library
include "libchart/classes/libchart.php";

$link = mysqli_connect("localhost", "root", "root");
mysqli_select_db($link, "votaciones");

// Get the vote counts for each party
$sql = "SELECT partido.nombre, COUNT(*) as count FROM voto 
        JOIN partido ON partido.id = voto.partido_id 
        GROUP BY partido.nombre";

$resultado = mysqli_query($link, $sql);

$dataset = new XYDataSet();

while ($row = mysqli_fetch_array($resultado)) {
    $dataset->addPoint(new Point($row['nombre'], $row['count']));
}

$chart = new HorizontalBarChart(600, 270);

$chart->setDataSet($dataset);

$chart->setTitle('Conteo de votos por partido');
$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));

$chart->render('generated/resultados.png');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Resultados</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <h2>Resultados</h2>
    <hr> 
    <img src="generated/resultados.png" alt="Resultados">
    </body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Resultados</h2>
    <hr>
    <?php
    $fp = fopen("votos.txt", 'r');
    $pri = 0;
    $pan = 0;
    $morena = 0;
    while (!feof($fp)) {
        $linea = fgets($fp);
        if (!empty($linea)) {
            $partes = explode(",", $linea);
            $partido = $partes[1];
            $partidoRecortado = trim($partido);
            switch ($partidoRecortado) {
                case 'pri':
                    $pri++;
                    break;
                case 'pan':
                    $pan++;
                    break;
                case 'morena':
                    $morena++;
                    break;

                default:
                    break;
            }
        }
    }

    echo "PRI:";
    for ($i = 0; $i < $pri; $i++) {
        echo "*";
    }
    echo "<br>";
    echo "PAN:";
    for ($i = 0; $i < $pan; $i++) {
        echo "*";
    }
    echo "<br>";
    echo "MORENA:";
    for ($i = 0; $i < $morena; $i++) {
        echo "*";
    }

    ?>
</body>

</html>

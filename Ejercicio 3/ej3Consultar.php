<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="Consultar BD">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="consultar vehiculos ">
        <meta charset="UTF-8">
        <title>Listar vehículos...</title>
    </head>

    <body>
        <?php

            /**
             * 
             * Función sencilla que convierte el valor a lo que significa.
             */
            function convierteValorAEstado($valor) {
                switch($valor) {
                    case 0:
                        $devuelve = "En espera.";
                        break;
                    case 1:
                        $devuelve = "Reparándose.";
                        break;
                    case 2:
                        $devuelve = "Reparado.";
                        break; 
                }

                return $devuelve;
            }


            switch ($_GET['tipo']){

                case 'todo':
                    $sql = 'SELECT * FROM vehiculos';
                    $titulo = 'Listado vehículos';
                    break;
                case 'espera':
                    $sql = 'SELECT * FROM vehiculos WHERE estado = 0';
                    $titulo = 'Listado por vehículos en ESPERA.';
                    break;
                case 'reparandose':    
                    $sql = 'SELECT * FROM vehiculos WHERE estado = 1';
                    $titulo = 'Listado por vehículos REPARÁNDOSE.';
                    break;  
                case 'reparado':
                    $sql = 'SELECT * FROM vehiculos WHERE estado = 2';
                    $titulo = 'Listado por vehículos REPARADOS.';
                    break;        
            }

        ?>
        <h1><?=$titulo?></h1>

        <table border="1">
            <tr>
                <td>ID de Seguimiento</td>
                <td>Matrícula</td>
                <td>Marca</td>
                <td>Modelo</td>
                <td>Fecha de Entrada</td>
                <td>Fecha de Salida</td>
                <td>Estado</td>
            </tr>
        <?php 
        
        $conexionBD = mysqli_connect("localhost", "root", "", "taller")
        or die("Hubo un error al conectar a la base de datos.");

        $consulta = mysqli_query($conexionBD, $sql);

        if ($consulta -> num_rows > 0) {
            while ($fila = $consulta -> fetch_assoc()){
                ?>
                <tr>
                    <td><?=$fila['id_seg']?></td>
                    <td><?=$fila['matricula']?></td>
                    <td><?=$fila['marca']?></td>
                    <td><?=$fila['modelo']?></td>
                    <td><?=$fila['fecha_entrada']?></td>
                    <td><?=$fila['fecha_recogida']?></td>
                    <td><?=convierteValorAEstado($fila['estado'])?></td>
                    <td><a href="ej3CambiarEstado.php?paso=2&id=<?=$fila['id_seg']?>"><img src="espera_reparando.png" alt="Cambiar estado a Reparando"></a></td>
                    <td><a href="ej3AnotarSalida.php?paso=2&id=<?=$fila['id_seg']?>"><img src="anotar_salida.png" alt="Anotar salida"></a></td>
                    <td><a href="ej3eliminarEntrada.php?paso=2&id=<?=$fila['id_seg']?>"><img src="eliminar.png" alt="Eliminar entrada"></a></td>
                </tr>
                <?php
            }
        } 
        ?>
        </table>
        <a href="index.php">Volver al inicio.</a>
    </body>
</html>
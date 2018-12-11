<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="Anotar Salida de vehículo">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="salida quiero dormir ayuda">
        <meta charset="UTF-8">
        <title>Anotar Salida de Vehículo</title>
        <style>

            .error {
                color: red;
            }

        </style>
    </head>

    <body>
        
        <?php 
        
        function imprimeForm1() {
        ?>
        <form action="ej3AnotarSalida.php" action="GET">
            <input type="hidden" name="paso" value="2"/>
            <table>
                <tr>
                    <td>Introduzca el identificador de vehículo: </td>
                    <td><input type="number" name="id"/></td>
                    <td><input type="submit" value="Buscar"/></td>
                </tr>
            </table>
        </form>
        <?php
        }

        function imprimeForm2() {
            ?>
            <form action="ej3AnotarSalida.php" action="GET">
                <input type="hidden" name="paso" value="3"/>
                <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
                <table>
                    <tr>
                        <td>Fecha de salida del vehículo: </td>
                        <td><input type="date" name="fecha_salir"/></td>
                        <td><input type="submit" value="Anotar"/></td>
                    </tr>
                </table>
            </form>
            <?php
            }
    
        if ($_GET['paso'] == 1) {

            imprimeForm1();

        } else if ($_GET['paso'] == 2) {
            if ($_GET['id'] != null) {
                $sql = "SELECT * FROM vehiculos WHERE id_seg = ".$_GET['id'];

                $conexionBD = mysqli_connect("localhost", "root", "", "taller")
                or die("Error al conectar con la base de datos.");

                $consulta = mysqli_query($conexionBD, $sql);

                if ($consulta -> num_rows == 0) {

                    imprimeForm1();

                    ?>

                    <p class="error">No existe ningún vehículo con ese identificador</p>

                    <?php

                } else {
                    ?>
                    <p>Registrando la salida del siguiente vehículo: </p> 
                    <?php
                    while ($fila = $consulta -> fetch_assoc()){
                        ?>
                    <p>ID: <?=$fila['id_seg']?></p>
                    <p>Marca: <?=$fila['marca']?></p>
                    <p>Modelo: <?=$fila['modelo']?></p>
                    <p>Matricula: <?=$fila['matricula']?></p>
                    <p>Fecha de Entrada: <?=$fila['fecha_entrada']?></p>
                    <br>
                        <?php
                    }
                    imprimeForm2();
                }
            } else {
                imprimeForm1();

                ?>
                <p class="error">Introduzca un identificador.</p>
                <?php
            }
        } else if ($_GET['paso'] == 3) {

            $actualiza = 'UPDATE vehiculos SET `fecha_recogida` = "'.$_GET['fecha_salir'].'" WHERE id_seg = '.$_GET['id'];

            $conexionBD = mysqli_connect("localhost", "root", "", "taller");

            if ($conexionBD -> query($actualiza) == TRUE) {
                ?>
                    <p>La salida del vehículo con identificador <?=$_GET['id']?> ha sido anotada con éxito.</p>

                    <a href="index.php">Volver al inicio</a>

                <?php
            } else {
                ?>  

                <p class="error">Ha habido un error al actualizar los datos: <?= $conexionBD -> error; ?>
                
                <?php
            }
        }
        ?>

    </body>
</html>
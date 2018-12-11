<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="cambiarEstado">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="estado cambiar hola quierodormir soncasilasunadelamañana">
        <meta charset="UTF-8">
        <title>Actualizar estado de vehículo</title>
        <style>

            .error {
                color: red;
            }

        </style>
    </head>

    <body>

    <?php 

        function imprimeForm() {
            ?>
        <form action="ej3CambiarEstado.php" action="GET">
            <input type="hidden" name="paso" value="2"/>
            <table>
                <tr>
                    <td>Introduzca el identificador de vehículo: </td>
                    <td><input type="number" name="id"/></td>
                    <td><input type="submit" value="Cambiar estado"/></td>
                </tr>
            </table>
        </form>
    <?php
        }

        if($_GET['paso'] == 1) {
            imprimeForm();
        } else if ($_GET['paso'] == 2) {
        
            if ($_GET['id'] != null) {
                $sql = "SELECT * FROM vehiculos WHERE id_seg = ".$_GET['id'];

                $conexionBD = mysqli_connect("localhost", "root", "", "taller")
                or die("Error al conectarse con la base de datos.");

                $consulta = mysqli_query($conexionBD, $sql);

                if ($consulta -> num_rows == 0) { 
                    
                    imprimeForm();
                    
                    ?>
                    <p class="error">No existe ningún vehículo con ese identificador.</p>
                <?php
                } else {
                    $sqlUpdate = "UPDATE vehiculos SET estado = 1 WHERE id_seg = ".$_GET['id'];

                    if ($conexionBD -> query($sqlUpdate) == TRUE) {
                        ?>

                        <p>El vehículo con identificador <?=$_GET['id']?> ha sido actualizado a "Reparándose."</p>
                        
                        <p>Datos del vehículo actualizados.</p>
                        <?php

                        if ($consulta -> num_rows > 0){
                            while ($fila = $consulta -> fetch_assoc()){
                               echo "<p> ID: ".$fila['id_seg'].". Marca: ".$fila['marca'].". Modelo: ".$fila['modelo'].". Matrícula: ".$fila['matricula'].". Fecha de entrada en taller: ".$fila['fecha_entrada'].".</p>";
                               echo "</br>";
                               echo '<a href="index.php">Volver al inicio</a>';
                            }
                        }
                    } else {
                        ?>  

                        <p class="error">Ha habido un error al actualizar los datos: <?= $conexionBD -> error; ?>
                        
                        <?php
                    }
                }
            } else {
                imprimeForm();

                ?>
                    <p class="error">Introduzca un identificador.</p>
                <?php
            }
        
        }
        
        ?>
    </body>
</html>
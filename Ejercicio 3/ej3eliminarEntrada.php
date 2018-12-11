<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="Eliminar entrada">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="eliminar entrada quiero dormir">
        <meta charset="UTF-8">
        <title>Eliminar Entrada</title>
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
    <form action="ej3eliminarEntrada.php" action="GET">
        <input type="hidden" name="paso" value="2"/>
        <table>
            <tr>
                <td>Introduzca el identificador de vehículo: </td>
                <td><input type="number" name="id"/></td>
                <td><input type="submit" value="Borrar"/></td>
            </tr>
        </table>
    </form>
    <?php
    }

        if ($_GET['paso'] == 1) {
            
            imprimeForm();

        } else if ($_GET['paso'] == 2) {

            if ($_GET['id'] != null) {

                $sql = "SELECT * FROM vehiculos WHERE id_seg = ".$_GET['id'];

                $sqlDel = 'DELETE FROM vehiculos WHERE id_seg = '.$_GET['id'];

                $conexionBD = mysqli_connect("localhost", "root", "", "taller")
                or die("Hubo un error al conectarse a la base de datos.");

                $consulta = mysqli_query($conexionBD, $sql);

                if ($consulta -> num_rows == 0) {

                    imprimeForm();
                    ?>
                    <p class="error">No existe ningún vehículo con ese identificador</p>
                    <?php

                } else {
                    
                if ($conexionBD -> query($sqlDel) == TRUE) {
                    ?>
                        <p>El vehículo con el identificador <?= $_GET['id'] ?> ha sido eliminado de la base de datos</p>
                        <a href="index.php">Volver al inicio.</a>
                    <?php
                } else {
                    ?>
                        <p class="error">Hubo un error al intentar realizar la transacción: <?=$conexionBD -> error; ?></p>
                    <?php
                }
                }
            } else{
                imprimeForm();
                ?>
                <p class="error">Introduzca un identificador.</p>
                <?php
            }
        }
    ?>
    </body>
</html>
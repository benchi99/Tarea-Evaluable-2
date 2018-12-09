<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="cambiarEstado">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="estado cambiar hola quierodormir soncasilasunadelamañana">
        <meta charset="UTF-8">
        <title>Actualizar estado de vehículo</title>
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
        
        ?>

        <?php 
        
        }
        
        ?>
    </body>
</html>
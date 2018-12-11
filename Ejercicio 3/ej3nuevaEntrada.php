<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="Añadir un nuevo vehículo a la base de datos">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="vehiculo taller aylmao quiero descansar por favor">
        <meta charset="UTF-8">
        <title>Anotar entrada</title>
    </head>

    <body>

        <?php 
            function ValorPost($nombre, $valorPorDefecto='') {
                if (isset ($_POST[$nombre])){
                    return $_POST[$nombre];
                } else {
                    return $valorPorDefecto;
                }
            }
            
            if ($_GET['paso'] == 1) {                
        ?>

        <h1>Anotar entrada de nuevo vehículo.</h1>
        
        <form action="ej3nuevaEntrada.php?paso=2" method="POST">
            <table>
                <tr>
                    <td>Nº Seguimiento</td>
                    <td><input type="number" name="seguimiento" value="<?=ValorPost($seguimiento)?>"/></td>
                    <td>Matrícula</td>
                    <td><input type="text" name="matricula" maxlength="7"/></td>
                    <td>Modelo</td>
                    <td><input type="text" name="modelo" maxlength="20"/></td>
                </tr>
                <tr>
                    <td>Fecha Entrada</td>
                    <td><input type="date" name="fechaEntrada"/></td>
                    <td>Marca</td>
                    <td><input type="text" name="marca" maxlength="15"/></td>
                </tr>
            </table>
            
            <input type="submit" value="Anotar entrada"/>
            <input type="reset" value="Vaciar formulario"/>
        </form>

        <?php 
            } else if ($_GET['paso'] == 2) {
        
                $num_seg = $_POST['seguimiento'];
                $fecha_entrada = $_POST['fechaEntrada'];
                $matricula = $_POST['matricula'];
                $marca = $_POST['marca'];
                $modelo = $_POST['modelo'];
        
                $conexionBD = mysqli_connect("localhost", "root", "", "taller")
                or die("fuck");
                
                $sql = 'INSERT INTO vehiculos VALUES ("'.$num_seg.'", "'.$fecha_entrada.'", "'.$matricula.'", "'.$modelo.'", 0, NULL, "'.$marca.'");';
                
                if ($conexionBD -> query($sql) == TRUE){
                ?>
                    <p>Datos insertados correctamente.</p>
                
                <?php 
                } else {
                    include "ej3nuevaEntrada.php?paso=1";
                ?>
                    <p>Hubo un error al introducir los datos en la base de datos.</p>
                    <p><?= $conexionBD->error ?></p>
                <?php
                }
                ?>
                    <a href="index.php">Volver al inicio</a>
                <?php
            }
        ?>
    </body>
</html>
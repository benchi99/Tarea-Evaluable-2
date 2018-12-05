<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="indice de consultas">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="paises sql">
        <meta charset="UTF-8">
        <title>Actividad 2</title>
    </head>

    <?php 
    $conexionBD = mysqli_connect("localhost", "root", "", "paises");
    mysqli_set_charset($conexionBD, "utf8");

    if(!$conexionBD){
        die("Ha habido un problema al conectarse a la base de datos.");
    }
    
    $sql = 'SELECT continente FROM paises GROUP BY continente';
    $consulta = mysqli_query($conexionBD, $sql);
    ?>

    <body>
        <h1>Listado de países del mundo</h1>
        <ul>
            <li><a href="ej2logica.php?opt=todos">Todos los países</a></li>
            <li><a href="ej2logica.php?opt=europa">Países de "Europa"</a></li>
            <li><a href="ej2logica.php?opt=nomoneda">Países que no tienen definida moneda</a></li>

            <br>

            <form action="ej2logica.php" method="POST">
                <select name="continentes">
                <?php 
                while($registro = mysqli_fetch_array($consulta)) { ?>
                    <option value="<?=$registro['continente']?>"><?=$registro['continente']?></option>
               <?php }
                ?>
                </select>
                <input type="submit" name="enviar" value="Ver países" />
            </form>
        </ul>
    </body>
</html>
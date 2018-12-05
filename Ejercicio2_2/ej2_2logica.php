<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="logica">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="sql procesarlotodo">
        <meta charset="UTF-8">
    </head>

    <?php 
    if (!$_POST){
        switch ($_GET['opt']) {
            case 'todos':
                $sql = "select * from paises";        
                break;
            case 'europa':
                $sql = "select * from paises where continente = 'Europa'";        
                break;
            case 'nomoneda':
                $sql = "select * from paises where iso_moneda is null";        
                break;
        }
    } else {
        $sql = "select * from paises where continente = '". $_POST['continentes'] ."'";
    }

    $conexionDB = mysqli_connect("localhost", "root", "", "paises");
    mysqli_set_charset($conexionDB, "utf8");
    
    if (!$conexionDB){
        die("No pudo hacerse la conexión al servidor.");
    }
    $consulta = mysqli_query($conexionDB, $sql);
    
    ?>
    <body>
        <table border="1" align="center">
            <tr>
                <td>Nombre</td>
                <td>Iso3</td>
                <td>Continente</td>
                <td>Nombre de moneda</td>
            </tr>
        <?php 
            while($registro = mysqli_fetch_array($consulta)) { 
                $i = 0;
                if ($i > 20) {
                    break;
                } else{
                    $i++;
                }
                ?>
            <tr>
                <td><?=$registro['nombre']?></td>
                <td><?=$registro['iso3']?></td>
                <td><?=$registro['continente']?></td>
                <td><?=$registro['nombre_moneda']?></td>
            </tr>
        <?php 
            }
        ?>
        </table>
    </body>
</html>
<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="logica">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="sql procesarlotodo">
        <meta charset="UTF-8">
    </head>

    <?php 

    $RESULTADO_POR_PAGINA = 20;

    if (!$_GET['pagina']) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
        $inicio = ($pagina - 1) * $RESULTADO_POR_PAGINA;
    }

    if (!$_POST){
        switch ($_GET['opt']) {
            case 'todos':
                $sql = "select * from paises limit ".$inicio.",".$RESULTADO_POR_PAGINA;        
                break;
            case 'europa':
                $sql = "select * from paises where continente = 'Europa' limit ".$inicio.",".$RESULTADO_POR_PAGINA;
                break;
            case 'nomoneda':
                $sql = "select * from paises where iso_moneda is null limit ".$inicio.",".$RESULTADO_POR_PAGINA;        
                break;
        }
    } else {
        $sql = "select * from paises where continente = '". $_POST['continentes'] ."' limit ".$inicio.",".$RESULTADO_POR_PAGINA;
    }

    $conexionDB = mysqli_connect("localhost", "root", "", "paises");
    mysqli_set_charset($conexionDB, "utf8");
    
    if (!$conexionDB){
        die("No pudo hacerse la conexión al servidor.");
    }
    $consulta = mysqli_query($conexionDB, $sql);

    $total_registros = $consulta -> num_rows;
    $total_pgs = ceil($total_registros/$RESULTADO_POR_PAGINA);
    
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
        <?php
            if ($total_pgs > 1) {
                for ($i = 1; $i <=$total_pgs;$i++){
                    if ($pagina == $i) {
                        echo $pagina." ";
                    } else {
        ?>
            <a href="ej2_2logica.php?pagina<?=$i?>"><?=$i?></a>
        <?php 
                    }
                }
            }
        ?>
    </body>
</html>
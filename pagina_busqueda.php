<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Busqueda</title>
    </head>
<body>
<?php

$busqueda=$_GET["buscar"];
require("datos_conexion.php");

$enlace = mysqli_connect ($servidor, $usuario, $clave, $baseDeDatos);
if(mysqli_connect_errno()){
    echo "Fallo al conectar con la BDD";
    exit();
}

$arreglo_columnas=array("Nombre: ","Lugar: ","Cantidad: ","Estado: ", "Descripcion: ", "Valor: ");
mysqli_set_charset($enlace, "utf8");
$consulta= "SELECT nombre_producto, lugar_producto, cantidad_producto, estado_producto, descripcion_producto, valor FROM PRODUCTO where id_producto like '%$busqueda%'";
                $resultados=mysqli_query($enlace,$consulta);
                while($fila=mysqli_fetch_row($resultados)){
                    for($i=0; $i<count($fila); $i++){
                      echo $arreglo_columnas[$i] . " " . $fila[$i] . " ";
                      echo "<br>";
                    }
                   echo "<br>";
              }
                if(isset($_POST['registro'])){ /*convertir campos a variables*/
                    $nombre= $_POST['nombre'];
                    $lugar= $_POST['lugar'];
                    $cantidad= $_POST['cantidad'];
                    $estado= $_POST['estado'];
                    $descripcion= $_POST['descripcion'];
                    $valor= $_POST['valor'];
                    $campos = array();
                    /*Comprobar que el campo nombre no esté vacío*/
                    if($nombre==""){
                        array_push($campos, "El campo nombre no puede estar vacío");
                    };
                    if (count($campos)>0){  /*Recorrer arreglo para mostrar mensajes de error en caso de que los haya */
                        echo "<div class='error'>";
                        for ($i=0;$i < count($campos);$i++){
                            echo "<li>".$campos[$i]."</i>";
                        }
                    } else {  /*En caso de no haber errores, inviar datos a la base de datos */
                        echo "<div class='correcto'>
                                Datos correctos";
                        $insertarDatos = "INSERT INTO producto values ('','$nombre','$lugar','$cantidad','$estado','$descripcion','$valor')";

                        $ejecutarInsertar = mysqli_query ($enlace, $insertarDatos);
                    }
                    echo "</div>";
                }
                mysqli_close($enlace);
?>
</body>
</html>
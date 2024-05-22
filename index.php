<?php

   
?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Formulario</title>
        </head>
        <body>
            <form action="#" name="inventario" method="post">


            
                <input type="text" name="nombre" placeholder="nombre">
                <br>
                <input type="text" name="lugar" placeholder="lugar">
                <br>
                <input type="text" name="cantidad" placeholder="cantidad">
                <br>
                <input type="text" name="estado" placeholder="estado">
                <br>
                <input type="text" name="descripcion" placeholder="descripcion">
                <br>
                <input type="text" name="valor" placeholder="valor">
                <br>

                <input type="submit" name="registro">
                <input type="reset">
                <br>

                <?php

                require("datos_conexion.php");

                $enlace = mysqli_connect ($servidor, $usuario, $clave, $baseDeDatos);
                if(mysqli_connect_errno()){
                    echo "Fallo al conectar con la BDD";
                    exit();
                }

                mysqli_set_charset($enlace, "utf8");
                $consulta= "SELECT id_producto FROM PRODUCTO";
                $resultados=mysqli_query($enlace,$consulta);
                while($fila=mysqli_fetch_row($resultados)){
                    for($i=0; $i<count($fila); $i++){
                      echo $fila[$i] . " ";
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
            </form>
        </body>
    </html>
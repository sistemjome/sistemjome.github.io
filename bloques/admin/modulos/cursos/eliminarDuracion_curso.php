<?php
include('../../../../base_datos/bd.php');

//Borrar información de la BD (el botón borrar nos envía la PK)
if(isset($_GET['id'])) {
    $agencia = $_GET['agencia'];

    //Cogemos el código (PK) en la tabla de la información que queremos borrar
    $id = (isset($_GET['id']))?$_GET['id']:"";

   //Preparamos la sentencia para borrar la información en la base de datos
    $sentencia = $conexion->prepare("DELETE FROM duracion_cursos WHERE id_duracion = :id 
    AND agencia = :agencia");
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->execute();

?><script
src = "../../../.././alertas/eliminado.js">
</script><?php

}

?>
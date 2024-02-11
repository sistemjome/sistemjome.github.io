<?php
include('../../../../base_datos/bd.php');

//Borrar información de la BD (el botón borrar nos envía la PK)
if(isset($_GET['id'])) {
    $agencia = $_GET['agencia'];

    //Cogemos el código (PK) en la tabla de la información que queremos borrar
    $id = (isset($_GET['id']))?$_GET['id']:"";

    //buscar el archivo relacionado con el empleado (imagen o documento)
    $sentencia = $conexion->prepare("SELECT foto_personal FROM personal
    WHERE email_personal = :id 
    AND agencia = :agencia");
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->execute();
    $lista_personal = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($lista_personal as $registro_recuperado);

    if(isset($registro_recuperado["foto_personal"]) && $registro_recuperado["foto_personal"]!="") {

        if(file_exists("./".$registro_recuperado["foto_personal"])) {
            unlink("./".$registro_recuperado["foto_personal"]);
        }

    }

   //Preparamos la sentencia para borrar la información en la base de datos
    $sentencia = $conexion->prepare("DELETE FROM personal WHERE email_personal = :id 
    AND agencia = :agencia");
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->execute();

?><script
src = "../../../.././alertas/eliminado.js">
</script><?php

}



?>
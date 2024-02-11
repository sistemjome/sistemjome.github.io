<?php

$servidor = "154.56.34.16";
$bd = "u937208163_jome";
$usuario = "u937208163_edmupgroup";
$clave = "Juan011099Reyes";

try {

    $conexion = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$clave);

} catch(Exception $ex) { 
    
    header("Location: error.php");

}
?>
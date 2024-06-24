<?php
require('./conexion.php');

try {
    // Obtener el ID del registro a eliminar
    $id_m=$_REQUEST["id_m"];
    $def=$_REQUEST["def"];

    // Eliminar el registro de la base de datos
    if($def==$id_m){
        $sql = "DELETE FROM users3m WHERE id_m=$id_m";
    }else{
        $sql="UPDATE users3m SET estado='inactivo' WHERE id_m=$id_m";
    }
    if ($conn->query($sql) === TRUE) {
        header("Location:listamascotas.php");
        exit();
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
        /* header("Location:listamascotas.php"); */
    }
} catch (Exception $e) {
    include 'header.php';
    echo "<h6 class='text-center m-4'>Error:  ". $e->getMessage();
    echo "</h6>";
    include 'footer.php';
}

    // Cerrar la conexión
$conn->close();
?>

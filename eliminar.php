<?php
require('./conexion.php');

try {
    // Obtener el ID del registro a eliminar
    $id=$_REQUEST["id"];
    $def=$_REQUEST["def"];

    // Verificar si hay mascotas asociadas a este dueño
    $sql = "SELECT COUNT(*) as count FROM users3m WHERE id_duenio = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        throw new Exception("No se puede borrar. Hay mascotas asociadas a este dueño. Borre las mascotas primero y luego intente eliminar al dueño.");
    }

    // Eliminar el registro de la base de datos segun sea borrado logico o definitivo
    if($def==$id){
        $sql = "DELETE FROM users3 WHERE id=$id";
    }else{
        $sql="UPDATE users3 SET estado='inactivo' WHERE id=$id";
    }
    
    if ($conn->query($sql) === TRUE) {
        header("Location:listar.php");
        exit();
    } else {
        throw new Exception("Error al eliminar el registro: " . $conn->error);
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

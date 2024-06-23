<?php
require('./conexion.php');
try {
    // Obtener el ID del registro a eliminar
    $ida = $_GET['ida'];
    $def=$_REQUEST["def"];
    // Eliminar el registro de la base de datos segun sea borrado logico o definitivo
    if($def==$ida){
        $sql = "DELETE FROM admins1m WHERE ida=$ida";
    }else{
        $sql="UPDATE admins1m SET estado='0' WHERE ida=$ida";
    }
    if ($conn->query($sql) === TRUE) {
        header("Location:listadoadmins.php");
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
        header("Location:listadoadmins.php");
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

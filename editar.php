<?php
require('./conexion.php');

if ((isset($_POST['Modificar']))) {

    extract($_POST);
    $estado = isset($estado) ? '1' : '0';
   $sql="UPDATE users3 SET  nombre='$nombre', 
                            direccion='$direccion', 
                            email='$email', 
                            telefono='$telefono',
                            estado='$estado'
                            WHERE id=$id";
   $result=mysqli_query($conexion, $sql);
   
   if ($conn->query($sql) === TRUE) {
    // Redirección a la página deseada después del procesamiento
    header("Location: listar.php"); 
    exit(); // Asegura que el código se detenga después de la redirección
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }

$conn->close();
}

// Obtener los datos del registro actual
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

$id=$_REQUEST["id"];
//echo $id;
$sql="select * from users3 where id='$id'";
$result=mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
                  

// Cerrar la conexión
$conn->close();

include "header.php"; 
?>  

<h2 class="m-4">Editar Usuario</h2>
<div class="container mx-auto bg-light mw-75 vh-100">
    <form class="mx-2" action="editar.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <label class="row form-label" for="nombre">Nombre:</label>
        <input class="row form-control" type="text" name="nombre" value="<?= $row['nombre'] ?>">
        <label class="row form-label" for="direccion">Dirección:</label>
        <input class="row form-control" type="text" name="direccion" value="<?= $row['direccion'] ?>">
        <label class="row form-label" for="email">Email:</label>
        <input class="row form-control" type="email" name="email" value="<?= $row['email'] ?>">
        <label class="row form-label" for="telefono">Teléfono:</label>
        <input class="row form-control" type="text" name="telefono" value="<?= $row['telefono'] ?>"><br/>
        <div class="d-flex align-items-center gap-2">
            <div class="form-check form-switch">
                <label class="form-check-label" for="flexCheckChecked">Estado inactivo/activo
                <input class="form-check-input" type="checkbox" role="switch"  name="estado" value="" <?= $row['estado'] == '1' ? 'checked' : '' ?>><br/>
            </div>
            <div class="d-flex m-2 d-sm-block gap-2">
                <a href="eliminar.php?id_m=<?= $row['id'] ?>&def=<?= $row['id'] ?>" class="btn btn-outline-danger">Eliminado definitivo</a>
            </div>
        </div>                 
        <div class='d-flex justify-content-center align-items-center m-2  gap-2'>
            <input type="submit" class="btn btn-outline-info" name="Modificar" value="Actualizar">
            <a href="listar.php#<?= $id?>" class="btn btn-outline-success m-4">Volver a dueños</a>
        </div>
    </form>
</div>
</main>
<?php
include 'footer.php';
?>
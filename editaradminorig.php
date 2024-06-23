<?php
require('./conexion.php');

// Obtener el ID del registro a editar
$ida = $_REQUEST['ida'];

// Procesar la actualización del registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los nuevos valores del formulario
    $newNombre = $_POST['nombre'];
    $newUserName = $_POST['nombreadmin'];
    $newPass = $_POST['contrasenia'];

    $sql = "UPDATE admins1m SET nombre='$newNombre', nombreadmin='$newUserName', contrasenia='$newPass' WHERE ida=$ida";
            
    if ($conn->query($sql) === TRUE) {
        //echo "Registro actualizado correctamente";
        // Redirección a la página deseada después del procesamiento
        header("Location: listadoadmins.php"); 
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

$sql = "SELECT ida, nombre, nombreadmin, contrasenia FROM admins1m WHERE ida=$ida";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Cerrar la conexión
$conn->close();

include "header.php"; 
?>  

<h2 class="m-4">Editar Usuario</h2>
<div class="container w-50 bg-light vh-100">
    <form class="mx-2" action="editaradmin.php?ida=<?= $ida ?>" method="POST">
        <input type="hidden" name="ida" value="<?= $row['ida'] ?>">
        <label class="row form-label" for="nombre">Nombre:</label>
        <input class="row form-control" type="text" name="nombre" value="<?= $row['nombre'] ?>">
        <label class="row form-label" for="nombre">Nombre de usuario admin:</label>
        <input class="row form-control" type="text" name="nombreadmin" value="<?= $row['nombreadmin'] ?>">
        <label class="row form-label" for="contrasenia">Contraseña:</label>
        <input class="row form-control" type="password" name="contrasenia" value="<?= $row['contrasenia'] ?>"><br/>
        <div class='d-flex w-50 m-2 d-sm-block gap-2'>
            <input type="submit" class="btn btn-outline-info" value="Actualizar">
            <input type="button" class="btn btn-outline-success mx-6" onclick="window.location.href='home.php'" value="Volver">
        </div>
    </form>
</div>
</main>
<?php
include 'footer.php';
?>
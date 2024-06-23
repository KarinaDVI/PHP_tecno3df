<?php
require('./conexion.php');

/* $ida = $_GET['ida'] ?? null;
if (!$ida) {
    die("ID de admin no especificado");
}
 */

$ida = $_REQUEST["ida"];
$sql = "select ida, nombre, nombreadmin, estado from admins1m where ida = '$ida'";

// Obtener los datos del registro actual
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error al obtener los datos de admin: " . $conn->error);
}
$row = mysqli_fetch_array($result);

// Procesar la actualización del registro
if (isset($_POST['Modificar'])) {
    extract($_POST);

    $estado = isset($estado) ? '1' : '0';
    /* $contrasenia=$_POST['contrasenia']; */
    $contrasenia_hash =password_hash($contrasenia, PASSWORD_DEFAULT);

    $sql = "UPDATE admins1m SET
                    nombre = '$nombre',
                    nombreadmin = '$nombreadmin',
                    contrasenia = '$contrasenia_hash',
                    estado='$estado'
                    WHERE ida = $ida";

    if ($conn->query($sql) === TRUE) {
        // Redirección a la página deseada después del procesamiento
        header("Location: listadoadmins.php");
        exit(); // Asegura que el código se detenga después de la redirección
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($conn);
    }


}

// Cerrar la conexión
$conn->close();

include "header.php";

?>  

<h2 class="m-4">Editar Usuario</h2>
<div class="container mx-auto bg-light mw-75 vh-100 vh-100">
    <form class="mx-2" action="editaradmin.php?ida=<?= $ida ?>" method="POST">
        <input type="hidden" name="ida" value="<?= $row['ida'] ?>">
        <label class="row form-label" for="nombre">Nombre:</label>
        <input class="row form-control" type="text" name="nombre" value="<?= $row['nombre'] ?>">
        <label class="row form-label" for="nombre">Nombre de usuario admin:</label>
        <input class="row form-control" type="text" name="nombreadmin" value="<?= $row['nombreadmin'] ?>">
        <label class="row form-label" for="contrasenia">Contraseña:</label>
        <input class="row form-control" type="password" name="contrasenia" value=""><br/>
        <div class="d-flex align-items-center gap-2">
            <div class="form-check form-switch">
                <label class="form-check-label" for="flexCheckChecked">Estado inactivo/activo
                <input class="form-check-input" type="checkbox" role="switch"  name="estado" value="" <?= $row['estado'] == '1' ? 'checked' : '' ?>><br/>
            </div>
            <div class="d-flex m-2 d-sm-block gap-2">
                <a href="eliminaradmin.php?ida=<?= $row['ida'] ?>&def=<?= $row['ida'] ?>" class="btn btn-outline-danger">Eliminado definitivo</a>
            </div>
        </div>    
        <div class='d-flex justify-content-center align-items-center m-2  gap-2'>
            <input type="submit" class="btn btn-outline-info" name="Modificar" value="Actualizar">
            <input type="button" class="btn btn-outline-success mx-6" onclick="window.location.href='home.php'" value="Volver">
        </div>
    </form>
</div>
</main>
<?php
include 'footer.php';
?>
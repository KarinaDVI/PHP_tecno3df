<?php
require('./conexion.php');

$ida = $_REQUEST["ida"];
$sql = "select ida, nombre, nombreadmin, contrasenia, estado, perfil from admins1m where ida = '$ida'";

// Obtener los datos del registro actual
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error al obtener los datos de admin: " . $conn->error);
}
$row = mysqli_fetch_array($result);
$hashed_password = $row['contrasenia']; //Guardo la contraseña de la base

// Procesar la actualización del registro
if (isset($_POST['Modificar'])) {
    extract($_POST);

    $estado = isset($estado) ? 'activo' : 'inactivo';

    if (!empty($contrasenia)) {
        $contrasenia_hash = password_hash($contrasenia, PASSWORD_DEFAULT);
    } else {
        $contrasenia_hash = $hashed_password; // Usar la contraseña actual si no se ingresa nada.
    }

    $sql = "UPDATE admins1m SET
                    nombre = '$nombre',
                    nombreadmin = '$nombreadmin',
                    contrasenia = '$contrasenia_hash',
                    estado='$estado',
                    perfil='$perfil'
                    WHERE ida = $ida";

    if ($conn->query($sql) === TRUE) {
        header("Location: listadoadmins.php");
        exit(); 
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($conn);
    }


}

// Cerrar la conexión
$conn->close();

include "header.php";

?>  

<h2 class="m-4">Editar Usuarios</h2>
<div class="container mx-auto bg-light mw-75 vh-100 vh-100">
    <form class="mx-2" action="editaradmin.php?ida=<?= $ida ?>" method="POST">
        <input type="hidden" name="ida" value="<?= $row['ida'] ?>">
        <label class="row form-label" for="nombre">Nombre:</label>
        <input class="row form-control" type="text" name="nombre" value="<?= $row['nombre'] ?>">
        <label class="row form-label" for="nombre">Nombre de usuario admin:</label>
        <input class="row form-control" type="text" name="nombreadmin" value="<?= $row['nombreadmin'] ?>">
        <label class="row form-label" for="contrasenia">Contraseña:</label>
        <input class="row form-control" type="password" name="contrasenia" placeholder="Solo ingrese contraseña si va a cambiarla"><br/>
        <label class="row form-label" for="perfil">Perfil:</label>
            <select class="form-select" aria-label="Default select example" name="perfil" id="perfil">
                <option value="usuario" <?= ($row['perfil'] == 'usuario') ? 'selected' : '' ?>>usuario</option>
                <option value="administrador" <?= ($row['perfil'] == 'administrador') ? 'selected' : '' ?>>administrador</option>
                <?php if ($_SESSION['Perfil'] == 'maestro'):?><!-- Solo ven esta opcion los usuarios de acceso pleno -->
                <option value="administrador" <?= ($row['perfil'] == 'maestro') ? 'selected' : '' ?>>maestro</option>
                <?php endif;?>
            </select>
        <div class="d-flex align-items-center gap-2">
            <div class="form-check form-switch">
                <label class="form-check-label" for="flexCheckChecked">Estado inactivo/activo
                <input class="form-check-input" type="checkbox" role="switch"  name="estado" value="" <?= $row['estado'] == 'activo' ? 'checked' : '' ?>><br/>
            </div>
            <div class="d-flex m-2 d-sm-block gap-2">
                <a href="eliminaradmin.php?ida=<?= $row['ida'] ?>&def=<?= $row['ida'] ?>" class="btn btn-outline-danger">Eliminado definitivo</a>
            </div>
        </div>    
        <div class='d-flex justify-content-center align-items-center m-2  gap-2'>
            <input type="submit" class="btn btn-outline-info" name="Modificar" value="Actualizar">
            <a href="listadoadmins.php#<?= $ida?>" class="btn btn-outline-success m-4">Volver</a>
        </div>
    </form>
</div>
</main>
<?php
include 'footer.php';
?>
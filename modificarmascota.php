<?php
require('./conexion.php');


$id_m = $_GET['id_m'] ?? null;
if (!$id_m) {
    die("ID de mascota no especificado");
}

// Obtener los datos del registro actual
$id_m=$_REQUEST["id_m"];
$sql_select = "SELECT id_m, nombremascota, especie, sexo, peso, imgurl, observaciones, edad, fecha_nacimiento, historia_clinica, id_duenio, estado FROM users3m WHERE id_m=$id_m";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

$result = mysqli_query($conn, $sql_select);
if (!$result) {
    die("Error al obtener los datos de la mascota: " . $conn->error);
}

$row = mysqli_fetch_array($result);

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_hora_actual = date("d/m/Y  H:i ");

// Procesar la actualización del registro si se envió el formulario
if (isset($_POST['ModificarMascota'])) {
    extract($_POST);
    $estado = isset($estado) ? '1' : '0';
    // Preparar la consulta SQL de actualización
    $sql_update = "UPDATE users3m SET nombremascota='$nombremascota', especie='$especie', sexo='$sexo', peso='$peso', observaciones='$observaciones', imgurl='$imgurl', edad='$edad', fecha_nacimiento='$fecha_nacimiento', historia_clinica='$historia_clinica',estado='$estado' WHERE id_m=$id_m";

    if ($conn->query($sql_update) === TRUE) {
        // Redirigir a la página de mostrar mascota con el ID del dueño
        $cons = $row['id_duenio'];
        header("Location: mostrarmascota.php?id=$cons");
        exit(); // Asegura que el código se detenga después de la redirección
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!-- Ahora construimos el formulario HTML -->
<?php include "header.php"; ?>

<h2 class="m-4">Editar Mascota</h2>
<div class="container container mw-sm-80 mw-lg-60 mx-auto bg-light mx-auto vh-100">
    <form class="mx-2 row mb-5" action="modificarmascota.php?id_m=<?= $id_m ?>" method="POST">
    <div class="col-md mx-2">
        <input type="hidden" name="id_m" value="<?= $row['id_m'] ?>">
        <label class="row form-label" for="nombremascota">Nombre de Mascota:</label>
        <input class="row form-control" type="text" name="nombremascota" value="<?= $row['nombremascota'] ?>">
        <label class="row form-label" for="sexo">Sexo:</label>
            <select class="form-select" aria-label="Default select example" name="sexo" id="sexo">
                <option value="macho" <?= ($row['sexo'] == 'macho') ? 'selected' : '' ?>>macho</option>
                <option value="hembra" <?= ($row['sexo'] == 'hembra') ? 'selected' : '' ?>>hembra</option>
                <option value="macho castrado" <?= ($row['sexo'] == 'macho castrado') ? 'selected' : '' ?>>macho castrado</option>
                <option value="hembra castrada" <?= ($row['sexo'] == 'hembra castrada') ? 'selected' : '' ?>>hembra castrada</option>
                <option value="otro" <?= ($row['sexo'] == 'otro') ? 'selected' : '' ?>>otro</option>
            </select>
            <label class="row form-label" for="peso">Peso:</label>
            <input class="row form-control" type="text" name="peso" value="<?= $row['peso'] ?>">
            <label class="row form-label" for="observaciones">Observaciones:</label>
            <input class="row form-control" type="text" name="observaciones" value="<?= $row['observaciones'] ?>">
            <label class="row form-label" for="urlimg">Url de imagen:</label>
            <input class="row form-control" type="text" name="imgurl" value="<?= $row['imgurl'] ?>">
            <div class="form-check form-switch">
                <label class="form-check-label" for="flexCheckChecked">Estado inactivo/activo
                <input class="form-check-input" type="checkbox" role="switch"  name="estado" value="" <?= $row['estado'] == '1' ? 'checked' : '' ?>><br/>
            </div>
    </div>
    <div class="col-md mx-2">
        <label class="row form-label" for="especie">Especie:</label>
        <select class="form-select" name="especie" id="especie">
            <option value="gato" <?= ($row['especie'] == 'gato') ? 'selected' : '' ?>>gato</option>
            <option value="perro" <?= ($row['especie'] == 'perro') ? 'selected' : '' ?>>perro</option>
            <option value="ave" <?= ($row['especie'] == 'ave') ? 'selected' : '' ?>>ave</option>
            <option value="otro" <?= ($row['especie'] == 'otro') ? 'selected' : '' ?>>otro</option>
        </select>
        <label class="row form-label" for="edad">Edad:</label>
        <input class="row form-control" type="text" name="edad" value="<?= $row['edad'] ?>">
        <label class="row form-label" for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input class="row form-control" type="date" name="fecha_nacimiento" value="<?= $row['fecha_nacimiento'] ?>">
        <label class="row form-label" for="historia_clinica">Historia clínica:</label>
        <textarea class="row form-control" name="historia_clinica" id="historia_clinica" autofocus rows="5"><?= htmlspecialchars($row['historia_clinica'])."\n **".$fecha_hora_actual.": "?></textarea>
        <input type="hidden" name="id_duenio" name="id_duenio" value="<?= $row['id_duenio'] ?>">
    </div>
        <div class="d-flex mb-5 py-4  gap-2 justify-content-center align-items-top">
                <input type="submit" class="btn btn-outline-info" name="ModificarMascota" value="Actualizar">
                <input type="button" class="btn btn-outline-success mx-6" onclick="window.location.href='mostrarmascota.php?id=<?= $row['id_duenio'] ?>'" value="Volver">
                <div class="d-flex w-50 d-sm-block gap-2">
                    <a href="eliminarmascota.php?id_m=<?= $row['id_m'] ?>&def=<?= $row['id_m'] ?>" class="btn btn-outline-danger">Eliminado <span><br></span> definitivo</a>
                </div> 
        </div>
    </form>
</div>
<script>
        // Función para posicionar el cursor al final del textarea
        function ponerCursorAlFinal(textarea) {
            textarea.focus();
            var longitudTexto = textarea.value.length;
            textarea.setSelectionRange(longitudTexto, longitudTexto);
        }

        var textarea = document.getElementById('historia_clinica');
        ponerCursorAlFinal(textarea);
    </script>
</main>
<?php include 'footer.php'; ?>

<?php
require('./conexion.php');
include 'header.php';

$id_duenio = isset($_REQUEST['id_d']) ? $_REQUEST['id_d'] : null;

if (!$id_duenio) {
    echo "ID de dueño no proporcionado.";
    exit();
}

// Obtener los datos del formulario
if (isset($_POST['AltaMascota'])) {
    extract($_POST);
    if(isset($_REQUEST['historia_clinica'])){
        $fecha_hora = date("Y-m-d H:i:s");
        $historia_clinica=$fecha_hora.": ".$historia_clinica;
    }

    // Consulta para insertar los datos
    $sql = "INSERT INTO users3m (nombremascota, especie, sexo, peso, observaciones, imgurl, fecha_nacimiento, edad, historia_clinica, id_duenio) 
            VALUES ('$nombremascota', '$especie', '$sexo', '$peso', '$observaciones', '$imgurl', '$fecha_nacimiento', '$edad', '$historia_clinica', '$id_duenio')";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
                window.location.href = 'insertarmascota.php?id_d=$id_duenio';
              </script>";
        exit();
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }
}
?>

<h2 class="m-4">Agregar Mascota</h2>
<div class="container container mw-sm-80 mw-lg-60 mx-auto bg-light mx-auto vh-100">
    <form class="mx-2 row g-2" method="post" enctype="multipart/form-data" action="insertarmascota.php?id_d=<?php echo $id_duenio; ?>">
        <div class="col-md mx-2">
            <label class="row form-label" for="nombremascota">Nombre de mascota:</label>
            <input class="row form-control" type="text" name="nombremascota" id="nombremascota" required>
            <label class="row form-label" for="especie">Especie:</label>
            <select class="form-select" aria-label="Default select example" name="especie" id="especie" required>
                <option selected>Especie...</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
                <option value="ave">Ave</option>
                <option value="otro">Otro</option>
            </select>
            <label class="row form-label" for="sexo">Sexo:</label>
            <select class="form-select" aria-label="Default select example" name="sexo" id="sexo" required>
                <option selected>Sexo...</option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
                <option value="macho castrado">Macho castrado</option>
                <option value="hembra castrada">Hembra castrada</option>
            </select>
        </div>
        <div class="col-md mx-2">
            <label class="row form-label" for="peso">Peso:</label>
            <input class="row form-control" type="text" name="peso" id="peso" required>
            <label class="row form-label" for="edad">Edad:</label>
            <input class="row form-control" type="text" name="edad" id="edad" required>
            <label class="row form-label" for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input class="row form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento">
        </div>
        <label class="row form-label" for="imgurl">Url de imagen:</label>
        <input class="row form-control" type="text" name="imgurl" id="imgurl">
        <label class="row form-label" for="observaciones">Observaciones:</label>
        <input class="row form-control" type="text" name="observaciones" id="observaciones" required>
        <label class="row form-label" for="historia_clinica">Historia clínica:</label>
        <textarea class="row form-control" name="historia_clinica" id="historia_clinica" required></textarea>

        <input type="hidden" name="id_duenio" value="<?php echo $id_duenio; ?>">

        <div class="d-block rounded">
            <p class="form-label mt-4">Agregue mascotas para este dueño:</p>
            <div class="d-flex w-50 m-2 d-sm-block gap-2">
                <input class="btn btn-outline-primary" type="submit" name="AltaMascota" value="Agregar Mascota">
                <a href="listar.php#<?= $id_duenio ?>" class="btn btn-outline-success m-4">Volver a dueños</a>
            </div>
        </div>
    </form>
</div>

<?php
include 'footer.php';
?>
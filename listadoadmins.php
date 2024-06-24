<?php
require('./conexion.php');

// Consultar los datos

$usuarios="activos";

// Determinar el estado basado en la entrada del formulario
if (isset($_POST['Inactivo'])) {
    $result= seleccion('inactivo', $conn);
    $usuarios="inactivos";
} else {
    $result= seleccion('activo', $conn);
    $usuarios="activos";
}


function seleccion(string $e, $conn) {
    $sql = "SELECT ida, nombre, nombreadmin, perfil, estado FROM admins1m WHERE estado='$e'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    $estado = isset($estado) ? 'activo' : 'inactivo';
    
    return $result;
}

include 'header.php';
?>
<main>
    <h2 class="m-4">Listar Administradores <b><?=$usuarios?></b></h2>
    <div class="d-flex justify-content-center">
        <form action="listadoadmins.php" method="POST">
                <div class="d-flex justify-content-center gap-2">
                    <input class="btn btn-outline-success " type="submit" name="Activo" value="Activos">
                    <input class="btn btn-outline-warning" type="submit" name="Inactivo" value="Inactivos">
                </div>
        </form>
    </div>
    <?php
    if ($result->num_rows > 0) {
    ?>
    <!-- <div class='table-responsive-md vw-80 bg-light vh-100 px-5'> -->
    <div class='container-fluid  px-5 mb-5' >
        <div class='row m-1 py-3 bg-primary-subtle rounded shadow-sm'>
               
                    <!-- <div class="col-1">ID</div> -->
                    <div class="col-3 text-center">Nombre</div>
                    <div class="col-3 text-center">Nombre de Usuario</div>
                    <div class="col-2 text-center">perfil</div>
                    <div class="col-1 text-center">estado</div>
                    <div class="col-2 text-center">Acciones</div>
                
            </div>
            <div class="row m-auto my-1">
                <?php
                while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="row m-auto my-2 align-items-center shadow-sm p-2 mb-2 bg-body-tertiary rounded">
                            <div class="col-1 g-2 text-break text-wrap align-self-center" hidden><?= $row['ida'] ?>
                                </div>
                                <div class="col-3 g-2 text-break text-wrap text-center">
                                    <?= $row['nombre'] ?>
                                </div>
                                <div class="col-3 g-2 text-break text-wrap text-center">
                                    <?= $row['nombreadmin'] ?>
                                </div>
                                <div class="col-2 g-2 text-break text-wrap text-center">
                                    <?= $row['perfil'] ?>
                                </div>
                                <div class="col-1 g-2 text-break text-wrap text-center">
                                    <?= $row['estado'] ?>
                                </div>
                                <!-- Modificar la condicion para editar cualquier administrador -->
                                <?php if ($_SESSION['IDUsuario'] == $row['ida'] || $_SESSION['Perfil'] == "maestro"): ?>
                                <div class="col-2 lg-d-flex sm-d-block g-2 text-break text-wrap text-center"
                                    aria-label="Vertical radio toggle button group">
                                    <a href="editaradmin.php?ida=<?= $row['ida'] ?>" class="btn btn-outline-dark">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                    <?php } ?>
            </div>
        </div>
    <div class="d-flex mb-5 justify-content-evenly">
        <a href='home.php'><button class='btn btn-outline-success mx-6 my-3'>Volver</button></a>
         <a href="#heading" class="align-self-center">volver arriba</a>           
    </div>

    <?php    
    } else {
        echo "No se encontraron resultados.
        <div class='d-row'>
            <a href='home.php'><button class='btn btn-outline-success mx-6 my-3'>Volver</button></a>
        </div>";
    }
    ?>
</main>
<?php

include 'footer.php';

// Cerrar la conexión
$conn->close()

?>

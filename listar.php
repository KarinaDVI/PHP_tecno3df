<?php
require('./conexion.php');

// Crear la tabla si no existe
/* $sql = "CREATE TABLE IF NOT EXISTS users3 (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    direccion VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL
)";
 */
/* if ($conn->query($sql) === false) {
    echo "Error al crear la tabla: " . $conn->error;
} */

// Consultar los datos. Por defecto trae los activos
$usuarios="activos";

    if (isset($_POST['Inactivo'])) {
        $result= seleccion('inactivo', $conn);
        $usuarios="inactivos";
    } else {
        $result= seleccion('activo', $conn);
        $usuarios="activos";
    }

    function seleccion(string $e, $conn) {
        $sql = "SELECT id, nombre, direccion, email, telefono, estado FROM users3 WHERE estado='$e'";
        $result = $conn->query($sql);
        if (!$result) {
            die("Error en la consulta: " . $conn->error);
        }
        $estado = isset($estado) ? 'activo' : 'inactivo';
        /*Devolver el resulado de la consulta  */
        return $result;
    }
    
    /*  */

include 'header.php';
?>
<main>
    <h2 class="m-4">Listar clientes <b><?=$usuarios?></b></h2>
    <div class="d-flex justify-content-center">
        <form action="listar.php" method="POST">
            <div class="d-flex justify-content-center gap-2">
                <input class="btn btn-outline-success " type="submit" name="Activo" value="Activos">
                <input class="btn btn-outline-warning" type="submit" name="Inactivo" value="Inactivos">
                
            </div>
        </form>
    </div>
    <?php
    if ($result->num_rows > 0) {
    ?>
    <div class="container-fluid">
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="row m-1 justify-content-between shadow-sm p-1 mb-1 bg-body-tertiary rounded flex-wrap" id="<?= $row['id'] ?>">
                <input type="hidden" name="id" name="id" value="<?= $row['id'] ?>"> 
                <div class="col-sm-12 col-md-2 d-flex flex-column justify-content-center align-items-center text-center" style="word-break: break-all;"><strong>Nombre:</strong> <span class= "word-break"> <?= $row['nombre'] ?></span></div>
                <div class="col-sm-12 col-md-2 d-flex flex-column justify-content-center align-items-center text-center" style="word-break: break-all;"><strong>Dirección:</strong> <span class= "word-break"> <?= $row['direccion'] ?></span></div>
                <div class="col-sm-12 col-md-2 d-flex flex-column justify-content-center align-items-center text-center" style="word-break: break-all;"><strong>Email:</strong> <span class= "word-break"> <?= $row['email'] ?></span></div>
                <div class="col-sm-12 col-md-2 d-flex flex-column justify-content-center align-items-center text-center" style="word-break: break-all;"><strong>Teléfono:</strong> <a href="https://wa.me/<?= $row['telefono'] ?>/?text=urlencodedtext" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                        </svg><span class= "break-word"> <?= $row['telefono'] ?></span>
                    </a>
                </div>
                <div class="col-sm-12 col-md-1 d-flex flex-column justify-content-center align-items-center text-center" style="word-break: break-all;">
                    <strong>Estado:</strong><span class= "word-break"> <?= $row['estado']=='activo'?'activo':'inactivo' ?></span>
                </div>
                <div class="col-sm-12 col-md-2 p-3">
                    <div class="d-flex flex-md-row flex-lg-row flex-wrap justify-content-center align-items-center">
                        <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-outline-dark mb-1">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        <a href="mostrarmascota.php?id=<?= $row['id'] ?>" class="btn btn-outline-success mb-1">
                            <span class="material-symbols-outlined">visibilitypets</span>
                        </a>
                        <a href="insertarmascota.php?id_d=<?= $row['id'] ?>" class="btn btn-outline-primary">
                            <span class="material-symbols-outlined">addpets</span>
                        </a>
                    </div>
                </div>

            </div>
        <?php } ?>
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
$conn->close();

?>
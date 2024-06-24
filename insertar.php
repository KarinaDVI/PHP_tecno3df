<?php
require('./conexion.php');
include 'header.php';

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
}
 */
if  ( ( isset($_POST['Alta'])) ) {
    extract($_POST);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<label class='row form-label mx-5' for='email' style='color:#dd0000;'>El correo electrónico no es válido</label>";
     }
     else{
   $sql="INSERT INTO users3(nombre, direccion, email, telefono) VALUES ( '$nombre', '$direccion', '$email', '$telefono')";
   if ($conn->query($sql) === TRUE) {
    $id_d = $conn->insert_id; // Obtener el último ID insertado
    echo "<script type='text/javascript'>
            window.location.href = 'insertarmascota.php?id_d=$id_d';
          </script>";
    exit();
        } else {
            echo "Error al insertar el registro: " . $conn->error;
        }
    }
}

$conn->close();
?>

<main>
    <h2 class="m-4">Alta de Cliente</h2>
    <div class="container w-sm-80 w-lg-60 bg-light mx-auto vh-100">
        <form class="mx-2 " method="post" enctype="multipart/form-data" name="contact-form" action="insertar.php">
            <label class="row form-label" for="nombre">Nombre:</label>
            <input class="row form-control" type="text" name="nombre" id="nombre" required>
            <label class="row form-label" for="direccion">Dirección:</label>
            <input class="row form-control" type="text" name="direccion" id="direccion" required>
            <label class="row form-label" for="email">Email:</label>
            <input class="row form-control" type="email" name="email" id="email" required>
            <label class="row form-label" for="telefono">Teléfono:</label>
            <input class="row form-control" type="text" name="telefono" id="telefono" value="54911" required min="5" max="14" >
            <div class='d-block sm-d-flex text-center mx-auto my-2 d-sm-block'>
                <input class="btn btn-outline-primary" type="submit" name="Alta" value="Insertar">
                <a class="" href="home.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">Volver</button></a> 
            </div>
        </form>
    </div>
    
</main>

<?php
include 'footer.php';
?>

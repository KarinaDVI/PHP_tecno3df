<?php
include 'header.php';

/*   if(!isset($_SESSION['is_logged'])) {
    $_SESSION['is_logged'] = 'PHPSESSID';
    $_SESSION['is_logged'] == 0;
}  */

if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] == 0) {
  header('location: login.php?mensaje=Se ha desconectado del sistema');
  exit();
}

?>
<main>
<h2 class="m-4 bg bg-light">Administración de Clinica</h2>
    <div class="container-fluid w-100 vh-100 flex-fill bg-light">
    <a class="m-4" href="home.php"><button class="btn btn-outline-primary">Ir al Home</button></a>
    <?php if ($_SESSION['Perfil'] == "usuario" || $_SESSION['Perfil'] == "maestro"): ?>
        <p class="m-5">Esto es una mensaje de prueba para "usuario"; El sistema registra por defecto como usuario.
          El usuario solo puede acceder a modulos de gestión de clientes y mascotas
          Los botones de eliminado definitivo de mascotas y clientes están ocultos por defecto.
          Para tener acceso a privilegios de administrador y acceder al modulo de gestión de  administradores del sistema  necesita un perfil administrador con clave administrador.
        </p>
    <?php endif; ?>
    <?php if ($_SESSION['Perfil'] == "administrador" || $_SESSION['Perfil'] == "maestro"): ?>
        <p class="m-5">Con un perfil "administrador" tiene acceso a todos los modulos, aunque solo puede modificar sus datos de usuario.</p>
    <?php endif; ?>
    <?php if ($_SESSION['Perfil'] == "maestro"): ?>
        <p class="m-5">Administrador con perfil = "maestro"; se modifica TODO. </p>
    <?php endif; ?>

</div>
<?php
include 'footer.php';
?>
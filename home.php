<?php
include 'header.php';

/* Esto es de login: */

  if(!isset($_SESSION['is_logged'])) {
    $_SESSION['is_logged'] = 'PHPSESSID';
    $_SESSION['is_logged'] == 0;
} 

if  ($_SESSION['is_logged']==0) {
    header('location: login.php?');
}


/*  */

?>
<main>
<h2 class="m-4 bg bg-light">Administración de Clinica</h2>
    <div class="container-fluid w-100 vh-100 flex-fill bg-light">
    <a class="m-4" href="home.php"><button class="btn btn-outline-primary">Ir al Home</button></a>
</div>
<?php
include 'footer.php';
?>
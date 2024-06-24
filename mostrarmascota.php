<?php

require('./conexion.php');
// Obtener el ID del registro a editar
$id=$_REQUEST["id"];
// Consultar los datos
/* $sql = "SELECT id_m, nombremascota, especie, sexo, peso, edad, habitat, imgurl, observaciones,fechadesde, fechahasta, id_duenio FROM users3m where id_duenio=$id"; */
$sql = "SELECT users3m.id_m, users3m.nombremascota, 
               users3m.especie, users3m.sexo, users3m.peso, 
               users3m.imgurl, users3m.observaciones, 
               users3m.edad,users3m.fecha_nacimiento, 
               users3m.historia_clinica, users3m.id_duenio, 
               users3.nombre as duenio, 
               users3.telefono as telefono
        FROM users3m
        INNER JOIN users3 ON users3m.id_duenio=users3.id
        WHERE users3m.id_duenio = $id AND users3m.estado = 'activo'
        ";

$result=mysqli_query($conn, $sql);
    

                  
include 'header.php';
?>

<!-- Modal -->
      <h2 class="m-4">Mascotas</h2>
      <div class="container-fluid align-items-center text-center mb-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-8 g-4 justify-content-center">
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            ?>
            
              <div class="col">
                <div class="card">
                <img src="<?= $row['imgurl'] ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><span class="badge rounded-pill text-bg-success">id: <?= $row['id_m'] ?></span> Nombre: <?= $row['nombremascota'] ?></h5>
                    
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><span class="fw-bold">Especie: </span><?= $row['especie'] ?></li>
                      <li class="list-group-item"><span class="fw-bold">Sexo: </span><?= $row['sexo'] ?></li>
                      <li class="list-group-item"><span class="fw-bold">Peso: </span><?= $row['peso'] ?></li>
                      <li class="list-group-item"><span class="fw-bold">Edad: </span><?= $row['edad'] ?></li>
                      <li class="list-group-item"><span class="fw-bold">Fecha de Nacimiento: </span><?= $row['fecha_nacimiento'] ?></li>
                      <li class="list-group-item"><p class="card-text"><span class="fw-bold">Observaciones: </span><?= $row['observaciones'] ?></p></li>
                      <li class="list-group-item"><span class="fw-bold">Historia_clinica</span><p><?= $row['historia_clinica'] ?> <p></li>
                      <!-- <li class="list-group-item"><span class="fw-bold">Dueño: </span><?= $row['id_duenio'] ?></li> -->
                      <li class="list-group-item"><span class="fw-bold">Dueño: </span><a href="mostrarduenio.php?id=<?= $row['id_duenio'] ?>"><?= $row['duenio'] ?></a></li>
                    </ul>
                    <div class="card-body">
                      <a href="modificarmascota.php?id_m=<?= $row['id_m'] ?>&id=<?= $row['id_duenio']?>" class="btn btn-outline-primary">Editar</a>
                    </div>
                  </div>
                </div>
              </div>
            
    <?php    
        }

    } else {
        echo "No se encontraron resultados.";
    }
    ?>
    </div>
    <div class="d-flex justify-content-center">
      <a href="listar.php#<?= $id?>" class="btn btn-outline-success m-4">Volver a dueños</a>
      <a href="listamascotas.php" class="btn btn-outline-success m-4">Volver a mascotas</a>
    </div>
    </div>
    
  
<?php
// Cerrar la conexión
$conn->close();
include 'footer.php';
?>
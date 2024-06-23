
<!-- Modal --> 
<?php
// Consultar los datos de mascotas para cada usuario
$sql = "SELECT id_m, nombremascota, especie, sexo, peso, edad, habitat, observaciones FROM users3m WHERE id_duenio=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_duenio);

$result = $conn->query("SELECT id FROM users3");
while ($row = $result->fetch_assoc()) {
    $id_duenio = $row['id'];
    $result_mascotas = $stmt->execute();
    $result_mascotas = $stmt->get_result();
?>
    <div class="modal fade" id="exampleModalLong<?= $id_duenio ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Mascotas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="m-4">Mascotas</h2>
                    <?php
                    if ($result_mascotas->num_rows > 0) {
                    ?>
                        <div class='table-responsive-md vw-80 bg-light vh-100 px-5'>
                            <table class='table table-sm m-auto vw-80'>
                                <thead>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>Mascota</th>
                                        <th scope='col'>Especie</th>
                                        <th scope='col'>Sexo</th>
                                        <th scope='col'>Peso</th>
                                        <th scope='col'>Edad</th>
                                        <th scope='col'>Habitat</th>
                                        <th scope='col'>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row_mascotas = $result_mascotas->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?= $row_mascotas['id_m'] ?></td>
                                            <td><?= $row_mascotas['nombremascota'] ?></td>
                                            <td><?= $row_mascotas['especie'] ?></td>
                                            <td><?= $row_mascotas['sexo'] ?></td>
                                            <td><?= $row_mascotas['peso'] ?></td>
                                            <td><?= $row_mascotas['edad'] ?></td>
                                            <td><?= $row_mascotas['habitat'] ?></td>
                                            <td><?= $row_mascotas['observaciones'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <a href='listar.php'><button class='btn btn-outline-success mx-6 my-3'>Volver</button></a>
                        </div>
                    <?php    
                    } else {
                        echo "No se encontraron resultados.";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
include 'footer.php';

// Cerrar la conexión
$conn->close();
 
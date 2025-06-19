<?php
include "../config/conexion.php";

$sql = "SELECT * FROM huesped_has_estado";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <h4 class="mt-4">Tabla de huesped estado</h4>
    <table class="table table-bordered tabla" border="2">
        <thead class="table-dark">
            <tr>
                <th>ID huesped</th>
                <th>ID estadia</th>
                <th>Opciones</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td class="text-black"><?php echo $row['id_huesped']; ?></td>
                    <td class="text-black"><?php echo $row['id_estadia']; ?></td>
                    <td>
                        <a class="btn boton text-black" href="../php/editar_estadia.php?id=<?= $row['id_huesped']?>"  style="">Editar</a>
                        <a class="btn boton text-black" href="../php/eliminar_estadia.php?id=<?= $row['id_huesped']?>" onclick="return confirm('¿Estas seguro que deseas eliminar este registro?');">eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
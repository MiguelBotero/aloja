<?php
include "../config/conexion.php";

$sql = "SELECT * FROM estadia";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <h4 class="mt-4">Tabla de Estadías</h4>
    <table class="table table-bordered tabla" border="2">
        <thead class="table-dark">
            <tr>
                <th>ID Estadía</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Fecha Registro</th>
                <th>Costo</th>
                <th>ID Habitación</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td class="text-black"><?php echo $row['id_estadia']; ?></td>
                    <td class="text-black"><?php echo $row['fecha_inicio']; ?></td>
                    <td class="text-black"><?php echo $row['fecha_fin']; ?></td>
                    <td class="text-black"><?php echo $row['fecha_registro']; ?></td>
                    <td class="text-black">$<?php echo number_format($row['costo'], 0, ',', '.'); ?></td>
                    <td class="text-black"><?php echo $row['id_habitacion']; ?></td>
                    <td>
                        <a class="btn boton text-black" href="../php/editar_estadia.php?id=<?= $row['id_estadia']?>"  style="">Editar</a>
                        <a class="btn boton text-black" href="../php/eliminar_estadia.php?id=<?= $row['id_estadia']?>" onclick="return confirm('¿Estas seguro que deseas eliminar este registro?');">eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

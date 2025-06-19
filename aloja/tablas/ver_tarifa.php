<?php
include "../config/conexion.php";

$sql = "SELECT * FROM tarifa";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <h4 class="mt-4">Tabla de tarifa</h4>
    <table class="table table-bordered tabla" border="2">
        <thead class="table-dark">
            <tr>
                <th>ID tarifa</th>
                <th>Dia</th>
                <th>Semana</th>
                <th>Fecha registro</th>
                <th>Quincena</th>
                <th>Mensual</th>
                <th>ID Habitación</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td class="text-black"><?php echo $row['id_tarifa']; ?></td>
                    <td class="text-black"><?php echo $row['dia']; ?></td>
                    <td class="text-black"><?php echo $row['semana']; ?></td>
                    <td class="text-black"><?php echo $row['fecha_registro']; ?></td>
                    <td class="text-black">$<?php echo number_format($row['quincena'], 0, ',', '.'); ?></td>
                    <td class="text-black"><?php echo $row['mensual']; ?></td>
                    <td class="text-black"><?php echo $row['id_habitacion']; ?></td>
                    <td>
                        <a class="btn boton text-black" href="../php/editar_tarifa.php?id=<?= $row['id_tarifa']?>"  style="">Editar</a>
                        <a class="btn boton text-black" href="../php/eliminar_tarifa.php?id=<?= $row['id_tarifa']?>" onclick="return confirm('¿Estas seguro que deseas eliminar este registro?');">eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
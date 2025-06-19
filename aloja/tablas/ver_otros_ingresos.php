<?php
include "../config/conexion.php";

$sql = "SELECT * FROM otroingreso";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <h4 class="mt-4">Tabla de otro ingresos</h4>
    <table class="table table-bordered tabla" border="2">
        <thead class="table-dark">
            <tr>
                <th>ID otro ingreso</th>
                <th>fecha registro</th>
                <th>total</th>
                <th>Id empleado</th>
                <th>Opciones</th>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td class="text-black"><?php echo $row['id_otroingreso']; ?></td>
                    <td class="text-black"><?php echo $row['fecha_registro']; ?></td>
                    <td class="text-black"><?php echo $row['total']; ?></td>
                    <td class="text-black"><?php echo $row['id_empleado']; ?></td>
                    <td>
                        <a class="btn boton text-black" href="../php/editar_otro_ingreso.php?id=<?= $row['id_otroingreso']?>"  style="">Editar</a>
                        <a class="btn boton text-black" href="../php/eliminar_otro_ingreso.php?id=<?= $row['id_otroingreso']?>" onclick="return confirm('¿Estas seguro que deseas eliminar este registro?');">eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
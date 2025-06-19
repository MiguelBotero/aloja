<?php
include "../config/conexion.php";

$sql = "SELECT * FROM pagos";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <h4 class="mt-4">Tabla de pagos</h4>
    <table class="table table-bordered tabla" border="2">
        <thead class="table-dark">
            <tr>
                <th>ID pagos</th>
                <th>Fecha pago</th>
                <th>Valor</th>
                <th>Id huesped</th>
                <th>Id estadia</th>
                <th>Id empleado</th>
                <th>Imagen</th>
                <th>observación</th>
                <th>Opciones</th>

                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td class="text-black"><?php echo $row['id_pagos']; ?></td>
                    <td class="text-black"><?php echo $row['fecha_pago']; ?></td>
                    <td class="text-black"><?php echo $row['valor']; ?></td>
                    <td class="text-black"><?php echo $row['id_huesped']; ?></td>
                    <td class="text-black"><?php echo $row['id_estadia']; ?></td>
                    <td class="text-black"><?php echo $row['id_empleado']; ?></td>
                    <td class="text-black"><?php echo $row['imagen']; ?></td>
                    <td class="text-black"><?php echo $row['observacion']; ?></td>
                    <td>
                        <a class="btn boton text-black" href="../php/editar_pago.php?id=<?= $row['id_pagos']?>"  style="">Editar</a>
                        <a class="btn boton text-black" href="../php/eliminar_pago.php?id=<?= $row['id_pagos']?>" onclick="return confirm('¿Estas seguro que deseas eliminar este registro?');">eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include "../config/conexion.php";

$sql = "SELECT * FROM empleado";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <h4 class="mt-4">Tabla de empleados</h4>
    <table class="table table-bordered tabla" border="2">
        <thead class="table-dark">
            <tr>
                <th>ID empleado</th>
                <th>Nombre completo</th>
                <th>Usuario</th>
                <th>Password</th>
                <th>Opciones</th>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td class="text-black"><?php echo $row['id_empleado']; ?></td>
                    <td class="text-black"><?php echo $row['nombre_completo']; ?></td>
                    <td class="text-black"><?php echo $row['usuario']; ?></td>
                    <td class="text-black"><?php echo $row['password']; ?></td>
                    <td>
                        <a class="btn boton text-black" href="../php/editar_empleado.php?id=<?= $row['id_empleado']?>"  style="">Editar</a>
                        <a class="btn boton text-black" href="../php/eliminar_empleado.php?id=<?= $row['id_empleado']?>" onclick="return confirm('¿Estas seguro que deseas eliminar este registro?');">eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
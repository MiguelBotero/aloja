<?php
include "../config/conexion.php";

$sql = "SELECT * FROM novedades";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <h4 class="mt-4">Tabla de novedades</h4>
    <table class="table table-bordered tabla" border="2">
        <thead class="table-dark">
            <tr>
                <th>ID novedades</th>
                <th>Descripción</th>
                <th>id estadia</th>
                <th>Opciones</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td class="text-black"><?php echo $row['id_novedades']; ?></td>
                    <td class="text-black"><?php echo $row['descripcion']; ?></td>
                    <td class="text-black"><?php echo $row['id_estadia']; ?></td>
                    <td>
                        <a class="btn boton text-black" href="../php/editar_novedades.php?id=<?= $row['id_novedades']?>"  style="">Editar</a>
                        <a class="btn boton text-black" href="../php/eliminar_novedades.php?id=<?= $row['id_novedades']?>" onclick="return confirm('¿Estas seguro que deseas eliminar este registro?');">eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
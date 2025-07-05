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
                    <td class="flex flex-wrap gap-2">
                        <a class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-1 rounded-full text-sm font-semibold shadow-md transition-transform hover:scale-105" href="../administrador/editar_estadia.php?id=<?= $row['id_estadia']?>">Editar</a>
                        <a href="javascript:void(0);" 
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-full text-sm font-semibold shadow-md transition-transform hover:scale-105"
                            onclick="confirmarEliminacion('../php/eliminar_estadia.php?id_estadia=<?= $row['id_estadia'] ?>')">
                            Eliminar
                        </a>

                        <a href="../ensayo.php?id_estadia=<?= $row['id_estadia'] ?>" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-full text-sm shadow">
                            🧾 Ver factura
                        </a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Animate.css para animaciones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script>
    function confirmarEliminacion(url) {
        console.log("URL generada:", url);
        Swal.fire({
            title: '¿Estás seguro de eliminar?',
            html: '<b>Esta acción no se puede deshacer.</b><br>El registro será eliminado permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            showClass: {
                popup: 'animate__animated animate__fadeInDown faster'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp faster'
            },
            background: '#f8f9fa',
            backdrop: `rgba(0,0,0,0.6)`
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '¡Eliminado!',
                    text: 'El registro ha sido eliminado correctamente.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1800,
                    background: '#f0f0f0',
                    showClass: {
                        popup: 'animate__animated animate__zoomIn faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__zoomOut faster'
                    }
                });
                setTimeout(() => {
                    window.location.href = url;
                }, 1800);
            }
        });
    }
</script>
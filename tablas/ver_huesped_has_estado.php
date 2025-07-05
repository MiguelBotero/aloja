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
                    <td class="flex flex-wrap gap-2">
                        <a href="editar_huesped_has_estado.php?id_huesped=<?php echo $row['id_huesped']; ?>&id_estadia=<?php echo $row['id_estadia']; ?>">
                            ✏️ Editar
                        </a>

                        <a class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-sm font-semibold shadow-md transition-transform hover:scale-105"
                            href="../php/eliminar_huesped_has_estado.php?id_huesped=<?= $row['id_huesped'] ?>&id_estadia=<?= $row['id_estadia'] ?>"
                            onclick="return confirm('¿Estás seguro que deseas eliminar este registro?');">
                            Eliminar
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
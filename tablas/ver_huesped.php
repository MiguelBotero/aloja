<?php
$sql = "SELECT * FROM huesped";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="row">
    <div class="table-responsive">
        <h4 class="mt-4">Tabla de huesped</h4>
        <table class="table table-bordered tabla" border="2">
            <thead class="table-dark">
                <tr>
                    
                    <th>nombre completo</th>
                    <th>tipo documento</th>
                    <th>número documento</th>
                    <th>telefono huesped</th>
                    <th>Origen</th>
                    <th>nombre contacto</th>
                    <th>telefono contacto</th>
                    <th>observaciones</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        
                        <td class="text-black"><?php echo $row['nombre_completo']; ?></td>
                        <td class="text-black"><?php echo $row['tipo_documento']; ?></td>
                        <td class="text-black"><?php echo $row['numero_documento']; ?></td>
                        <td class="text-black"><?php echo $row['telefono_huesped']; ?></td>
                        <td class="text-black"><?php echo $row['origen']; ?></td>
                        <td class="text-black"><?php echo $row['nombre_contacto']; ?></td>
                        <td class="text-black"><?php echo $row['telefono_contacto']; ?></td>
                        <td class="text-black"><?php echo $row['observaciones']; ?></td>
                        <td>
                            <div class="flex gap-2">
                                <a class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-semibold shadow-md transition-transform hover:scale-105" href="../administrador/editar_registro.php?id=<?= $row['id_huesped']?>">Editar</a>
                                <a class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-md transition-transform hover:scale-105" href="#" onclick="confirmarEliminacion('../php/eliminar_registro.php?id=<?= $row['id_huesped']?>')">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
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
                fetch(url)
                    .then(response => response.ok ? response.text() : Promise.reject('Error al eliminar'))
                    .then(data => {
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

                        // Remueve la fila de la tabla directamente desde el DOM
                        const fila = document.querySelector(`a[href='${url}']`)?.closest('tr');
                        if (fila) fila.remove();
                    })
                    .catch(error => {
                        Swal.fire('Error', 'No se pudo eliminar el registro.', 'error');
                        console.error(error);
                    });
            }
        });
    }
</script>

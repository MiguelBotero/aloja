<?php
include "../config/conexion.php";

$sql = "SELECT * FROM huesped";
$resultado = mysqli_query($conexion, $sql);
?>


<div class="row">
                    <div class="table-resposive">
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
                                            
                                        <td class=" text-black"><?php echo $row['nombre_completo']; ?></td>
                                        <td class=" text-black"><?php echo $row['tipo_documento']; ?></td>
                                        <td class=" text-black"><?php echo $row['numero_documento']; ?></td>
                                        <td class=" text-black"><?php echo $row['telefono_huesped']; ?></td>
                                        <td class=" text-black"><?php echo $row['origen']; ?></td>
                                        <td class=" text-black"><?php echo $row['nombre_contacto']; ?></td>
                                        <td class=" text-black"><?php echo $row['telefono_contacto']; ?></td>
                                        <td class=" text-black"><?php echo $row['observaciones']; ?></td>
                                        <td>
                                            <a class="btn boton text-black" href="../php/editar_registro.php?id=<?= $row['id_huesped']?>"  style="">Editar</a>
                                            <a class="btn boton text-black" href="../php/eliminar_registro.php?id=<?= $row['id_huesped']?>" onclick="return confirm('¿Estas seguro que deseas eliminar este registro?');">eliminar</a>
                                        </td>
                                            
                                    </tr>
                                <?php } ?>
                            </tbody>        
                        </table>
                    </div>
                </div>
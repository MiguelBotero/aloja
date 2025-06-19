

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


        <link rel="stylesheet" href="../css/pagina5.css">

        <style>
            .invalid-feedback {
                display: block;         /* Siempre ocupa espacio */
                visibility: hidden;     /* Pero se oculta visualmente hasta que se active */
                height: 0.9em;           /* Ajusta a tu gusto */
                margin-top: 0.25rem;
                font-size: 0.875em;
                color: #dc3545;
            }

            input.is-invalid + .invalid-feedback,
            select.is-invalid + .invalid-feedback {
                visibility: visible;    /* Solo se muestra si el campo tiene is-invalid */
            }

            .navegador{
                background-color: rgba(0, 0, 0, 0.289);
                height: 100%;
        
            }

    
    
            li{
                margin-left: 2px;
                margin-bottom: 70px;
            }
            .nav-link{
                color: rgb(255, 252, 246);
            }
            
            .nav-link:hover{
                background-color: rgba(55, 55, 230, 0.508);
                color: white;
            }





        .tabla {
                margin: 30px;
            
            
            }

            .tabla th,
            .tabla td{
                border: 2px solid black;
            

            } 



            .tabla tbody tr:nth-child(odd) td {
                background-color:white;
            }

            .tabla tbody tr:nth-child(even) td {
                background-color:rgb(165, 165, 165);
            }

            .titulo {
                background-color: rgba(0, 0, 0, 0.289);
            }

            .titulo h2{
            font-size: 100px;
            color: white;
            }

            .titulo h3{
            color: gray;
            margin-left: 325px;
            text-align: left;
            }


        </style>
    </head>

    <body>
        <div class="text-center">

            <div class="row">
            <div class="col-12 titulo">
                <h2>Bienvenido a Aloja</h2>
                <h3>Administrador . . .</h3>
            </div>
            </div>

            
            <div class="row">
                <div class="col-lg-2 col-12 ">
                    <ul class="nav d-flex flex-row flex-lg-column navegador">

                        <li class="nav-item">
                            <img src="" alt="">
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index_admin.php">inicio</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="registro_admin.php">gestión de habitaciones</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registro
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">registro</a></li>
                                <li><a class="dropdown-item" href="ver_tablas">Ver datos</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="galeria_admin.php">Galeria</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="ubicacion_admin.php">Ubicación</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="nosotros_admin.php">información del hotel</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="contactos_admin.php">contacto y redes</a>
                        </li>

                        <li class="nav-item">
                            <a href="../php/cerrar_sesion_admin.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>

                <div class="col-12 col-lg-9">


                    <!-- FORMULARIOS DE REGISTRO -->
                    <div class="container mt-4">
                        <label for="formSelect" class="form-label text-white">Seleccione el formulario que deseas ver:</label>
                        <select class="form-select" id="formSelect">
                            <option value="huesped">Huésped</option>
                            <option value="habitacion">habitacion</option>
                            <option value="empleados">Empleados</option>
                            <option value="estadia">estadia</option>
                            <option value="novedades">novedades</option>
                            <option value="huesped_has_estado">Huesped has estado</option>
                            <option value="pago">Pagos</option>
                            <option value="tarifas">Tarifa</option>
                            <option value="otroingreso">otros ingresos</option>
                        </select>
                    </div>

                    
                    <div class="col-lg-9 col-12 mt-5">
                        
                        <!-- FORMULARIO DE HUESPED -->
                        <div id="huesped" class=" justify-content-center  col-md-9 col-lg-7 bg-blue p-5 rounded shadow m-auto form-container   formulario">
                            <form action="../php/guardar_registro.php" method="POST">
                                <h2 class="text-center text-white">agregar huesped</h2>
                                                
                                <div class="mb-2 text-white filas">
                                    <label for="nombre_completo" class="form-label">nombre completo</label>
                                    <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required minlength="3" pattern="[A-Za-z\s]+" title="Solo letras y espacios">

                                    <div class="invalid-feedback">
                                        Por favor completa este campo correctamente.
                                    </div>

                                </div>

                                <div class="mb-2  text-white filas">
                                    <label for="tipo_documento" class="form-label">tipo documento</label>
                                    <select name="tipo_documento" id="tipo_documento">
                                        <option value="">Selecciona una opción</option>
                                        <option value="cedula">cedula</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                        <option value="Carnet de extranjería">Carnet de extranjería</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor completa este campo correctamente.
                                    </div>
                                </div>


                                <div class="mb-2 text-white filas">
                                    <label for="numero_documento" class="form-label">número documento</label>
                                    <input type="number" class="form-control" id="numero_documento" name="numero_documento" required>

                                    <div class="invalid-feedback">
                                        Por favor completa este campo correctamente.
                                    </div>

                                </div>
                                                        
                                <div class="mb-2 text-white filas">
                                    <label for="telefono_huesped" class="form-label">telefono huesped</label>
                                    <input type="tel" class="form-control" id="telefono_huesped" name="telefono_huesped" required>
                                    <div class="invalid-feedback">
                                        Por favor completa este campo correctamente.
                                    </div>
                                </div>
                                                        
                                <div class="mb-2 text-white filas">
                                    <label for="origen" class="form-label">origen</label>
                                    <input type="text" class="form-control" id="origen" name="origen" required>
                                    <div class="invalid-feedback">
                                        Por favor completa este campo correctamente.
                                    </div>
                                </div>
                                                        
                                <div class="mb-2 text-white filas">
                                    <label for="nombre_contacto" class="form-label">nombre contacto</label>
                                    <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" required>
                                    <div class="invalid-feedback">
                                        Por favor completa este campo correctamente.
                                    </div>
                                </div>
                                                        
                                <div class="mb-2 text-white filas">
                                    <label for="telefono_contacto" class="form-label">telefono contacto</label>
                                    <input type="number" class="form-control" id="telefono_contacto" name="telefono_contacto" required>
                                    <div class="invalid-feedback">
                                        Por favor completa este campo correctamente.
                                    </div>
                                </div>
                                                        
                                <div class="mb-2 text-white filas">
                                    <label for="observaciones" class="form-label">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" class="form-control" aria-label="with textarea" minlength="3" pattern="[A-Za-z\s]+" title="Solo letras y espacios"></textarea>
                                </div>

                                <button type="submit" class="btn boton w-100  text-white boton" >guardar</button>

                            </form>
                        </div>

                        <!-- FORMULARIOS DE habitacion -->
                        <div id="habitacion" class="row justify-content-center  form-container d-none formulario">
                            <form action="../php/guardar_habitacion.php" method="POST" enctype="multipart/form-data" class="row" style="background-color: rgba(0,0,0,0.5); border-radius: 20px; color: white; padding: 20px; max-width: 800px;">
                                <h2 class="text-center text-white">agregar habitación</h2>
                                        <!-- Columna izquierda: imagen + input -->
                                <div class="col-md-6 text-center d-flex flex-column align-items-center">
                                    <img id="preview" src="#" alt="Imagen habitación" class="img-fluid rounded mb-3" style="max-height: 250px; display: none;">
                                    <input type="file" id="imagen" name="imagen" class="form-control mt-2" style="max-width: 90%;">
                                </div>
                                
                                        <!-- Columna derecha: campos -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre habitación</label>
                                        <input type="text" name="nombre" class="form-control" required>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label">Descripción</label>
                                        <textarea name="dotacion" class="form-control" rows="3" required></textarea>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label">Precio</label>
                                        <input type="number" name="precio" class="form-control" required>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label">Disponibilidad</label><br>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="disponibilidad" name="disponibilidad" value="1">
                                            <label class="form-check-label" for="disponibilidad" id="dispo-label">Disponible</label>
                                        </div>
                                    </div>
                                
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-light">Guardar</button>
                                    </div>
                                </div> 
                            </form>
                        </div>

                        <!-- FORMULARIOS DE EMPLEADO -->        
                        <div id="empleados" class="row justify-content-center  form-container d-none formulario">
                            <div class="col-md-8 col-lg-6 bg-dark p-4 rounded shadow">
                            <h2 class="text-center mb-4 text-white">Agregar empleados</h2>
                                <form action="../php/guardar_empleado.php" method="POST"> 
                                    <div class="row mb-3">
                                        <div class="col filas ">
                                            <label class="form-label text-white" for="nombre_completo">Nombre completo:</label>
                                            <input type="text" class="form-control" name="nombre_completo" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese un nombre válido (solo letras, mínimo 3).
                                            </div>

                                        </div>
                                                    
                                        <div class="col filas">
                                            <label class="form-label text-white" for="usuario" >Usuario:</label>
                                            <input type="text" class="form-control" name="usuario" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese un nombre válido (solo letras, mínimo 3).
                                            </div>
                                        </div>
                                                    
                                    </div>
                                                
                                    <div class="mb-3 filas">
                                        <label class="form-label text-white" for="password" >Contraseña:</label>
                                        <input type="password" class="form-control" name="password" required>
                                        <div class="invalid-feedback">
                                            La contraseña debe tener al menos 6 caracteres y contener letras y números.
                                        </div>
                                    </div> 
                                    <button type="submit" class="btn btn-dark">Guardar empleado</button>
                                </form>
                            </div>
                        </div>

                        <!-- FORMULARIOS DE ESTADIA -->
                        <div id="estadia" class="row justify-content-center form-container d-none formulario">
                            <div class="col-md-8 col-lg-6 bg-dark p-4 rounded shadow">
                                <h2 class="text-center mb-4 text-white">Agregar estadia</h2>
                                <form action="../php/guardar_estadia.php">
                                    <div class="row mb-3">

                                        <div class="col filas ">
                                            <label for="fecha_inicio" class="form-label text-white">Fecha ingreso</label>
                                            <input type="date" class="form-control" name="fecha_inicio" >
                                             <div class="invalid-feedback">Por favor, ingresa una fecha válida de ingreso.</div>
                                        </div>

                                        <div class="col filas">
                                            <label for="fecha_fin" class="form-label text-white">Fecha salida</label>
                                            <input type="date" class="form-control" name="fecha_fin" >
                                            <div class="invalid-feedback">Por favor, ingresa una fecha válida de salida.</div>
                                        </div>
                                    </div>

                                    <div class="mb-3 filas">
                                        <label for="fecha_registro" class="form-label text-white">Fecha de registro</label>
                                        <input type="date" class="form-control" name="fecha_registro" >
                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                    </div>

                                    <div class="mb-3 filas">
                                        <label for="costo" class="form-label text-white">Costo (COP)</label>
                                        <input type="number" class="form-control" name="costo" >
                                        <div class="invalid-feedback">Ingresa un valor válido mayor o igual a 0.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-white" for="id_habitacion">id habitación</label>
                                        <select name="id_habitacion" class="form-select" >
                                            <option value="">Seleccione una habitacion</option>
                                            <?php
                                                include '../config/conexion.php';
                                                $result = mysqli_query($conexion, "SELECT id_habitacion FROM habitacion");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id_habitacion']}'>ID {$row['id_habitacion']}</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Debes seleccionar una habitación.</div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-dark">Guardar estadia</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- FORMULARIOS DE NOVEDADES -->        
                        <div id="novedades" class="row justify-content-center  form-container d-none formulario">
                            <div class="col-md-8 col-lg-6 bg-dark p-4 rounded shadow">    
                                <h2 class="text-center mb-4 text-white">Agregar novedades</h2>
                                <form action="../php/guardar_novedades.php" method="POST">
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="descripcion">Descripción </label>
                                        <input type="text" class="form-control" name="descripcion" required>
                                        <div class="invalid-feedback">Por favor, ingresa una descripción válida.</div>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="id_estadia">Estadía</label>
                                        <select name="id_estadia" class="form-select" required>
                                            <option value="">Seleccione una estadía</option>
                                            <?php
                                                include '../config/conexion.php';
                                                $result = mysqli_query($conexion, "SELECT id_estadia FROM estadia");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id_estadia']}'>ID {$row['id_estadia']}</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Debes seleccionar una estadía.</div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-dark">Guardar empleado</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                                
                        <!-- FORMULARIOS DE HUESPED HAS ESTADO -->
                        <div id="huesped_has_estado" class="row justify-content-center  form-container d-none formulario">
                            <div class="col-md-8 col-lg-6 bg-dark p-4 rounded shadow">
                                <h2 class="text-center mb-4 text-white">huesped has estado</h2>
                                <form action="../php/guardar_huesped_has_estado.php" method="POST">
                                    <div class="mb-3">
                                        <label for="id_huesped" class="form-label text-white">id huesped</label>
                                            <select name="id_huesped" class="form-select" required>
                                                <option value="">Seleccione un huesped</option>
                                                <?php
                                                    include '../config/conexion.php';
                                                    $result = mysqli_query($conexion, "SELECT id_huesped FROM huesped");
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['id_huesped']}'>ID {$row['id_huesped']}</option>";
                                                    }
                                                ?>
                                            </select>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="id_estadia" class="form-label text-white">id estadia</label>
                                        <select name="id_estadia" class="form-select" required>
                                            <option value="">Seleccione una estadía</option>
                                            <?php
                                                include '../config/conexion.php';
                                                $result = mysqli_query($conexion, "SELECT id_estadia FROM estadia");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id_estadia']}'>ID {$row['id_estadia']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-dark">Aceptar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                                
                        <!-- FORMULARIOS DE PAGOS -->
                        <div id="pago" class="row justify-content-center  form-container d-none formulario">
                            <div class="col-md-8 col-lg-6 bg-dark p-4 rounded shadow">
                                <h2 class="text-center mb-4 text-white">Agregar pagos</h2>
                                <form action="../php/guardar_pagos.php" method="POST">
                                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="fecha_pago">Fecha de pago</label>
                                        <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="valor">Valor</label>
                                        <input type="number" class="form-control" id="valor" name="valor" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="id_huesped">ID Huésped</label>
                                        <select name="id_huesped" class="form-select" required>
                                            <option value="">Seleccione un huesped</option>
                                                <?php
                                                    include '../config/conexion.php';
                                                    $result = mysqli_query($conexion, "SELECT id_huesped FROM huesped");
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['id_huesped']}'>ID {$row['id_huesped']}</option>";
                                                    }
                                                ?>
                                            </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="id_estadia">ID Estadía</label>
                                        <select name="id_estadia" class="form-select" required>
                                            <option value="">Seleccione una estadía</option>
                                                <?php
                                                    include '../config/conexion.php';
                                                    $result = mysqli_query($conexion, "SELECT id_estadia FROM estadia");
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['id_estadia']}'>ID {$row['id_estadia']}</option>";
                                                    }
                                                ?>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="id_empleado">ID Empleado</label>
                                        <select name="id_empleado" class="form-select" required>
                                            <option value="">Seleccione un empleado</option>
                                            <?php
                                                include '../config/conexion.php';
                                                $result = mysqli_query($conexion, "SELECT id_empleado FROM empleado");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id_empleado']}'>ID {$row['id_empleado']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="imagen">Imagen (URL o ID)</label>
                                        <input type="text" class="form-control" id="imagen" name="imagen">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="observacion">Observación</label>
                                        <textarea class="form-control" id="observacion" name="observacion" rows="3"></textarea>
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                        
                        <!-- FORMULARIOS DE TARIFAS -->
                        <div id="tarifas" class=" justify-content-center  form-container d-none formulario">
                            <div class="col-md-8 col-lg-6 bg-dark p-4 rounded shadow">
                                <h2 class="text-center mb-4 text-white">agregar tarifas</h2>
                                <form action="../php/guardar_tarifas.php" method="POST">
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="dia">Dia</label>
                                        <input type="number" name="dia" class="form-control">
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="semana">semana</label>
                                        <input type="text" name="semana" class="form-control">
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="quincena">quincena</label>
                                        <input type="number" name="quincena" class="form-control">
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="mensual">Mensual</label>
                                        <input type="number" name="mensual" class="form-control">
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="id_habitacion">Id Habitación</label>
                                        <select name="id_habitacion" class="form-select" required>
                                            <option value="">Seleccione una estadía</option>
                                            <?php
                                                include '../config/conexion.php';
                                                $result = mysqli_query($conexion, "SELECT id_habitacion FROM habitacion");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id_habitacion']}'>ID {$row['id_habitacion']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                                
                        <!-- FORMULARIOS DE OTRO INGRESO -->
                        <div id="otroingreso" class=" justify-content-center  form-container  formulario d-none">
                            <div class="col-md-8 col-lg-6 bg-dark p-4 rounded shadow">
                                <h2 class="text-center mb-4 text-white">agregar otro ingreso</h2>
                                <form action="../php/guardar_otro_ingreso.php" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="fecha_registro">Fecha registro</label>
                                        <input type="date" name="fecha_registro" class="form-control">
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="total">total</label>
                                        <input type="number" name="total" class="form-control">
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="id_empleado">Id empleado</label>
                                        <select name="id_estadia" class="form-select" required>
                                            <option value="">Seleccione un empleado</option>
                                            <?php
                                                include '../config/conexion.php';
                                                $result = mysqli_query($conexion, "SELECT id_empleado FROM empleado");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id_empleado']}'>ID {$row['id_empleado']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success">enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div> 
            </div>
        </div>



        <script>
           
        </script>

        <script>
                // Script para mostrar el formulario seleccionado
                document.addEventListener("DOMContentLoaded", function () {
                const selector = document.getElementById("formSelect");
                const formularios = document.querySelectorAll(".formulario");

                selector.addEventListener("change", function () {
                    // Ocultar todos
                    formularios.forEach(f => f.classList.add("d-none"));

                    // Mostrar el formulario seleccionado
                    const seleccionado = selector.value;
                    const formulario = document.getElementById(seleccionado);
                    if (formulario) {
                    formulario.classList.remove("d-none");
                    }
                });
            });

            // Validación de formularios

            //validacion de huesped
            document.addEventListener("DOMContentLoaded", function () {
                const formularios = document.querySelectorAll(".formulario");

                formularios.forEach(formulario => {
                formulario.addEventListener("submit", function (event) {
                    event.preventDefault();
                    const inputs = formulario.querySelectorAll("input, select, textarea");
                    let isValid = true;

                        inputs.forEach(input => {
                            const valor = input.value.trim();
                            input.classList.remove("is-invalid");

                            // Validación por tipo de campo
                            if (valor === "") {
                                input.classList.add("is-invalid");
                                isValid = false;
                            } else if (input.name.includes("telefono")) {
                                if (!/^\d{7,15}$/.test(valor)) {
                                    input.classList.add("is-invalid");
                                    isValid = false;
                                }
                            } else if (input.name === "numero_documento") {
                                if (!/^\d{6,15}$/.test(valor)) {
                                    input.classList.add("is-invalid");
                                    isValid = false;
                                }
                            } else if (input.name === "nombre_completo" || input.name === "nombre_contacto") {
                                if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(valor)) {
                                    input.classList.add("is-invalid");
                                    isValid = false;
                                }
                            } else if (input.tagName === "SELECT" && valor === "") {
                                input.classList.add("is-invalid");
                                isValid = false;
                            }
                        });

                        if (isValid) {
                            formulario.submit();
                        }
                    });
                });
            });

            //formulario del empleado
            document.addEventListener("DOMContentLoaded", function () {
                const formularios = document.querySelectorAll(".formulario");

                formularios.forEach(formulario => {
                    formulario.addEventListener("submit", function (event) {
                        event.preventDefault();

                        const inputs = formulario.querySelectorAll("input, select, textarea");
                        let isValid = true;

                        inputs.forEach(input => {
                            const valor = input.value.trim();
                            input.classList.remove("is-invalid");

                             // Reglas personalizadas por campo
                            if (valor === "") {
                                input.classList.add("is-invalid");
                                isValid = false;

                            } else if (input.name === "nombre_completo") {
                                if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,}$/.test(valor)) {
                                    input.classList.add("is-invalid");
                                    isValid = false;
                                }

                            } else if (input.name === "usuario") {
                                if (!/^[a-zA-Z0-9]{4,15}$/.test(valor)) {
                                    input.classList.add("is-invalid");
                                    isValid = false;
                                }

                            } else if (input.name === "password") {
                                if (!/^(?=.*[a-zA-Z])(?=.*\d).{6,}$/.test(valor)) {
                                    input.classList.add("is-invalid");
                                    isValid = false;
                                }
                            }
                        });

                        if (isValid) {
                            formulario.submit();
                        }
                    });
                });
            });
            

            //validacion de estadia
            document.addEventListener("DOMContentLoaded", function () {
                const formularios = document.querySelectorAll(".formulario");

                formularios.forEach(formulario => {
                    formulario.addEventListener("submit", function (event) {
                    event.preventDefault();

                    const inputs = formulario.querySelectorAll("input, select");
                    let isValid = true;

                    inputs.forEach(input => {
                        if (input.value.trim() === "" || (input.type === "number" && input.value < 0)) {
                        input.classList.add("is-invalid");
                        isValid = false;
                        } else {
                        input.classList.remove("is-invalid");
                        }
                    });

                    if (isValid) {
                        formulario.submit();
                    }
                    });
                });
            });
                
            //validacion de novedades
            document.addEventListener("DOMContentLoaded", function () {
                const formularios = document.querySelectorAll(".formulario");

                formularios.forEach(formulario => {
                    formulario.addEventListener("submit", function (event) {
                    event.preventDefault();

                    const inputs = formulario.querySelectorAll("input, select");
                    let isValid = true;

                    inputs.forEach(input => {
                        if (input.value.trim() === "") {
                        input.classList.add("is-invalid");
                        isValid = false;
                        } else {
                        input.classList.remove("is-invalid");
                        }
                    });

                    if (isValid) {
                        formulario.submit();
                    }
                    });
                });
            });



            //SCRIPTS PARA EL FORMULARIO DE LA HABITACIÓN (IMAGENES)
            document.getElementById("imagen").addEventListener("change", function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById("preview");

                if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
                } else {
                preview.style.display = "none";
                }
            });

            //SCRIPTS PARA LA DISPONIBILIDAD

            const switchInput = document.getElementById("disponibilidad");
            const dispoLabel = document.getElementById("dispo-label");

            function actualizarSwitchColor() {
                if (switchInput.checked) {
                switchInput.style.backgroundColor = "#28a745"; // verde
                dispoLabel.textContent = "Disponible";
                } else {
                switchInput.style.backgroundColor = "#dc3545"; // rojo
                dispoLabel.textContent = "No disponible";
                }
            }

            // Escucha cambios
            switchInput.addEventListener("change", actualizarSwitchColor);

            // Carga inicial
            window.addEventListener("DOMContentLoaded", actualizarSwitchColor);
            
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>
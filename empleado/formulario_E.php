<?php
// Conectar a la base de datos
include('../config/conexion.php');

session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['usuario'])) {
    echo "Sesión no iniciada";
    exit();
}



// Obtener datos del empleado que ha iniciado sesión
$usuario = $_SESSION['usuario'];
$sql = "SELECT usuario FROM empleado WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexion, $sql);
$empleado = mysqli_fetch_assoc($resultado); // <-- aquí sí obtienes el nombre

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-200 text-gray-800 min-h-screen">
        <div>

        <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
                <div>
                    <h1 class="text-3xl font-extrabold bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-200 bg-clip-text text-transparent">Panel de Empleado</h1>
                    <p class="text-sm text-indigo-200">Formulario</p>
                </div>
                </div>
                <?php $pagina = basename($_SERVER['PHP_SELF']); ?>
                <nav class="flex flex-wrap gap-4 text-sm md:text-base">
                    <a href="index_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'index_E.php') ? 'border-b-2 border-white' : ''; ?>">🏠 Inicio</a>
                    <a href="formulario_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'formulario_E.php') ? 'border-b-2 border-white' : ''; ?>">📝 Registrar</a>
                    <a href="ver_tablas_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ver_tablas_E.php') ? 'border-b-2 border-white' : ''; ?>">📋 Ver Datos</a>
                    <a href="galeria_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'galeria_E.php') ? 'border-b-2 border-white' : ''; ?>">🖼️ Galería</a>
                    <a href="ubicacion_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ubicacion_E.php') ? 'border-b-2 border-white' : ''; ?>">📍 Ubicación</a>
                    <a href="nosotros_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'nosotros_E.php') ? 'border-b-2 border-white' : ''; ?>">👥 Nosotros</a>
                    <a href="contacto_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'contactos_E.php') ? 'border-b-2 border-white' : ''; ?>">📞 Contacto</a>
                    <a href="../php/cerrar_sesion_admin.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-white font-bold shadow">Cerrar sesión</a>
                    <!-- Perfil del empleado -->
                    <div class="flex items-center gap-2 bg-indigo-900 px-3 py-2 rounded-xl shadow-md">
                        <img src="../img/perfil.jpg" alt="Perfil" class="w-10 h-10 rounded-full border-2 border-white">
                        <span class="text-white font-medium text-sm hidden sm:block"><?php echo $empleado['usuario']; ?></span>
                    </div>
                </nav>
            </div>
        </header>

        <main class="p-8"> 
                   
                <div class="bg-white rounded-xl shadow-lg p-6 max-w-3xl mx-auto mt-8 text-black">
                    <label for="formSelect" class="block text-left text-lg text-gray-700 mb-2 font-bold">
                        Seleccione el formulario que deseas ver:
                    </label>
                    <select id="formSelect" class="text-gray-900 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-black">
                        <option value="huesped">Huésped</option>
                        <option value="habitacion">Habitación</option>
                        <option value="estadia">Estadía</option>
                        <option value="novedades">Novedades</option>
                        <option value="huesped_has_estado">Huésped has estado</option>
                        <option value="pago">Pagos</option>
                        <option value="tarifas">Tarifa</option>
                        <option value="otroingreso">Otros ingresos</option>
                    </select>
                    <p class="text-sm text-gray-500 mt-2">Puedes registrar información en el sistema seleccionando el formulario correspondiente.</p>
                </div>
                <br>
                <br>

                <!-- FORMULARIO DE HUÉSPED -->
                <div id="huesped" class="formulario max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">
                    <form id="formHuesped" action="../php/empleado_CRUD/guardar_registro.php" method="POST" novalidate>
                        <!-- Notificación general -->
                        <div id="notificacion" class="hidden bg-red-100 text-red-800 text-center p-2 rounded mb-4 font-semibold shadow"></div>

                        <h2 class="text-2xl font-bold text-center text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t mb-6 uppercase">
                            Agregar Huésped
                        </h2>

                        <!-- Nombre completo -->
                        <div class="mb-4">
                            <label for="nombre_completo" class="block text-gray-700 font-semibold mb-1">Nombre completo</label>
                            <input type="text" id="nombre_completo" name="nombre_completo" required minlength="3" pattern="[A-Za-z\s]+" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-nombre_completo">❗ Ingrese un nombre válido (mínimo 3 letras, solo letras y espacios).</p>
                        </div>

                        <!-- Tipo de documento -->
                        <div class="mb-4">
                            <label for="tipo_documento" class="block text-gray-700 font-semibold mb-1">Tipo de documento</label>
                            <select name="tipo_documento" id="tipo_documento" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <option value="">Selecciona una opción</option>
                                <option value="cedula">Cédula</option>
                                <option value="Pasaporte">Pasaporte</option>
                                <option value="Carnet de extranjería">Carnet de extranjería</option>
                                <option value="Otro">Otro</option>
                            </select>
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-tipo_documento">❗ Selecciona un tipo de documento.</p>
                        </div>

                        <!-- Número de documento -->
                        <div class="mb-4">
                            <label for="numero_documento" class="block text-gray-700 font-semibold mb-1">Número de documento</label>
                            <input type="number" id="numero_documento" name="numero_documento" required min="1000000"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-numero_documento">❗ Ingrese un número válido (mínimo 7 dígitos).</p>
                        </div>

                        <!-- Teléfono huésped -->
                        <div class="mb-4">
                            <label for="telefono_huesped" class="block text-gray-700 font-semibold mb-1">Teléfono del huésped</label>
                            <input type="tel" id="telefono_huesped" name="telefono_huesped" required pattern="[0-9]{10}" maxlength="10"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-telefono_huesped">❗ Ingrese un número de 10 dígitos.</p>
                        </div>

                        <!-- Origen -->
                        <div class="mb-4">
                            <label for="origen" class="block text-gray-700 font-semibold mb-1">Origen</label>
                            <input type="text" id="origen" name="origen" required minlength="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-origen">❗ Ingrese un lugar de origen válido.</p>
                        </div>

                        <!-- Nombre contacto -->
                        <div class="mb-4">
                            <label for="nombre_contacto" class="block text-gray-700 font-semibold mb-1">Nombre de contacto</label>
                            <input type="text" id="nombre_contacto" name="nombre_contacto" required pattern="[A-Za-z\s]+"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-nombre_contacto">❗ Solo letras y espacios son permitidos.</p>
                        </div>

                        <!-- Teléfono contacto -->
                        <div class="mb-4">
                            <label for="telefono_contacto" class="block text-gray-700 font-semibold mb-1">Teléfono del contacto</label>
                            <input type="tel" id="telefono_contacto" name="telefono_contacto" required pattern="[0-9]{10}" maxlength="10"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-telefono_contacto">❗ Ingrese un número de 10 dígitos.</p>
                        </div>

                        <!-- Observaciones -->
                        <div class="mb-4">
                            <label for="observaciones" class="block text-gray-700 font-semibold mb-1">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" minlength="3" pattern="[A-Za-z\s]+" 
                            class="w-full h-24 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 resize-none"></textarea>
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-observaciones">❗ Solo letras y espacios (mínimo 3 caracteres).</p>
                        </div>

                        <!-- Botón -->
                        <div class="text-center">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white font-bold py-2 px-4 rounded-md shadow hover:shadow-lg hover:scale-105 transition duration-300">
                                Guardar Huésped
                            </button>
                        </div>
                    </form>
                </div>

                <!-- FORMULARIO DE HABITACIÓN -->
                <div id="habitacion" class="formulario max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-lg mt-6 hidden">
                    <form id="formHabitacion" action="../php/empleado_CRUD/guardar_habitacion.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6" novalidate>
                        <!-- Notificación general -->
                        <div id="notificacion" class="col-span-2 hidden bg-red-100 text-red-800 text-center p-2 rounded font-semibold shadow"></div>

                        <h2 class="col-span-2 text-2xl font-bold text-center text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t uppercase mb-4">
                            Agregar Habitación
                        </h2>

                        <!-- Columna izquierda: imagen + input -->
                        <div class="flex flex-col items-center justify-center">
                            <img id="preview" src="#" alt="Imagen habitación" class="rounded-lg mb-4 max-h-64 hidden">
                            <input type="file" id="imagen" name="imagen"
                                class="w-full file:bg-indigo-600 file:text-white file:px-4 file:py-2 file:rounded-md file:border-none file:shadow hover:file:bg-indigo-700 transition cursor-pointer" />
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-imagen">❗ Debes subir una imagen de la habitación.</p>
                        </div>

                        <!-- Columna derecha: campos -->
                        <div>
                            <!-- Nombre -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-1">Nombre habitación</label>
                                <input type="text" id="nombre" name="nombre" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <p class="text-sm text-red-600 mt-1 hidden" id="error-nombre">❗ Ingrese el nombre de la habitación.</p>
                            </div>

                            <!-- Dotación -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-1">Descripción / Dotación</label>
                                <textarea id="dotacion" name="dotacion" rows="3" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 resize-none"></textarea>
                                <p class="text-sm text-red-600 mt-1 hidden" id="error-dotacion">❗ Ingrese la dotación o descripción.</p>
                            </div>

                            <!-- Precio -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-1">Precio</label>
                                <input type="number" id="precio" name="precio" required min="1"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <p class="text-sm text-red-600 mt-1 hidden" id="error-precio">❗ Ingrese un precio válido mayor a 0.</p>
                            </div>

                            <!-- Disponibilidad -->
                            <div class="mb-6 flex items-center gap-4">
                                <label for="disponibilidad" class="text-gray-700 font-semibold">Disponibilidad</label>
                                <input type="checkbox" id="disponibilidad" name="disponibilidad" value="1"
                                    class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span id="dispo-label" class="text-sm text-gray-600">Disponible</span>
                            </div>

                            <!-- Botón -->
                            <div class="text-end">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white font-bold py-2 px-4 rounded-md shadow hover:shadow-lg hover:scale-105 transition duration-300">
                                    Guardar habitación
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                

                <!-- FORMULARIO DE ESTADÍA -->
                <div id="estadia" class="formulario hidden max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg mt-6">
                    <form id="formEstadia" action="../php/empleado_CRUD/guardar_estadia.php" method="POST" novalidate>
                        <!-- Notificación general -->
                        <div id="notificacion" class="hidden bg-red-100 text-red-800 text-center p-2 rounded mb-4 font-semibold shadow"></div>

                        <h2 class="text-2xl font-bold text-center text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t mb-6 uppercase">
                            Agregar Estadía
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Fechas -->
                            <div class="mb-4">
                                <label for="fecha_inicio" class="block text-gray-700 font-semibold mb-1">Fecha ingreso</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <p id="error-fecha_inicio" class="text-sm text-red-600 mt-1 hidden">❗ Ingrese la fecha de ingreso.</p>
                            </div>

                            <div class="mb-4">
                                <label for="fecha_fin" class="block text-gray-700 font-semibold mb-1">Fecha salida</label>
                                <input type="date" id="fecha_fin" name="fecha_fin" required min="<?= date('Y-m-d'); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <p id="error-fecha_fin" class="text-sm text-red-600 mt-1 hidden">❗ Ingrese la fecha de salida.</p>
                                <p id="error-fecha-logica" class="text-sm text-red-600 mt-1 hidden">❗ La fecha de salida no puede ser anterior a la de ingreso.</p>
                            </div>

                            <!-- Fecha registro -->
                            <div class="mb-4">
                                <label for="fecha_registro" class="block text-gray-700 font-semibold mb-1">Fecha de registro</label>
                                <input type="date" id="fecha_registro" name="fecha_registro" min="<?= date('Y-m-d'); ?>" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <p id="error-fecha_registro" class="text-sm text-red-600 mt-1 hidden">❗ Ingrese la fecha de registro.</p>
                            </div>

                            <!-- Costo -->
                            <div class="mb-4">
                                <label for="costo" class="block text-gray-700 font-semibold mb-1">Costo (COP)</label>
                                <input type="number" name="costo" id="costo" min="0" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <p id="error-costo" class="text-sm text-red-600 mt-1 hidden">❗ Ingrese un costo válido.</p>
                            </div>

                            <!-- ID habitación -->
                            <div class="mb-4 md:col-span-2">
                                <label for="id_habitacion" class="block text-gray-700 font-semibold mb-1">Habitación</label>
                                <select name="id_habitacion" id="id_habitacion" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                    <option value="">Seleccione una habitación</option>
                                    <?php
                                        include '../config/conexion.php';
                                        $result = mysqli_query($conexion, "SELECT id_habitacion,nombre FROM habitacion");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row['id_habitacion']}'>id: {$row['id_habitacion']} - {$row['nombre']}</option>";
                                        }
                                    ?>
                                </select>
                                <p id="error-id_habitacion" class="text-sm text-red-600 mt-1 hidden">❗ Seleccione una habitación.</p>
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="text-center mt-4">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white font-bold py-2 px-4 rounded-md shadow hover:shadow-lg hover:scale-105 transition duration-300">
                                Guardar Estadía
                            </button>
                        </div>
                    </form>
                </div>

                <!-- FORMULARIO DE NOVEDADES -->
                <div id="novedades" class="formulario hidden max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg mt-6">
                    <form id="formNovedad" action="../php/empleado_CRUD/guardar_novedades.php" method="POST" novalidate>
                        <!-- Notificación general -->
                        <div id="notificacion" class="hidden bg-red-100 text-red-800 text-center p-2 rounded mb-4 font-semibold shadow"></div>

                        <h2 class="text-2xl font-bold text-center text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t mb-6 uppercase">
                            Agregar Novedades
                        </h2>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 font-semibold mb-1">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p id="error-descripcion" class="text-sm text-red-600 mt-1 hidden">❗ Ingrese una descripción válida.</p>
                        </div>

                        <!-- ID Estadía -->
                        <div class="mb-4">
                            <label for="id_estadia2" class="block text-gray-700 font-semibold mb-1">Estadía</label>
                            <select name="id_estadia" id="id_estadia2" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <option value="">Seleccione una estadía</option>
                                <?php
                                include '../config/conexion.php';
                                $result = mysqli_query($conexion, "SELECT id_estadia FROM estadia");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id_estadia']}'>ID {$row['id_estadia']}</option>";
                                }
                                ?>
                            </select>
                            <p id="error-id_estadia" class="text-sm text-red-600 mt-1 hidden">❗ Seleccione una estadía válida.</p>
                        </div>

                        <!-- Botón -->
                        <div class="text-center mt-4">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white font-bold py-2 px-4 rounded-md shadow hover:shadow-lg hover:scale-105 transition duration-300">
                                Guardar Novedad
                            </button>
                        </div>
                    </form>
                </div>

                <!-- FORMULARIO DE HUESPED HAS ESTADO -->
                <div id="huesped_has_estado" class="formulario hidden max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg mt-6">
                    <form action="../php/empleado_CRUD/guardar_huesped_has_estado.php" method="POST" id="formHuespedHasEstado">
                        <!-- Notificación general -->
                        <div id="notificacion" class="hidden bg-red-100 text-red-800 text-center p-2 rounded mb-4 font-semibold shadow"></div>

                        <h2 class="text-2xl font-bold text-center text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t mb-6 uppercase">
                            Huésped - Estadía
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Huesped -->
                            <div class="mb-4">
                                <label for="id_huesped" class="block text-gray-700 font-semibold mb-1">ID Huésped</label>
                                <select name="id_huesped" id="id_huesped" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                                    <option value="">Seleccione un huésped</option>
                                    <?php
                                    include '../config/conexion.php';
                                    $result = mysqli_query($conexion, "SELECT id_huesped FROM huesped");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id_huesped']}'>ID {$row['id_huesped']}</option>";
                                    }
                                    ?>
                                </select>
                                <p id="error-id_huesped" class="text-sm text-red-600 mt-1 hidden">❗ Debes seleccionar un huésped.</p>
                            </div>

                            <!-- Estadía -->
                            <div class="mb-4">
                                <label for="id_estadia" class="block text-gray-700 font-semibold mb-1">ID Estadía</label>
                                <select name="id_estadia" id="id_estadia" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                                    <option value="">Seleccione una estadía</option>
                                    <?php
                                    $result = mysqli_query($conexion, "SELECT id_estadia FROM estadia");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id_estadia']}'>ID {$row['id_estadia']}</option>";
                                    }
                                    ?>
                                </select>
                                <p id="error-id_estadia" class="text-sm text-red-600 mt-1 hidden">❗ Debes seleccionar una estadía.</p>
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="text-center mt-4">
                            <button type="submit" class="w-full bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white font-bold py-2 px-4 rounded-md shadow hover:shadow-lg hover:scale-105 transition duration-300">
                                Aceptar
                            </button>
                        </div>
                    </form>
                </div>

                                
                <!-- FORMULARIO DE PAGOS -->
                <div id="pago" class="formulario hidden max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">
                    <form action="../php/empleado_CRUD/guardar_pagos.php" method="POST" id="formPago" novalidate>
                        <!-- Notificación general -->
                        <div id="notificacion" class="hidden bg-red-100 text-red-800 text-center p-2 rounded mb-4 font-semibold shadow"></div>

                        <h2 class="text-2xl font-bold text-center text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t mb-6 uppercase">
                            Agregar Pagos
                        </h2>

                        <!-- Fecha de pago -->
                        <div class="mb-4">
                            <label for="fecha_pago" class="block text-gray-700 font-semibold mb-1">Fecha de pago</label>
                            <input type="date" id="fecha_pago" name="fecha_pago" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-fecha_pago">❗ Seleccione una fecha válida.</p>
                        </div>

                        <!-- Valor -->
                        <div class="mb-4">
                            <label for="valor" class="block text-gray-700 font-semibold mb-1">Valor</label>
                            <input type="number" id="valor" name="valor" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-valor">❗ Ingrese un valor válido.</p>
                        </div>

                        <!-- ID Huésped -->
                        <div class="mb-4">
                            <label for="id_huesped2" class="block text-gray-700 font-semibold mb-1">ID Huésped</label>
                            <select name="id_huesped" id="id_huesped2" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <option value="">Seleccione un huésped</option>
                            <?php
                            include '../config/conexion.php';
                            $result = mysqli_query($conexion, "SELECT id_huesped FROM huesped");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['id_huesped']}'>ID {$row['id_huesped']}</option>";
                            }
                            ?>
                            </select>
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-id_huesped2">❗ Seleccione un huésped.</p>
                        </div>

                        <!-- ID Estadía -->
                        <div class="mb-4">
                            <label for="id_estadia2" class="block text-gray-700 font-semibold mb-1">ID Estadía</label>
                            <select name="id_estadia" id="id_estadia3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <option value="">Seleccione una estadía</option>
                            <?php
                            $result = mysqli_query($conexion, "SELECT id_estadia FROM estadia");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['id_estadia']}'>ID {$row['id_estadia']}</option>";
                            }
                            ?>
                            </select>
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-id_estadia2">❗ Seleccione una estadía.</p>
                        </div>

                        <!-- ID Empleado -->
                        <div class="mb-4">
                            <label for="id_empleado2" class="block text-gray-700 font-semibold mb-1">ID Empleado</label>
                            <select name="id_empleado" id="id_empleado2" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <option value="">Seleccione un empleado</option>
                            <?php
                            $result = mysqli_query($conexion, "SELECT id_empleado FROM empleado");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['id_empleado']}'>ID {$row['id_empleado']}</option>";
                            }
                            ?>
                            </select>
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-id_empleado2">❗ Seleccione un empleado.</p>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label for="imagen2" class="block text-gray-700 font-semibold mb-1">Imagen (URL o ID)</label>
                            <input type="text" id="imagen2" name="imagen2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-imagen2">❗ Ingrese una URL o ID de imagen válida.</p>
                        </div>

                        <!-- Observación -->
                        <div class="mb-4">
                            <label for="observacion" class="block text-gray-700 font-semibold mb-1">Observación</label>
                            <textarea id="observacion" name="observacion" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500"></textarea>
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-observacion">❗ Ingrese una observación válida.</p>
                        </div>

                        <!-- Botón -->
                        <div class="text-center">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white font-bold py-2 px-4 rounded-md shadow hover:shadow-lg hover:scale-105 transition duration-300">
                                Guardar Pago
                            </button>
                        </div>
                    </form>
                </div>

                        
                                
                <!-- FORMULARIO DE OTRO INGRESO -->
                <div id="otroingreso" class="formulario hidden max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">
                    <form action="../php/empleado_CRUD/guardar_otro_ingreso.php" method="POST" id="formOtroIngreso" novalidate>
                        <!-- Notificación general -->
                        <div id="notificacion" class="hidden bg-red-100 text-red-800 text-center p-2 rounded mb-4 font-semibold shadow"></div>

                        <h2 class="text-2xl font-bold text-center text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t mb-6 uppercase">
                            Agregar Otros Ingresos
                        </h2>

                        <!-- Fecha de Registro -->
                        <div class="mb-4">
                            <label for="fecha_registro" class="block text-gray-700 font-semibold mb-1">Fecha de Registro</label>
                            <input type="date" name="fecha_registro" id="fecha_registro2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-fecha_registro">❗ Seleccione una fecha válida.</p>
                        </div>

                        <!-- Total -->
                        <div class="mb-4">
                            <label for="total" class="block text-gray-700 font-semibold mb-1">Total</label>
                            <input type="number" name="total" id="total"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-total">❗ Ingrese un valor válido.</p>
                        </div>

                        <!-- ID Empleado -->
                        <div class="mb-4">
                            <label for="id_empleado" class="block text-gray-700 font-semibold mb-1">ID Empleado</label>
                            <select name="id_empleado" id="id_empleado3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500">
                            <option value="">Seleccione un empleado</option>
                            <?php
                                include '../config/conexion.php';
                                $result = mysqli_query($conexion, "SELECT id_empleado FROM empleado");
                                while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['id_empleado']}'>ID {$row['id_empleado']}</option>";
                                }
                            ?>
                            </select>
                            <p class="text-sm text-red-600 mt-1 hidden" id="error-id_empleado">❗ Seleccione un empleado.</p>
                        </div>

                        <!-- Botón -->
                        <div class="text-center">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white font-bold py-2 px-4 rounded-md shadow hover:shadow-lg hover:scale-105 transition duration-300">
                                Guardar Ingreso
                            </button>
                        </div>
                    </form>
                </div>
                </div>

                        
                <!-- FORMULARIO DE TARIFAS -->
                <div id="tarifas" class="formulario hidden flex justify-center mt-6">
                    <div class="w-full max-w-2xl bg-gray-900 text-white p-6 rounded-xl shadow-lg">
                        <form action="../php/empleado_CRUD/guardar_tarifa.php" method="POST" class="space-y-5" id="formTarifas">
                            <h2 class="text-2xl font-bold text-center mb-6">Agregar Tarifas</h2>

                            <!-- Día -->
                            <div>
                                <label for="dia" class="block mb-1 font-semibold">Día</label>
                                <input type="number" name="dia" id="dia" required min="1"
                                class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <p id="error-dia" class="text-red-500 text-sm hidden">⚠️ Ingrese una tarifa diaria válida.</p>
                            </div>

                            <!-- Semana -->
                            <div>
                                <label for="semana" class="block mb-1 font-semibold">Semana</label>
                                <input type="text" name="semana" id="semana" required
                                class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <p id="error-semana" class="text-red-500 text-sm hidden">⚠️ Ingrese una tarifa semanal válida.</p>
                            </div>

                            <!-- Quincena -->
                            <div>
                                <label for="quincena" class="block mb-1 font-semibold">Quincena</label>
                                <input type="number" name="quincena" id="quincena" required min="1"
                                class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <p id="error-quincena" class="text-red-500 text-sm hidden">⚠️ Ingrese una tarifa quincenal válida.</p>
                            </div>

                            <!-- Mensual -->
                            <div>
                                <label for="mensual" class="block mb-1 font-semibold">Mensual</label>
                                <input type="number" name="mensual" id="mensual" required min="1"
                                class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <p id="error-mensual" class="text-red-500 text-sm hidden">⚠️ Ingrese una tarifa mensual válida.</p>
                            </div>

                            <!-- ID Habitación -->
                            <div>
                                <label for="id_habitacion2" class="block mb-1 font-semibold">ID Habitación</label>
                                <select name="id_habitacion" id="id_habitacion2" required
                                class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Seleccione una habitación</option>
                                <?php
                                    include '../config/conexion.php';
                                    $result = mysqli_query($conexion, "SELECT id_habitacion FROM habitacion");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id_habitacion']}'>ID {$row['id_habitacion']}</option>";
                                    }
                                ?>
                                </select>
                                <p id="error-id_habitacion2" class="text-red-500 text-sm hidden">⚠️ Seleccione una habitación.</p>
                            </div>

                            <!-- Notificación general -->
                            <p id="notificacion" class="text-red-600 font-semibold hidden text-center">❗ Por favor corrija los campos señalados.</p>

                            <!-- Botón -->
                            <div class="text-end">
                                <button type="submit"
                                class="w-full bg-gradient-to-r from-green-700 via-green-600 to-green-800 hover:from-green-800 hover:to-green-900 text-white font-semibold py-2 px-4 rounded-md shadow">
                                Aceptar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                                
                <!-- FORMULARIO DE OTRO INGRESO -->
                <div id="otroingreso" class="formulario hidden flex justify-center mt-6">
                    <div class="w-full max-w-2xl bg-gray-900 text-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-2xl font-bold text-center mb-6">Agregar Otro Ingresos</h2>

                        <form action="../php/empleado_CRUD/guardar_otroingreso.php" method="POST" class="space-y-5">

                            <!-- Fecha de Registro -->
                            <div>
                                <label for="fecha_registro" class="block mb-1 font-semibold">Fecha de Registro</label>
                                <input type="date" name="fecha_registro" id="fecha_registro2"
                                class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <!-- Total -->
                            <div>
                                <label for="total" class="block mb-1 font-semibold">Total</label>
                                <input type="number" name="total" id="total"
                                class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <!-- ID Empleado -->
                            <div>
                                <label for="id_empleado" class="block mb-1 font-semibold">ID Empleado</label>
                                <select name="id_empleado" id="id_empleado3" required
                                class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
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

                            <!-- Botón -->
                            <div class="text-end">
                                <button type="submit"
                                class="w-full bg-gradient-to-r from-green-700 via-green-600 to-green-800 hover:from-green-800 hover:to-green-900 text-white font-semibold py-2 px-4 rounded-md shadow">
                                Enviar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </main>
                
            
            
        </div>
                
        <script src="../js/validaciones.js"></script>
        <script>
            // Script para mostrar y ocultar formularios
                const selector = document.getElementById('formSelect');                 // Cambia 'formSelect' por el ID correcto
                const formularios = document.querySelectorAll('.formulario');           // Cambia '.formulario' por la clase correcta

                selector.addEventListener('change', () => {                             // Cambia 'change' por el evento correcto
                    formularios.forEach(form => form.classList.add('hidden'));          // Oculta todos
                    const seleccionado = document.getElementById(selector.value);       // Cambia 'selector.value' por el ID correcto
                    if (seleccionado) {                                                 // Verifica si el elemento existe
                        seleccionado.classList.remove('hidden');                        // Muestra el elegido
                    }
                });

            // Mostrar formulario por defecto (el primero)
                document.getElementById(selector.value).classList.remove('hidden');                 // Cambia 'selector.value' por el ID correcto   



            // Script para previsualizar imagen habitación
                const inputImagen = document.getElementById("imagen");                  // Cambia "imagen" por el ID correcto
                const preview = document.getElementById("preview");                     // Cambia "preview" por el ID correcto
                if (inputImagen) {                                                      // Verifica si el elemento existe
                    inputImagen.addEventListener("change", function (event) {           // Escucha el evento "change"
                        const file = event.target.files[0];                             // Obtiene el archivo seleccionado
                        if (file) {                                                     // Verifica si se seleccionó un archivo
                            const reader = new FileReader();                            // Crea un objeto FileReader
                            reader.onload = function (e) {                              // Escucha el evento "load"
                                preview.src = e.target.result;                          // Actualiza la imagen
                                preview.style.display = "block";                        // Muestra la imagen
                            };
                            reader.readAsDataURL(file);                                 // Lee el archivo como URL
                        } else {
                            preview.style.display = "none";                             // Oculta la imagen
                        }
                    });
                }

            // Script para previsualizar imagen pagos
                const inputImagen2 = document.getElementById("imagen2");            // Cambia "imagen2" por el ID correcto         
                if (inputImagen2) {                                                 // Verifica si el elemento existe
                    inputImagen2.addEventListener("change", function (event) {      // Escucha el evento "change"
                        const file = event.target.files[0];                         // Obtiene el archivo seleccionado
                        if (file) {                                                 // Verifica si se seleccionó un archivo
                            const reader = new FileReader();                        // Crea un objeto FileReader
                            reader.onload = function (e) {                          // Escucha el evento "load"
                                inputimagen2.src = e.target.result;                 // Actualiza la imagen
                                inputImagen2.style.display = "block";               // Muestra la imagen
                            };
                            reader.readAsDataURL(file);                             // Lee el archivo como URL
                        } else {
                            inputImagen2.style.display = "none";                    // Oculta la imagen
                        }
                    });
                }

                // Switch de disponibilidad
                    const switchInput = document.getElementById("disponibilidad");      // Cambia "disponibilidad" por el ID correcto
                    const dispoLabel = document.getElementById("dispo-label");          // Cambia "dispo-label" por el ID correcto
                    if (switchInput && dispoLabel) {                                    // Verifica si ambos elementos existen
                        function actualizarSwitchColor() {                              // Función para actualizar el color
                            if (switchInput.checked) {                                  // Verifica si el switch está activado
                                switchInput.style.backgroundColor = "#28a745";          // verde
                                dispoLabel.textContent = "Disponible";                  // Cambia el texto
                            } else {
                                switchInput.style.backgroundColor = "#dc3545";          // rojo
                                dispoLabel.textContent = "No disponible";               // Cambia el texto
                            }
                        }

                        switchInput.addEventListener("change", actualizarSwitchColor);
                        actualizarSwitchColor();                                        // estado inicial
                    }

                // Temporizador de inactividad
                    const tiempoMaximoInactividad = 300000;                             // 5 min
                    const tiempoAviso = 60000;                                          // 1 min antes

                    setTimeout(() => {                                                  // 5 min
                        alert("Tu sesión está a punto de expirar. Por favor, realiza alguna acción."); // aviso 1 min antes
                    }, tiempoMaximoInactividad - tiempoAviso);  // 5 min - 1 min antes

                    setTimeout(() => {                                                  // 5 min
                        window.location.href = "../php/cerrar_sesion.php";                         // Redirigir al logout
                    }, tiempoMaximoInactividad);                                       // 5 min
        </script>

    </body>
</html>
<?php
include "../config/conexion.php";
session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
    exit();
}

// Verificar si llegó el ID del pago
if (isset($_GET['id'])) {
    $id_pago = $_GET['id'];
    $query = "SELECT * FROM pagos WHERE id_pagos = $id_pago";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
    } else {
        echo "<p class='text-red-500'>Pago no encontrado.</p>";
    }
} else {
    echo "<p class='text-red-500'>ID no proporcionado.</p>";
}
?>


<!doctype html>
<html>


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-200 text-gray-800 min-h-screen">
        <div class="text-center">

            <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                    <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
                    <div>
                        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-200 bg-clip-text text-transparent">Panel de Administración</h1>
                        <p class="text-sm text-indigo-200">Gestión de habitaciones</p>
                    </div>
                    </div>
                    <?php $pagina = basename($_SERVER['PHP_SELF']); ?>
                    <nav class="flex flex-wrap gap-3 text-sm md:text-base">
                        <a href="index_admin.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'index_admin.php') ? 'border-b-2 border-white' : ''; ?>">🏠 Inicio</a>
                        <a href="formulario.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'formulario.php') ? 'border-b-2 border-white' : ''; ?>">📝 Registrar</a>
                        <a href="ver_tablas.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ver_tablas.php') ? 'border-b-2 border-white' : ''; ?>">📋 Ver Datos</a>
                        <a href="galeria_admin.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'galeria_admin.php') ? 'border-b-2 border-white' : ''; ?>">🖼️ Galería</a>
                        <a href="ubicacion_admin.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ubicacion_admin.php') ? 'border-b-2 border-white' : ''; ?>">📍 Ubicación</a>
                        <a href="nosotros_admin.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'nosotros_admin.php') ? 'border-b-2 border-white' : ''; ?>">👥 Nosotros</a>
                        <a href="contactos_admin.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'contactos_admin.php') ? 'border-b-2 border-white' : ''; ?>">📞 Contacto</a>
                        <a href="generar_informes.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'generar_informes.php') ? 'border-b-2 border-white' : ''; ?>">📊 Informes</a>
                        <a href="informe_financiero.php" class="px-3 py-1.5 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'informes_financieros.php') ? 'border-b-2 border-white' : ''; ?>">📊 Informes financieros</a>
                        <a href="../php/cerrar_sesion_admin.php" class="bg-red-600 hover:bg-red-700 px-4 py-1.5 rounded text-white font-bold shadow text-sm">
                        Cerrar sesión
                        </a>
                    </nav>
                </div>
            </header>

            <main class="p-8">
                
                <div class="w-full max-w-2xl bg-gray-900 text-white p-6 rounded-xl shadow-lg mx-auto mt-6">
                    <h2 class="text-2xl font-bold text-center mb-6">Editar Pago</h2>

                    <form action="../php/actualizar_pagos.php" method="POST" class="space-y-4">

                        <input type="hidden" name="id_pagos" value="<?= $row['id_pagos'] ?>">

                        <div>
                            <label class="block mb-1 font-semibold" for="fecha_pago">Fecha de pago</label>
                            <input type="date" name="fecha_pago" value="<?= $row['fecha_pago'] ?>" required
                                class="w-full px-4 py-2 text-black bg-white rounded-md border border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold" for="valor">Valor</label>
                            <input type="number" name="valor" value="<?= $row['valor'] ?>" required
                                class="w-full px-4 py-2 text-black bg-white rounded-md border border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold" for="id_huesped">ID Huésped</label>
                            <input type="number" name="id_huesped" value="<?= $row['id_huesped'] ?>" required
                                class="w-full px-4 py-2 text-black bg-white rounded-md border border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold" for="id_estadia">ID Estadía</label>
                            <input type="number" name="id_estadia" value="<?= $row['id_estadia'] ?>" required
                                class="w-full px-4 py-2 text-black bg-white rounded-md border border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold" for="id_empleado">ID Empleado</label>
                            <input type="number" name="id_empleado" value="<?= $row['id_empleado'] ?>" required
                                class="w-full px-4 py-2 text-black bg-white rounded-md border border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold" for="imagen">Imagen</label>
                            <input type="text" name="imagen" value="<?= $row['imagen'] ?>"
                                class="w-full px-4 py-2 text-black bg-white rounded-md border border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold" for="observacion">Observación</label>
                            <textarea name="observacion" rows="3"
                                class="w-full px-4 py-2 text-black bg-white rounded-md border border-gray-300"><?= $row['observacion'] ?></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white font-semibold py-2 px-4 rounded-md shadow">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>

                
            </main>
        <div>   
        
        <script>
            // Temporizador de inactividad
            const tiempoMaximoInactividad = 300000;                             // 5 min
            const tiempoAviso = 60000;                                          // 1 min antes

            setTimeout(() => {                                                  // 5 min
            alert("Tu sesión está a punto de expirar. Por favor, realiza alguna acción."); // aviso 1 min antes
            }, tiempoMaximoInactividad - tiempoAviso);  // 5 min - 1 min antes

            setTimeout(() => {                                                  // 5 min
            window.location.href = "../php/cerrar_sesion_admin.php";                         // Redirigir al logout
            }, tiempoMaximoInactividad);
            
        </script>
        
    </body>

</html>
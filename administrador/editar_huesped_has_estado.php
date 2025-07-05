<?php
include '../config/conexion.php';
session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
    exit();
}

if (isset($_POST['id_huesped']) && isset($_POST['id_estadia'])) {
    $id_huesped = mysqli_real_escape_string($conexion, $_POST['id_huesped']);
    $id_estadia = mysqli_real_escape_string($conexion, $_POST['id_estadia']);

    $sql = "SELECT * FROM huesped_has_estado WHERE id_huesped = $id_huesped AND id_estadia = $id_estadia";
    $res = mysqli_query($conexion, $sql);

    if (!$res || mysqli_num_rows($res) === 0) {
        echo "⚠️ Asociación no encontrada.";
        exit;
    }

    $datos = mysqli_fetch_assoc($res);
} else {
    echo "❌ Error: No se recibieron los parámetros necesarios (id_huesped o id_estadia).";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asociación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    

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
                <a href="../php/cerrar_sesion_admin.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-white font-bold shadow">Cerrar sesión</a>
        </nav>
    </div>
</header>

<form action="../php/actualizar_huesped_has_estado.php" method="POST" class="max-w-2xl mx-auto mt-10 bg-gray-800 text-white p-8 rounded-2xl shadow-2xl space-y-6">

    <h2 class="text-3xl font-bold text-center text-blue-100 mb-6">Editar Asociación Huésped - Estadía</h2>

    <!-- Campos ocultos para IDs antiguos -->
    <input type="hidden" name="id_huesped_old" value="<?php echo $datos['id_huesped']; ?>">
    <input type="hidden" name="id_estadia_old" value="<?php echo $datos['id_estadia']; ?>">

    <!-- ID Huésped -->
    <div>
        <label for="id_huesped" class="block text-lg font-semibold text-indigo-300 mb-2">Nuevo ID Huésped</label>
        <select name="id_huesped" required class="w-full bg-gray-700 text-white border border-indigo-500 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <?php
                $resH = mysqli_query($conexion, "SELECT id_huesped FROM huesped");
                while ($row = mysqli_fetch_assoc($resH)) {
                    $selected = ($row['id_huesped'] == $datos['id_huesped']) ? 'selected' : '';
                    echo "<option value='{$row['id_huesped']}' $selected>ID {$row['id_huesped']}</option>";
                }
            ?>
        </select>
    </div>

    <!-- ID Estadía -->
    <div>
        <label for="id_estadia" class="block text-lg font-semibold text-indigo-300 mb-2">Nuevo ID Estadía</label>
        <select name="id_estadia" required class="w-full bg-gray-700 text-white border border-indigo-500 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <?php
                $resE = mysqli_query($conexion, "SELECT id_estadia FROM estadia");
                while ($row = mysqli_fetch_assoc($resE)) {
                    $selected = ($row['id_estadia'] == $datos['id_estadia']) ? 'selected' : '';
                    echo "<option value='{$row['id_estadia']}' $selected>ID {$row['id_estadia']}</option>";
                }
            ?>
        </select>
    </div>

    <!-- Botón de envío -->
    <div class="text-center">
        <button type="submit" class="bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 hover:from-blue-800 hover:to-purple-800 transition duration-300 text-white font-semibold py-3 px-8 rounded-lg shadow-lg">
            💾 Actualizar Asociación
        </button>
    </div>
</form>

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

<?php
include '../config/conexion.php';

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


$id_huesped = $_GET['id_huesped'];
$id_estadia = $_GET['id_estadia'];

$sql = "SELECT * FROM huesped_has_estado WHERE id_huesped = $id_huesped AND id_estadia = $id_estadia";
$res = mysqli_query($conexion, $sql);
$datos = mysqli_fetch_assoc($res);
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

<form action="../php/empleado_CRUD/actualizar_huesped_has_estado.php" method="POST" class="max-w-2xl mx-auto mt-10 bg-gray-800 text-white p-8 rounded-2xl shadow-2xl space-y-6">

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
        <a href="ver_tablas_E.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Cancelar</a>
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
        window.location.href = "../phpc/cerrar_sesion_admin.php";                         // Redirigir al logout
      }, tiempoMaximoInactividad);
      
  </script>

</body>
</html>

<?php
include "../config/conexion.php";

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

// Asegurar que el ID sea seguro y un número entero
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Usar consulta preparada para evitar inyecciones
$stmt = $conexion->prepare("SELECT * FROM estadia WHERE id_estadia = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$estadia = $resultado->fetch_assoc();

if (!$estadia) {
    echo "Estadía no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Estadía</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300">

<!-- Navegador -->
<header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
  <div class="flex justify-between items-center">
    <div class="flex items-center gap-4">
      <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
      <div class="text-left">
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-200 bg-clip-text text-transparent">Panel de empleado</h1>
        <p class="text-sm text-indigo-200">formulario</p>
      </div>
    </div>
    <?php $pagina = basename($_SERVER['PHP_SELF']); ?>
    <nav class="flex flex-wrap gap-4 text-sm md:text-base">
      <a href="index_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'index_E.php') ? 'border-b-2 border-white' : '' ?>">🏠 Inicio</a>
      <a href="formulario_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'formulario_E.php') ? 'border-b-2 border-white' : '' ?>">📝 Registrar</a>
      <a href="ver_tablas_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ver_tablas_E.php') ? 'border-b-2 border-white' : '' ?>">📋 Ver Datos</a>
      <a href="galeria_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'galeria_E.php') ? 'border-b-2 border-white' : '' ?>">🖼️ Galería</a>
      <a href="ubicacion_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ubicacion_E.php') ? 'border-b-2 border-white' : '' ?>">📍 Ubicación</a>
      <a href="nosotros_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'nosotros_E.php') ? 'border-b-2 border-white' : '' ?>">👥 Nosotros</a>
      <a href="contacto_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'contactos_E.php') ? 'border-b-2 border-white' : '' ?>">📞 Contacto</a>
      <a href="../php/cerrar_sesion_admin.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-white font-bold shadow">Cerrar sesión</a>
      <!-- Perfil del empleado -->
      <div class="flex items-center gap-2 bg-indigo-900 px-3 py-2 rounded-xl shadow-md">
        <img src="../img/perfil.jpg" alt="Perfil" class="w-10 h-10 rounded-full border-2 border-white">
        <span class="text-white font-medium text-sm hidden sm:block"><?php echo $empleado['usuario']; ?></span>
      </div>
    </nav>
  </div>
</header>

<!-- Formulario de edición -->
<main class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-xl shadow-indigo-900">
  <h3 class="text-3xl font-bold text-gray-800 mb-6 text-center">Editar Estadía</h3>
  <form method="POST" action="../php/empleado_CRUD/actualizar_estadia.php" class="space-y-6">
    <input type="hidden" name="id_estadia" value="<?= $estadia['id_estadia'] ?>">

    <div>
      <label class="block text-indigo-700 font-semibold mb-2">Fecha Inicio:</label>
      <input type="date" name="fecha_inicio" value="<?= $estadia['fecha_inicio'] ?>" class="w-full px-4 py-2 border border-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
    </div>

    <div>
      <label class="block text-indigo-700 font-semibold mb-2">Fecha Fin:</label>
      <input type="date" name="fecha_fin" value="<?= $estadia['fecha_fin'] ?>" class="w-full px-4 py-2 border border-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
    </div>

    <div>
      <label class="block text-indigo-700 font-semibold mb-2">Fecha Registro:</label>
      <input type="datetime-local" name="fecha_registro" value="<?= $estadia['fecha_registro'] ?>" class="w-full px-4 py-2 border border-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
    </div>

    <div>
      <label class="block text-indigo-700 font-semibold mb-2">Costo:</label>
      <input type="number" name="costo" value="<?= $estadia['costo'] ?>" class="w-full px-4 py-2 border border-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
    </div>

    <div>
      <label class="block text-indigo-700 font-semibold mb-2">ID Habitación:</label>
      <input type="number" name="id_habitacion" value="<?= $estadia['id_habitacion'] ?>" class="w-full px-4 py-2 border border-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
    </div>

    <div class="flex justify-between">
      <a href="ver_tablas_E.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Cancelar</a>
      <button type="submit" class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 hover:opacity-90 text-white font-bold py-2 px-6 rounded-lg shadow-lg">Actualizar</button>
    </div>
  </form>
</main>

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

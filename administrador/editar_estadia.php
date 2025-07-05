<?php
include "../config/conexion.php";

session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
    exit();
}

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

<!-- Formulario de edición -->
<main class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-xl shadow-indigo-900">
  <h3 class="text-3xl font-bold text-gray-800 mb-6 text-center">Editar Estadía</h3>
  <form method="POST" action="../php/actualizar_estadia.php" class="space-y-6">
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
      <a href="ver_tablas.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Cancelar</a>
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

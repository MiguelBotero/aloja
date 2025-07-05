<?php
include "../config/conexion.php";

session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
    exit();
}

// Verificar si el ID fue pasado por GET
if (!isset($_GET['id'])) {
    echo "<script>alert('ID de empleado no especificado.'); window.location.href='ver_tablas.php';</script>";
    exit;
}

$id = intval($_GET['id']);

// Obtener los datos del empleado
$query = "SELECT * FROM empleado WHERE id_empleado = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "<script>alert('Empleado no encontrado.'); window.location.href='ver_tablas.php';</script>";
    exit;
}

$empleado = $resultado->fetch_assoc();
$stmt->close();
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Empleado - Aloja</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300">
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

  <main class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-xl shadow-indigo-900">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Editar Empleado</h2>
    <form action="../php/actualizar_empleado.php" method="POST" class="space-y-6">
        <input type="hidden" name="id_empleado" value="<?= $empleado['id_empleado'] ?>">
      <div>
        <label for="nombre_completo" class="block text-indigo-700 font-semibold mb-2">Nombre completo:</label>
        <input type="text" id="nombre_completo" name="nombre_completo" value="<?php echo htmlspecialchars($empleado['nombre_completo']); ?>" required class="w-full px-4 py-2 border border-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
      </div>
      <div>
        <label for="usuario" class="block text-indigo-700 font-semibold mb-2">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($empleado['usuario']); ?>" required class="w-full px-4 py-2 border border-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
      </div>
      <div>
        <label for="password" class="block text-indigo-700 font-semibold mb-2">Contraseña:</label>
        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($empleado['password']); ?>" required class="w-full px-4 py-2 border border-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
      </div>
      <div class="flex justify-between">
        <a href="ver_tablas.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Cancelar</a>
        <button type="submit" class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 hover:opacity-90 text-white font-bold py-2 px-6 rounded-lg shadow-lg">Guardar empleado</button>
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

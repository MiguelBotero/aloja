<?php 
include '../config/conexion.php';

session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
    exit();
}


$id_novedades = $_GET['id'] ?? null;

if ($id_novedades) {
    $query = "SELECT * FROM novedades WHERE id_novedades = $id_novedades";
    $resultado = mysqli_query($conexion, $query);
    $novedad = mysqli_fetch_assoc($resultado);
} else {
    echo "<script>alert('ID de novedad no válido'); window.location.href='ver_tablas.php';</script>";
    exit;
}

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar novedades - Aloja</title>
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

  <main class="max-w-4xl mx-auto mt-12 p-8 bg-white rounded-xl shadow-2xl">
    <h2 class="text-2xl font-bold text-indigo-900 mb-6">Editar novedad</h2>
    <form action="../php/actualizar_novedades.php" method="POST" class="space-y-6">
      <!-- Campo oculto para el ID -->
      <input type="hidden" name="id_novedades" value="<?= htmlspecialchars($novedad['id_novedades']) ?>">

      <div>
        <label for="descripcion" class="block mb-2 text-lg font-medium text-indigo-800">Descripción</label>
        <textarea id="descripcion" name="descripcion" required class="w-full p-3 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"><?= htmlspecialchars($novedad['descripcion']) ?></textarea>
      </div>

      <div>
        <label for="id_estadia" class="block mb-2 text-lg font-medium text-indigo-800">ID Estadia</label>
        <input type="text" id="id_estadia" name="id_estadia" value="<?= htmlspecialchars($novedad['id_estadia']) ?>" required class="w-full p-3 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div class="flex justify-between">
        <a href="ver_tablas.php" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-2 rounded shadow">Cancelar</a>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">Guardar cambios</button>
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


<?php
include("config/conexion.php");

$sql = "SELECT * FROM nosotros LIMIT 1";
$resultado = mysqli_query($conexion, $sql);
$datos = mysqli_fetch_assoc($resultado);
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nosotros - Aloja</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-300 text-white min-h-screen">
    <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 shadow-2xl px-6 py-4">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-4">
          <img class="w-24 h-24 p-2 object-cover rounded-full border-4 border-white shadow-md" src="img/aloja-removebg-preview.png" alt="Logo">
          <h1 class="text-4xl font-extrabold tracking-wide text-indigo-100 drop-shadow-md">Bienvenido a Aloja</h1>
        </div>
        <div class="flex flex-wrap md:flex-nowrap items-center gap-20">
          <?php $pagina = basename($_SERVER['PHP_SELF']); ?>
          <nav class="flex flex-wrap gap-4 text-sm md:text-base">
            <a href="index.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'index.php') ? 'border-b-2 border-white' : ''; ?>">🏠 Inicio</a>
            <a href="galeria.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'galeria.php') ? 'border-b-2 border-white' : ''; ?>">🖼️ Galería</a>
            <a href="ubicacion.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ubicacion.php') ? 'border-b-2 border-white' : ''; ?>">📍 Ubicación</a>
            <a href="nosotros.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'nosotros.php') ? 'border-b-2 border-white' : ''; ?>">👥 Nosotros</a>
            <a href="contactos.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'contactos.php') ? 'border-b-2 border-white' : ''; ?>">📞 Contacto</a>
          </nav>
          <a href="sesion.php" class="ml-2 bg-gradient-to-r from-zinc-950 via-indigo-950 to-blue-950 hover:from-blue-950 hover:via-indigo-950 hover:to-zinc-950 text-white px-5 py-2 rounded-xl font-semibold shadow-lg transition">Iniciar sesión</a>
        </div>
      </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-16">
      <h2 class="text-4xl font-bold text-indigo-900 text-center mb-12 drop-shadow">Nosotros</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl text-gray-800 hover:scale-105 transition-transform border-2 border-indigo-600">
          <h3 class="text-2xl font-bold text-indigo-900 mb-4">🏛️ Nuestra Historia</h3>
          <p class="leading-relaxed text-justify"><?php echo $datos['historia']; ?></p>
        </div>
        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl text-gray-800 hover:scale-105 transition-transform border-2 border-indigo-600">
          <h3 class="text-2xl font-bold text-indigo-900 mb-4">🤝 Atención Personalizada</h3>
          <p class="leading-relaxed text-justify"><?php echo $datos['atencion_personalizada']; ?></p>
        </div>
        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl text-gray-800 hover:scale-105 transition-transform border-2 border-indigo-600">
          <h3 class="text-2xl font-bold text-indigo-900 mb-4">💡 Filosofía de Servicio</h3>
          <p class="leading-relaxed text-justify"><?php echo $datos['filosofia_servicio']; ?></p>
        </div>
      </div>

      <div class="mt-16 grid md:grid-cols-2 gap-10">
        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl text-gray-800 hover:scale-105 transition-transform border border-indigo-500">
          <h3 class="text-2xl font-bold text-indigo-900 mb-4">📸 Nuestra Imagen</h3>
          <img src="img/foto-hotel.jpg" alt="Hotel" class="w-full h-[350px] object-cover rounded-xl shadow-md">
        </div>
        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl text-gray-800 hover:scale-105 transition-transform border border-indigo-500">
          <h3 class="text-2xl font-bold text-indigo-900 mb-4">🌟 Nuestros Valores</h3>
          <ul class="list-disc pl-5 space-y-2">
            <li>Compromiso con la calidad y el confort</li>
            <li>Hospitalidad con sentido humano</li>
            <li>Transparencia y ética profesional</li>
            <li>Conexión con la comunidad local</li>
            <li>Innovación en nuestros servicios</li>
            <li>Inclusión y respeto por la diversidad</li>
            <li>Responsabilidad ambiental y social</li>
            <li>Empatía y cercanía con nuestros clientes</li>
            <li>Mejora continua y aprendizaje constante</li>
          </ul>
        </div>
      </div>
    </main>

    <footer class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-center text-indigo-200 py-6 mt-12 shadow-inner">
    <p class="text-sm">&copy; <?php echo date('Y'); ?> Aloja. Todos los derechos reservados.</p>
    </footer>
  </body>
</html>

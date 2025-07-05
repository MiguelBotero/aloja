<?php
session_start();
include "../config/conexion.php";
if (!isset($_SESSION['admin'])) {
  echo "Sesión no iniciada";
  exit();
}
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido a Aloja</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-300 text-white">
<header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
  <div class="flex justify-between items-center">
    <div class="flex items-center gap-4">
      <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
      <div>
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-200 bg-clip-text text-transparent">Panel de Administración</h1>
        <p class="text-sm text-indigo-200">Gestion de ubicacion</p>
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

    <main class="max-w-screen-2xl mx-auto px-6 py-20 space-y-20">
      <div class="grid md:grid-cols-2 gap-16">
        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl border border-indigo-500">
          <h2 class="text-4xl font-bold mb-6 text-indigo-900 text-center">Ubicación del Hotel</h2>
          <div class="w-full h-[450px] rounded-xl overflow-hidden shadow-md">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3811.176182717322!2d-75.56854100031241!3d6.250283055282282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428f8c95aa461%3A0xf5680e5fb8a4b8e8!2sParque%20Berr%C3%ADo!5e1!3m2!1ses!2sco!4v1745466284358!5m2!1ses!2sco" 
              width="100%" 
              height="100%" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <p class="mt-6 text-indigo-900  leading-relaxed">Nos encontramos ubicados en el corazón de Medellín, a pocos pasos de los principales puntos turísticos, estaciones del metro y zonas comerciales.</p>
          <ul class="mt-4 text-indigo-900  space-y-1">
            <li>🚌 Transporte público cercano</li>
            <li>🏪 Supermercados y restaurantes a menos de 500m</li>
            <li>🏞️ Parques y espacios verdes a 3 cuadras</li>
            <li>🚶‍♂️ Acceso peatonal y ciclovía frente al hotel</li>
          </ul>
        </div>

        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl border border-indigo-500">
          <h2 class="text-4xl font-bold mb-6 text-indigo-900  text-center">Nuestra Fachada</h2>
          <img src="img/foto-hotel.jpg" alt="Foto del Hotel" class="rounded-xl w-full h-[450px] object-cover shadow-md">
          <p class="mt-6 text-indigo-900 leading-relaxed">Nuestro hotel cuenta con una arquitectura moderna y elegante, diseñada para brindar una experiencia única desde el primer momento. ¡Te esperamos con los brazos abiertos!</p>
          <div class="mt-6  p-5 rounded-xl">
            <h3 class="text-indigo-900  font-semibold mb-2 text-lg">🕒 Horarios de atención:</h3>
            <ul class="text-base text-indigo-900  space-y-1">
              <li>Check-in: 3:00 PM</li>
              <li>Check-out: 11:00 AM</li>
              <li>Recepción: 24 horas</li>
            </ul>
          </div>
        </div>
      </div>
    </main>

    <footer class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-center text-indigo-200 py-6 mt-12 shadow-inner">
    <p class="text-sm">&copy; <?php echo date('Y'); ?> Aloja. Todos los derechos reservados.</p>
    </footer>

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

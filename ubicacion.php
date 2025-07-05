<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido a Aloja</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-300 text-white">
    <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 shadow-2xl px-6 py-4">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-4">
          <img class="w-24 h-24 p-2 object-cover rounded-full border-4 border-white shadow-md" src="img/aloja-removebg-preview.png" alt="Logo">
          <h1 class="text-4xl font-extrabold tracking-wide text-indigo-100 drop-shadow-md">Bienvenido a Aloja </h1>
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
          <a href="sesion.php" class="ml-2 bg-gradient-to-r from-zinc-950 via-indigo-950 to-blue-950 hover:from-blue-950 hover:via-indigo-950 hover:to-zinc-950 text-white px-5 py-2 rounded-xl font-semibold shadow-lg transition"> Iniciar sesión</a>
        </div>
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
  </body>
</html>

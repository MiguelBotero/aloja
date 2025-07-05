

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido a Aloja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      #carouselTrack::-webkit-scrollbar {
        display: none;
      }
      #carouselTrack {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
    </style>
    <script>
      function moveCarousel(direction) {
        const track = document.getElementById('carouselTrack');
        const width = track.querySelector('img').offsetWidth + 16;
        track.scrollBy({ left: direction * width, behavior: 'smooth' });
      }
    </script>
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

    <main class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-10">
      <section class="md:col-span-2 bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl text-gray-900 hover:scale-105 transition-transform border border-indigo-500">
        <?php include 'config/conexion.php'; ?>

        <!-- FOTOS DEL HOTEL -->
        <h2 class="text-2xl font-bold text-indigo-900 mb-4">Fotos del Hotel</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
          <?php
          $query_hotel = "SELECT * FROM fotos WHERE categoria='hotel' ORDER BY id DESC";
          $result_hotel = mysqli_query($conexion, $query_hotel);
          while ($row = mysqli_fetch_assoc($result_hotel)) {
            echo '<img src="img/uploads/' . htmlspecialchars($row['ruta']) . '" class="rounded-2xl object-cover w-full h-60 shadow-lg hover:shadow-indigo-500 transition duration-300" alt="Foto hotel">';
          }
          ?>
        </div>

        <!-- HABITACIONES -->
        <h2 class="text-2xl font-bold text-indigo-900 mb-4">Habitaciones</h2>
        <div class="relative group mb-6">
          <button onclick="moveCarousel(-1)" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 p-3 bg-indigo-300 hover:bg-indigo-400 text-indigo-950 rounded-full shadow-xl opacity-0 group-hover:opacity-100 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6z"/></svg>
          </button>
          <button onclick="moveCarousel(1)" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 p-3 bg-indigo-300 hover:bg-indigo-400 text-indigo-950 rounded-full shadow-xl opacity-0 group-hover:opacity-100 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
          </button>
          <div id="carouselTrack" class="flex gap-4 overflow-x-auto scroll-smooth pb-2">
            <?php
            $query_habitaciones = "SELECT * FROM fotos WHERE categoria='habitacion' ORDER BY id DESC";
            $result_habitaciones = mysqli_query($conexion, $query_habitaciones);
            while ($row = mysqli_fetch_assoc($result_habitaciones)) {
              echo '<img src="img/uploads/' . htmlspecialchars($row['ruta']) . '" class="min-w-[340px] w-[340px] h-[220px] object-cover rounded-xl shadow-lg hover:shadow-indigo-500 transition duration-300">';
            }
            ?>
          </div>
        </div>
      </section>

      <!-- ZONAS COMUNES -->
      <aside class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-8 rounded-3xl shadow-2xl text-gray-800 hover:scale-105 transition-transform border border-indigo-500 flex flex-col gap-6">
        <h2 class="text-2xl font-bold text-indigo-900 mb-4">Zonas Comunes</h2>
        <div class="space-y-6">
          <?php
          $query_zonas = "SELECT * FROM fotos WHERE categoria='zona' ORDER BY id DESC";
          $result_zonas = mysqli_query($conexion, $query_zonas);
          while ($row = mysqli_fetch_assoc($result_zonas)) {
            echo '<div>';
            echo '<img src="img/uploads/' . htmlspecialchars($row['ruta']) . '" class="w-full h-56 object-cover rounded-xl shadow-lg hover:shadow-indigo-500 transition duration-300" alt="Zona">';
            echo '<p class="mt-3 text-sm text-indigo-900 leading-relaxed">Zona común disponible para nuestros huéspedes.</p>';
            echo '</div>';
          }
          ?>
        </div>
      </aside>
    </main>

    <footer class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-center text-indigo-200 py-6 mt-12 shadow-inner">
    <p class="text-sm">&copy; <?php echo date('Y'); ?> Aloja. Todos los derechos reservados.</p>
    </footer>
  </body>
</html>

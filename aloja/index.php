<?php
// Conectar a la base de datos
include('config/conexion.php');

// Consulta para obtener las habitaciones
$where = [];

if (!empty($_GET['busqueda'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_GET['busqueda']);
    $where[] = "nombre LIKE '%$busqueda%'";
}

if (isset($_GET['disponibilidad']) && $_GET['disponibilidad'] !== '') {
    $disponibilidad = intval($_GET['disponibilidad']);
    $where[] = "disponibilidad = $disponibilidad";
}

$where_sql = '';
if (!empty($where)) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

$query = "SELECT * FROM habitacion $where_sql";

$result = mysqli_query($conexion, $query);
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

    <section class="pt-28 pb-10 text-center bg-gray-200">
      <h2 class="text-5xl font-extrabold mb-3 bg-gradient-to-r from-zinc-950 via-indigo-950 to-blue-950 text-transparent bg-clip-text">Reserva tu habitación ideal</h2>
      <p class="text-gray-600 max-w-3xl mx-auto">En Aloja te ofrecemos mucho más que una habitación. Disfruta de espacios cuidadosamente diseñados que combinan confort, estilo moderno y total privacidad. Ideal para descansar, trabajar o compartir momentos especiales. Tu experiencia de hospedaje comienza aquí.</p>
    </section>

    <!-- Contenido Principal -->
    <main class="p-8 text-black bg-gray-200 min-h-screen">
      <!-- Filtro -->
      <form method="GET" class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center gap-4">
          <input type="text" name="busqueda" placeholder="🔎 Buscar por nombre..." value="<?php echo isset($_GET['busqueda']) ? $_GET['busqueda'] : ''; ?>" class="flex-grow p-3 rounded-lg bg-white border border-gray-400 placeholder-gray-500 min-w-[250px]">
          <select name="disponibilidad" class="w-48 p-3 rounded-lg bg-white border border-gray-400 text-black">
            <option value="">🏘️ Todas las habitaciones</option>
            <option value="1" <?php if(isset($_GET['disponibilidad']) && $_GET['disponibilidad'] === "1") echo "selected"; ?>>✅ Solo disponibles</option>
            <option value="0" <?php if(isset($_GET['disponibilidad']) && $_GET['disponibilidad'] === "0") echo "selected"; ?>>❌ Solo no disponibles</option>
          </select>
          <button type="submit" class="w-fit bg-gradient-to-r from-zinc-950 via-indigo-950 to-blue-950 hover:from-blue-950 hover:via-indigo-950 hover:to-zinc-950 text-white px-4 py-2 rounded-xl font-semibold shadow-lg transition">🔍 Filtrar</button>
        </div>
      </form>

      <!-- Habitaciones -->
      <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <div class="bg-white border border-gray-300 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition">
            <img src="img/<?php echo $row['imagen'] ?? 'default.jpg'; ?>" alt="Imagen habitación" class="w-full h-40 object-cover">
            <div class="p-4">
              <h2 class="text-2xl font-bold mb-2 text-gray-900">🛏️ <?php echo $row['nombre']; ?></h2>
              <p class="text-sm mb-4 text-gray-700">💲 Precio: $<?php echo number_format($row['precio'], 2); ?></p>
              <button onclick="openModal('<?php echo $row['id_habitacion']; ?>')" class="ml-2 bg-gradient-to-r from-zinc-950 via-indigo-950 to-blue-950 hover:from-blue-950 hover:via-indigo-950 hover:to-zinc-950 text-white px-5 py-2 rounded-xl font-semibold shadow-lg transition">👁️ Ver más</button>
            </div>
          </div>

          <!-- Modal personalizado mejorado -->
          <div id="modal<?php echo $row['id_habitacion']; ?>" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
            <div class="relative bg-gradient-to-br from-white via-indigo-100 to-blue-100 rounded-3xl shadow-2xl p-8 w-[95%] md:w-[650px] max-h-[90vh] overflow-y-auto animate-fade-in">
              <button onclick="closeModal('<?php echo $row['id_habitacion']; ?>')" class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-3xl font-bold leading-none">&times;</button>
              <img src="img/<?php echo $row['imagen'] ?? 'default.jpg'; ?>" alt="Imagen habitación" class="w-full h-60 object-cover rounded-xl shadow-md mb-6">
              <h2 class="text-4xl font-extrabold text-indigo-900 mb-4 text-center">🛏️ <?php echo $row['nombre']; ?></h2>
              <p class="text-lg text-gray-800 mb-4"><span class="font-semibold">💵 Precio:</span> $<?php echo number_format($row['precio'], 2); ?></p>
              <p class="text-lg text-gray-700 mb-6"><span class="font-semibold">🧾 Dotación:</span> <?php echo $row['dotacion'] ?? 'No especificada'; ?></p>

              <div class="mb-6">
                <h5 class="text-lg font-semibold text-indigo-900 mb-2">📞 Encargado</h5>
                <p class="text-gray-700 text-base"><strong>Teléfono:</strong> <?php echo $row['telefono_encargado'] ?? 'No disponible'; ?></p>
              </div>

              <div class="text-center">
                <button disabled class="px-6 py-2 rounded-full font-semibold text-sm shadow-md transition cursor-default
                  <?php echo ($row['disponibilidad'] == 1) 
                    ? 'bg-green-200 text-green-800 hover:bg-green-300' 
                    : 'bg-red-200 text-red-800 hover:bg-red-300'; ?>">
                  <?php echo ($row['disponibilidad'] == 1) ? '✅ Disponible' : '❌ No disponible'; ?>
                </button>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </main>

    <script>
      function openModal(id) {
        document.getElementById('modal' + id).classList.remove('hidden');
      }

      function closeModal(id) {
        document.getElementById('modal' + id).classList.add('hidden');
      }
    </script>
  </body>
</html>

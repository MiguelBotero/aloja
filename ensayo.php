<?php
include('config/conexion.php');

$where = [];

if (!empty($_GET['busqueda'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_GET['busqueda']);
    $where[] = "nombre LIKE '%$busqueda%'";
}

if (isset($_GET['disponibilidad']) && $_GET['disponibilidad'] !== '') {
    $disponibilidad = intval($_GET['disponibilidad']);
    $where[] = "disponibilidad = $disponibilidad";
}

$where_sql = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

$query = "SELECT * FROM habitacion $where_sql";
$result = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aloja - Hotel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f2f2f2] text-gray-900 min-h-screen font-sans">

  <!-- Encabezado -->
  <header class="bg-black py-10 text-center text-white shadow">
    <h1 class="text-5xl font-bold">
      <span class="bg-[#ff9900] text-black px-3 py-1 rounded">Aloja</span> Hotel
    </h1>
  </header>

  <div class="flex flex-col lg:flex-row">
    <!-- Navegador lateral -->
    <aside class="bg-black text-white w-full lg:w-64 p-6 space-y-4">
      <a href="#" class="block hover:bg-[#ff9900] hover:text-black p-2 rounded">Inicio</a>
      <a href="galeria.php" class="block hover:bg-[#ff9900] hover:text-black p-2 rounded">Galería</a>
      <a href="ubicacion.php" class="block hover:bg-[#ff9900] hover:text-black p-2 rounded">Ubicación</a>
      <a href="nosotros.php" class="block hover:bg-[#ff9900] hover:text-black p-2 rounded">Nosotros</a>
      <a href="contactos.php" class="block hover:bg-[#ff9900] hover:text-black p-2 rounded">Contacto</a>
      <a href="sesion.php" class="block hover:bg-[#ff9900] hover:text-black p-2 rounded">Iniciar sesión</a>
    </aside>

    <!-- Contenido principal -->
    <main class="flex-1 p-6">

      <!-- Filtro -->
      <form method="GET" class="max-w-5xl mx-auto mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <input type="text" name="busqueda" placeholder="Buscar por nombre..." value="<?php echo $_GET['busqueda'] ?? ''; ?>" class="p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#ff9900]">
          
          <select name="disponibilidad" class="p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#ff9900]">
            <option value="">Todas las habitaciones</option>
            <option value="1" <?php if(isset($_GET['disponibilidad']) && $_GET['disponibilidad'] === "1") echo "selected"; ?>>Solo disponibles</option>
            <option value="0" <?php if(isset($_GET['disponibilidad']) && $_GET['disponibilidad'] === "0") echo "selected"; ?>>Solo no disponibles</option>
          </select>

          <button type="submit" class="bg-[#ff9900] hover:bg-orange-600 text-black font-semibold p-3 rounded shadow">Filtrar</button>
        </div>
      </form>

      <!-- Habitaciones -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="bg-white rounded-lg shadow hover:shadow-xl transition duration-300">
          <img src="img/<?php echo $row['imagen']; ?>" alt="Imagen habitación" class="w-full h-48 object-cover rounded-t-lg">
          <div class="p-4">
            <h2 class="text-2xl font-bold mb-1"><?php echo $row['nombre']; ?></h2>
            <p class="text-[#ff9900] font-semibold text-lg mb-3"><?php echo $row['precio']; ?></p>
            <button class="bg-black hover:bg-[#ff9900] hover:text-black text-white px-4 py-2 rounded" onclick="document.getElementById('modal<?php echo $row['id_habitacion']; ?>').showModal()">Ver más</button>
          </div>
        </div>

        <!-- Modal -->
        <dialog id="modal<?php echo $row['id_habitacion']; ?>" class="w-11/12 md:w-3/4 max-w-5xl rounded-lg shadow-lg backdrop:bg-black/60">
          <div class="bg-white rounded-lg overflow-hidden">
            <div class="flex justify-between items-center bg-black text-white p-4">
              <h3 class="text-xl font-bold">Información de la Habitación</h3>
              <button onclick="document.getElementById('modal<?php echo $row['id_habitacion']; ?>').close()" class="text-2xl">&times;</button>
            </div>

            <div class="p-6 grid md:grid-cols-2 gap-6">
              <img src="img/<?php echo $row['imagen']; ?>" alt="Imagen habitación" class="w-full h-64 object-cover rounded">

              <div>
                <h4 class="text-lg font-bold mb-2">Descripción</h4>
                <p class="mb-4"><?php echo $row['dotacion']; ?></p>

                <div class="mb-4">
                  <h5 class="font-semibold">Encargado</h5>
                  <p><strong>Teléfono:</strong> <?php echo $row['telefono_encargado']; ?></p>
                </div>

                <div class="mb-4">
                  <h5 class="font-semibold">Ubicación</h5>
                  <iframe src="<?php echo $row['mapa']; ?>" width="100%" height="200" class="rounded border border-gray-300" allowfullscreen loading="lazy"></iframe>
                </div>

                <div>
                  <span class="inline-block px-4 py-1 text-sm font-medium rounded-full text-white <?php echo $row['disponibilidad'] ? 'bg-green-600' : 'bg-red-600'; ?>">
                    <?php echo $row['disponibilidad'] ? 'Disponible' : 'No disponible'; ?>
                  </span>
                </div>
              </div>
            </div>

            <div class="text-right p-4">
              <button onclick="document.getElementById('modal<?php echo $row['id_habitacion']; ?>').close()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Cerrar</button>
            </div>
          </div>
        </dialog>
        <?php endwhile; ?>
      </div>
    </main>
  </div>
</body>
</html>

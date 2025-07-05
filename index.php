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

$fecha_ingreso = $_GET['fecha_inicio'] ?? '';
$fecha_salida = $_GET['fecha_fin'] ?? '';

// Si se aplican fechas, sobreescribimos la consulta:
if (!empty($fecha_ingreso) && !empty($fecha_salida)) {
    $query = "
        SELECT * FROM habitacion h
        WHERE h.id_habitacion NOT IN (
            SELECT e.id_habitacion FROM estadia e
            WHERE ('$fecha_ingreso' BETWEEN e.fecha_ingreso AND e.fecha_salida)
               OR ('$fecha_salida' BETWEEN e.fecha_ingreso AND e.fecha_salida)
               OR (e.fecha_ingreso BETWEEN '$fecha_ingreso' AND '$fecha_salida')
               OR (e.fecha_salida BETWEEN '$fecha_ingreso' AND '$fecha_salida')
        )
    ";
    if (!empty($where)) {
        $query .= " AND " . implode(" AND ", $where);
    }
} else {
    $query = "SELECT * FROM habitacion $where_sql";
}

$result = mysqli_query($conexion, $query);

// Consultas para otras secciones
$sql_nosotros = "SELECT * FROM nosotros LIMIT 1";
$resultado_nosotros = mysqli_query($conexion, $sql_nosotros);
$datos_nosotros = mysqli_fetch_assoc($resultado_nosotros);

$sql_contactos = "SELECT * FROM contactos LIMIT 1";
$resultado_contactos = mysqli_query($conexion, $sql_contactos);
$datos_contactos = mysqli_fetch_assoc($resultado_contactos);
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido a Aloja</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
      #carouselTrack::-webkit-scrollbar {
        display: none;
      }
      #carouselTrack {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
      .active-section {
        border-bottom: 2px solid white;
        background-color: rgba(67, 56, 202, 0.7);
      }
      section {
        scroll-margin-top: 120px;
      }
      .card-hover {
        transition: all 0.3s ease;
      }
      .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }
    </style>
    <script>
      function moveCarousel(direction) {
        const track = document.getElementById('carouselTrack');
        const width = track.querySelector('img').offsetWidth + 16;
        track.scrollBy({ left: direction * width, behavior: 'smooth' });
      }

      function openModal(id) {
        document.getElementById('modal' + id).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }

      function closeModal(id) {
        document.getElementById('modal' + id).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }

      // Observador de intersección para actualizar el menú
      document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('nav a[href^="#"]');
        
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              const id = entry.target.getAttribute('id');
              navLinks.forEach(link => {
                link.classList.remove('active-section');
                if (link.getAttribute('href') === '#' + id) {
                  link.classList.add('active-section');
                }
              });
            }
          });
        }, { 
          rootMargin: '-50% 0px -50% 0px',
          threshold: 0
        });

        sections.forEach(section => {
          observer.observe(section);
        });
      });
    </script>
  </head>

  <body class="bg-gray-100 text-gray-800">
    <!-- Encabezado fijo -->
    <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 shadow-2xl px-6 py-4 fixed w-full z-50">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-4">
          <img class="w-24 h-24 p-2 object-cover rounded-full border-4 border-white shadow-md" src="img/aloja-removebg-preview.png" alt="Logo">
          <h1 class="text-4xl font-extrabold tracking-wide text-white drop-shadow-md">Bienvenido a Aloja</h1>
        </div>
        <div class="flex flex-wrap md:flex-nowrap items-center gap-20">
          <nav class="flex flex-wrap gap-4 text-sm md:text-base">
            <a href="#inicio" class="px-4 py-2 rounded transition hover:bg-indigo-900 text-white">🏠 Inicio</a>
            <a href="#galeria" class="px-4 py-2 rounded transition hover:bg-indigo-900 text-white">🖼️ Galería</a>
            <a href="#ubicacion" class="px-4 py-2 rounded transition hover:bg-indigo-900 text-white">📍 Ubicación</a>
            <a href="#nosotros" class="px-4 py-2 rounded transition hover:bg-indigo-900 text-white">👥 Nosotros</a>
            <a href="#contacto" class="px-4 py-2 rounded transition hover:bg-indigo-900 text-white">📞 Contacto</a>
          </nav>
          <a href="sesion.php" class="ml-2 bg-gradient-to-r from-indigo-800 to-blue-900 hover:from-indigo-900 hover:to-blue-800 text-white px-5 py-2 rounded-xl font-semibold shadow-lg transition">Iniciar sesión</a>
        </div>
      </div>
    </header>

    <!-- Contenido principal con ancho ampliado -->
    <main class="max-w-screen-2xl mx-auto px-4 xl:px-8 pt-40">

      <!-- Sección Inicio -->
      <section id="inicio" class="pb-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="text-center">
          <h2 class="text-5xl font-extrabold mb-3 text-gray-800">Reserva tu habitación ideal</h2>
          <p class="text-gray-600 max-w-3xl mx-auto">En Aloja te ofrecemos mucho más que una habitación. Disfruta de espacios cuidadosamente diseñados que combinan confort, estilo moderno y total privacidad. Ideal para descansar, trabajar o compartir momentos especiales. Tu experiencia de hospedaje comienza aquí.</p>
        </div>

        <!-- Filtro con sombra mejorada -->
        <div class="p-8 max-w-7xl mx-auto bg-gradient-to-br from-white to-indigo-50 rounded-2xl shadow-xl mb-10 border border-indigo-100 mt-10">
          <form method="GET" class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center gap-4 mb-4">
              <input type="text" name="busqueda" placeholder="🔎 Buscar por nombre..." value="<?php echo isset($_GET['busqueda']) ? $_GET['busqueda'] : ''; ?>" class="flex-grow p-3 rounded-lg bg-white border border-gray-300 placeholder-gray-500 min-w-[200px] max-w-[400px]">
              
              <div class="flex items-center gap-2">
                <span class="text-gray-700 whitespace-nowrap">Check-in:</span>
                <input type="date" name="fecha_inicio" value="<?php echo $_GET['fecha_inicio'] ?? ''; ?>" class="p-3 rounded-lg bg-white border border-gray-300 text-gray-800">
              </div>
              
              <div class="flex items-center gap-2">
                <span class="text-gray-700 whitespace-nowrap">Check-out:</span>
                <input type="date" name="fecha_fin" value="<?php echo $_GET['fecha_fin'] ?? ''; ?>" class="p-3 rounded-lg bg-white border border-gray-300 text-gray-800">
              </div>
              
              <select name="disponibilidad" class="w-48 p-3 rounded-lg bg-white border border-gray-300 text-gray-800">
                <option value="">🏘️ Todas las habitaciones</option>
                <option value="1" <?php if(isset($_GET['disponibilidad']) && $_GET['disponibilidad'] === "1") echo "selected"; ?>>✅ Disponibles</option>
                <option value="0" <?php if(isset($_GET['disponibilidad']) && $_GET['disponibilidad'] === "0") echo "selected"; ?>>❌ No disponibles</option>
              </select>
              
              <button type="submit" class="w-fit bg-gradient-to-r from-indigo-800 to-blue-900 hover:from-indigo-900 hover:to-blue-800 text-white px-4 py-3 rounded-xl font-semibold shadow-lg transition whitespace-nowrap">🔍 Buscar habitaciones</button>
            </div>
          </form>
        </div>

        <!-- Habitaciones con sombras mejoradas -->
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 px-4">
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <?php
            $precio_original = $row['precio'];
            $rebaja = $row['rebaja'] ?? 0;
            $precio_final = ($rebaja > 0) ? $precio_original * (1 - $rebaja / 100) : $precio_original;
            ?>
            <div class="bg-white border border-indigo-100 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 card-hover bg-gradient-to-br from-white to-indigo-50">
              <?php if ($rebaja > 0): ?>
                <div class="absolute top-0 left-0 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-br-2xl z-10 shadow-md animate-pulse">
                  -<?= $rebaja ?>%
                </div>
              <?php endif; ?>
              <img src="img/<?php echo $row['imagen'] ?? 'default.jpg'; ?>" alt="Imagen habitación" class="w-full h-40 object-cover">
              <div class="p-4">
                <h2 class="text-2xl font-bold mb-2 text-gray-800">🛏️ <?php echo $row['nombre']; ?></h2>
                <p class="text-sm mb-4 text-gray-600">
                💲 Precio:
                <?php if ($rebaja > 0): ?>
                  <span class="line-through text-red-500 mr-2">$<?php echo number_format($precio_original, 0, ',', '.'); ?></span>
                  <span class="text-green-700 font-bold">$<?php echo number_format($precio_final, 0, ',', '.'); ?></span>
                <?php else: ?>
                  <span>$<?php echo number_format($precio_original, 0, ',', '.'); ?></span>
                <?php endif; ?>
              </p>
                <button onclick="openModal('<?php echo $row['id_habitacion']; ?>')" class="ml-2 bg-gradient-to-r from-indigo-800 to-blue-900 hover:from-indigo-900 hover:to-blue-800 text-white px-5 py-2 rounded-xl font-semibold shadow-lg transition">👁️ Ver más</button>
              </div>
            </div>

            <!-- Modal personalizado mejorado -->
            <div id="modal<?php echo $row['id_habitacion']; ?>" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
              <div class="relative bg-gradient-to-br from-white to-indigo-50 rounded-2xl shadow-2xl p-8 w-[95%] md:w-[650px] max-h-[90vh] overflow-y-auto">
                <button onclick="closeModal('<?php echo $row['id_habitacion']; ?>')" class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-3xl font-bold leading-none">&times;</button>
                <img src="img/<?php echo $row['imagen'] ?? 'default.jpg'; ?>" alt="Imagen habitación" class="w-full h-60 object-cover rounded-xl shadow-md mb-6">
                <?php if ($rebaja > 0): ?>
                  <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-xl shadow animate-pulse">
                  -<?= $rebaja ?>%
                  </div>
                <?php endif; ?>
                <h2 class="text-4xl font-extrabold text-gray-800 mb-4 text-center">🛏️ <?php echo $row['nombre']; ?></h2>
                <p class="text-lg text-gray-700 mb-4">
                <span class="font-semibold">💵 Precio:</span>
                <?php if ($rebaja > 0): ?>
                  <span class="line-through text-red-500 mr-2">$<?php echo number_format($precio_original, 0, ',', '.'); ?></span>
                  <span class="text-green-700 font-bold">$<?php echo number_format($precio_final, 0, ',', '.'); ?></span>
                <?php else: ?>
                  $<?php echo number_format($precio_original, 0, ',', '.'); ?>
                <?php endif; ?>
                </p>
                
                <p class="text-lg text-gray-700 mb-6"><span class="font-semibold">🧾 Dotación:</span> <?php echo $row['dotacion'] ?? 'No especificada'; ?></p>

                <div class="mb-6">
                  <h5 class="text-lg font-semibold text-gray-800 mb-2">📞 Encargado</h5>
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
      </section>

      <!-- Sección Galería con sombras mejoradas -->
      <section id="galeria" class="py-20 bg-gradient-to-b from-white to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-10">
          <div class="md:col-span-2 bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition">
            <h2 class="text-4xl font-bold text-gray-800 mb-6 text-center">🖼️ Galería de Imágenes</h2>
            
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Fotos del Hotel</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
              <?php
              $query_hotel = "SELECT * FROM fotos WHERE categoria='hotel' ORDER BY id DESC";
              $result_hotel = mysqli_query($conexion, $query_hotel);
              while ($row = mysqli_fetch_assoc($result_hotel)) {
                echo '<img src="img/uploads/' . htmlspecialchars($row['ruta']) . '" class="rounded-2xl object-cover w-full h-60 shadow-md hover:shadow-lg transition duration-300" alt="Foto hotel">';
              }
              ?>
            </div>

            <h3 class="text-2xl font-bold text-gray-800 mb-4">Habitaciones</h3>
            <div class="relative group mb-6">
              <button onclick="moveCarousel(-1)" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 p-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6z"/></svg>
              </button>
              <button onclick="moveCarousel(1)" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 p-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
              </button>
              <div id="carouselTrack" class="flex gap-4 overflow-x-auto scroll-smooth pb-2">
                <?php
                $query_habitaciones = "SELECT * FROM fotos WHERE categoria='habitacion' ORDER BY id DESC";
                $result_habitaciones = mysqli_query($conexion, $query_habitaciones);
                while ($row = mysqli_fetch_assoc($result_habitaciones)) {
                  echo '<img src="img/uploads/' . htmlspecialchars($row['ruta']) . '" class="min-w-[340px] w-[340px] h-[220px] object-cover rounded-xl shadow-md hover:shadow-lg transition duration-300">';
                }
                ?>
              </div>
            </div>
          </div>

          <!-- ZONAS COMUNES con sombra mejorada -->
          <div class="bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition flex flex-col gap-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Zonas Comunes</h2>
            <div class="space-y-6">
              <?php
              $query_zonas = "SELECT * FROM fotos WHERE categoria='zona' ORDER BY id DESC";
              $result_zonas = mysqli_query($conexion, $query_zonas);
              while ($row = mysqli_fetch_assoc($result_zonas)) {
                echo '<div>';
                echo '<img src="img/uploads/' . htmlspecialchars($row['ruta']) . '" class="w-full h-56 object-cover rounded-xl shadow-md hover:shadow-lg transition duration-300" alt="Zona">';
                echo '<p class="mt-3 text-sm text-gray-700 leading-relaxed">Zona común disponible para nuestros huéspedes.</p>';
                echo '</div>';
              }
              ?>
            </div>
          </div>
        </div>
      </section>

      <!-- Sección Ubicación con sombras mejoradas -->
      <section id="ubicacion" class="py-20 bg-gradient-to-b from-indigo-50 to-gray-50">
        <div class="max-w-screen-2xl mx-auto px-6 py-20 space-y-20">
          <h2 class="text-5xl font-extrabold text-center text-gray-800 mb-16">📍 Nuestra Ubicación</h2>
          
          <div class="grid md:grid-cols-2 gap-16">
            <div class="bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition">
              <h3 class="text-3xl font-bold mb-6 text-gray-800 text-center">Ubicación del Hotel</h3>
              <div class="w-full h-[450px] rounded-xl overflow-hidden shadow-md">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3811.176182717322!2d-75.56854100031241!3d6.250283055282282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428f8c95aa461%3A0xf5680e5fb8a4b8e8!2sParque%20Berr%C3%ADo!5e1!3m2!1ses!2sco!4v1745466284358!5m2!1ses!2sco" 
                  width="100%" 
                  height="100%" 
                  style="border:0;" 
                  allowfullscreen="" 
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
              <p class="mt-6 text-gray-700 leading-relaxed">Nos encontramos ubicados en el corazón de Medellín, a pocos pasos de los principales puntos turísticos, estaciones del metro y zonas comerciales.</p>
              <ul class="mt-4 text-gray-700 space-y-1">
                <li>🚌 Transporte público cercano</li>
                <li>🏪 Supermercados y restaurantes a menos de 500m</li>
                <li>🏞️ Parques y espacios verdes a 3 cuadras</li>
                <li>🚶‍♂️ Acceso peatonal y ciclovía frente al hotel</li>
              </ul>
            </div>

            <div class="bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition">
              <h3 class="text-3xl font-bold mb-6 text-gray-800 text-center">Nuestra Fachada</h3>
              <img src="img/foto-hotel.jpg" alt="Foto del Hotel" class="rounded-xl w-full h-[450px] object-cover shadow-md">
              <p class="mt-6 text-gray-700 leading-relaxed">Nuestro hotel cuenta con una arquitectura moderna y elegante, diseñada para brindar una experiencia única desde el primer momento. ¡Te esperamos con los brazos abiertos!</p>
              <div class="mt-6 p-5 rounded-xl bg-indigo-50 shadow-inner border border-indigo-100">
                <h3 class="text-gray-800 font-semibold mb-2 text-lg">🕒 Horarios de atención:</h3>
                <ul class="text-base text-gray-700 space-y-1">
                  <li>Check-in: 3:00 PM</li>
                  <li>Check-out: 11:00 AM</li>
                  <li>Recepción: 24 horas</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Sección Nosotros con sombras mejoradas -->
      <section id="nosotros" class="py-20 bg-gradient-to-b from-gray-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 py-16">
          <h2 class="text-5xl font-extrabold text-center text-gray-800 mb-16">👥 Sobre Nosotros</h2>
          
          <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition">
              <h3 class="text-2xl font-bold text-gray-800 mb-4">🏛️ Nuestra Historia</h3>
              <p class="leading-relaxed text-justify"><?php echo $datos_nosotros['historia']; ?></p>
            </div>
            <div class="bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition">
              <h3 class="text-2xl font-bold text-gray-800 mb-4">🤝 Atención Personalizada</h3>
              <p class="leading-relaxed text-justify"><?php echo $datos_nosotros['atencion_personalizada']; ?></p>
            </div>
            <div class="bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition">
              <h3 class="text-2xl font-bold text-gray-800 mb-4">💡 Filosofía de Servicio</h3>
              <p class="leading-relaxed text-justify"><?php echo $datos_nosotros['filosofia_servicio']; ?></p>
            </div>
          </div>

          <div class="mt-16 grid md:grid-cols-2 gap-10">
            <div class="bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition">
              <h3 class="text-2xl font-bold text-gray-800 mb-4">📸 Nuestra Imagen</h3>
              <img src="img/foto-hotel.jpg" alt="Hotel" class="w-full h-[350px] object-cover rounded-xl shadow-md">
            </div>
            <div class="bg-gradient-to-br from-white to-indigo-50 p-8 rounded-2xl shadow-xl border border-indigo-100 hover:shadow-2xl transition">
              <h3 class="text-2xl font-bold text-gray-800 mb-4">🌟 Nuestros Valores</h3>
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
        </div>
      </section>

      <!-- Sección Contacto con nuevos diseños -->
      <section id="contacto" class="py-20 bg-gradient-to-b from-indigo-100 to-indigo-200">
        <div class="max-w-screen-2xl mx-auto px-8 py-24">
          <h2 class="text-6xl font-extrabold text-center text-indigo-900 mb-24 drop-shadow-md">Contáctanos</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

            <div class="bg-gradient-to-br from-indigo-300 via-indigo-100 to-white p-12 rounded-3xl shadow-2xl text-gray-900 hover:scale-[1.02] transition-transform border border-indigo-300 shadow-blue-800/50">
              <h3 class="text-5xl font-bold mb-8 bg-gradient-to-r from-sky-400 to-cyan-600 text-transparent bg-clip-text">📞 Teléfonos</h3>
              <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Recepción:</span> <?= $datos_contactos['recepcion'] ?></p>
              <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Reservas:</span> <?= $datos_contactos['telefono'] ?></p>
              <p class="text-xl"><span class="font-semibold text-indigo-900">Eventos:</span> <?= $datos_contactos['eventos'] ?></p>
            </div>

            <div class="bg-gradient-to-br from-indigo-300 via-indigo-100 to-white p-12 rounded-3xl shadow-2xl text-gray-900 hover:scale-[1.02] transition-transform border border-indigo-300 shadow-blue-800/50">
              <h3 class="text-5xl font-bold mb-8 bg-gradient-to-r from-purple-500 to-violet-700 text-transparent bg-clip-text">🌐 Redes Sociales</h3>
              <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Instagram:</span> <?= $datos_contactos['instagram'] ?></p>
              <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Facebook:</span> <?= $datos_contactos['facebook'] ?></p>
              <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Twitter / X:</span> <?= $datos_contactos['twitter'] ?></p>
              <p class="text-xl"><span class="font-semibold text-indigo-900">TikTok:</span> <?= $datos_contactos['tiktok'] ?></p>
            </div>

            <div class="bg-gradient-to-br from-indigo-300 via-indigo-100 to-white p-12 rounded-3xl shadow-2xl text-gray-900 hover:scale-[1.02] transition-transform border border-indigo-300 shadow-blue-800/50">
              <h3 class="text-5xl font-bold mb-8 bg-gradient-to-r from-rose-500 to-fuchsia-600 text-transparent bg-clip-text">✉️ Correos</h3>
              <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">General:</span> <?= $datos_contactos['email'] ?></p>
              <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Reservas:</span> <?= $datos_contactos['reservas_email'] ?></p>
              <p class="text-xl"><span class="font-semibold text-indigo-900">Recursos Humanos:</span> <?= $datos_contactos['recursos_email'] ?></p>
            </div>

            <div class="bg-gradient-to-br from-indigo-300 via-indigo-100 to-white p-12 rounded-3xl shadow-2xl text-gray-900 hover:scale-[1.02] transition-transform border border-indigo-300 shadow-blue-800/50">
              <h3 class="text-5xl font-bold mb-8 bg-gradient-to-r from-lime-400 to-emerald-600 text-transparent bg-clip-text">💬 WhatsApp</h3>
              <p class="text-xl"><span class="font-semibold text-indigo-900">Atención al Cliente:</span> <?= $datos_contactos['whatsapp'] ?></p>
            </div>

          </div>


        </div>
        </div>
      </section>
    </main>

    <footer class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-center text-white py-6 shadow-2xl">
      <p class="text-sm">&copy; <?php echo date('Y'); ?> Aloja. Todos los derechos reservados.</p>
    </footer>
  </body>
</html>

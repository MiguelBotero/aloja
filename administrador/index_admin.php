<?php
// Conectar a la base de datos
include('../config/conexion.php');


// Consulta para obtener las habitaciones
$query = "SELECT * FROM habitacion"; 
$result = mysqli_query($conexion, $query);

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../sesion_.php");
    exit();
}
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Admin - Aloja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      .alert-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
      }
      .alert-box {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        text-align: center;
        animation: bounceIn 0.5s ease;
      }
      @keyframes bounceIn {
        0% { transform: scale(0.8); opacity: 0; }
        60% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); }
      }
    </style>
  </head>
  <body class="bg-gray-200 text-gray-800 min-h-screen">
  <div class="flex flex-col min-h-screen">

  
  <!-- Navegador -->
    <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
      <div class="flex justify-between items-center">
        <div class="flex items-center gap-4">
          <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
          <div>
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
    





    <!-- Contenido principal -->
    <main class="p-8 flex-grow">
      <h2 class="text-4xl font-bold text-center bg-gradient-to-r from-zinc-800 via-indigo-900 to-blue-900 bg-clip-text text-transparent mb-10">Listado de Habitaciones</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Bucle para mostrar las habitaciones -->
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <?php
            $precio_original = $row['precio'];
            $rebaja = $row['rebaja'] ?? 0;
            $precio_final = ($rebaja > 0) ? $precio_original * (1 - $rebaja / 100) : $precio_original;
          ?>
          <div class=" relative bg-white rounded-2xl shadow-xl overflow-hidden">
            <?php if ($rebaja > 0): ?>
              <div class="absolute top-0 left-0 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-br-2xl z-10 shadow-md animate-pulse">
                -<?= $rebaja ?>%
              </div>
            <?php endif; ?>
            <img src="../img/<?php echo $row['imagen']; ?>" class="w-full h-48 object-cover" alt="Habitación">
            <div class="p-4">
              <h3 class="text-xl font-bold text-indigo-800">🛏️ <?php echo $row['nombre']; ?></h3>
              <p class="text-sm mb-4 text-gray-600">
                💲 Precio:
                <?php if ($rebaja > 0): ?>
                  <span class="line-through text-red-500 mr-2">$<?php echo number_format($precio_original, 0, ',', '.'); ?></span>
                  <span class="text-green-700 font-bold">$<?php echo number_format($precio_final, 0, ',', '.'); ?></span>
                <?php else: ?>
                  <span>$<?php echo number_format($precio_original, 0, ',', '.'); ?></span>
                <?php endif; ?>
              </p>

              <p class="text-sm mt-2">📞 Encargado: <?php echo $row['telefono_encargado']; ?></p>

              <div class="flex justify-between mt-4">
                <a href="editar_habitacion.php?id=<?php echo $row['id_habitacion']; ?>" class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-1 rounded-full text-sm font-semibold shadow-md transition-transform hover:scale-105">✏️ Editar</a>
                <button onclick="confirmarEliminacion(<?php echo $row['id_habitacion']; ?>)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-sm font-semibold shadow-md transition-transform hover:scale-105">🗑️ Eliminar</button>
              </div>
              <button onclick="toggleModal('<?php echo $row['id_habitacion']; ?>')" class="mt-4 w-full bg-gradient-to-r from-zinc-950 via-indigo-950 to-blue-950 hover:from-blue-950 hover:via-indigo-950 hover:to-zinc-950 text-white py-2 rounded-xl font-semibold shadow-md">👁️ Ver más</button>
            </div>
          </div>
<!
          <?php
            $idHabitacion = $row['id_habitacion'];
            $consultaOcupante = "SELECT 
                hu.nombre_completo AS huesped,
                ha.nombre AS habitacion,
                es.fecha_inicio AS inicio,
                es.fecha_fin AS fin
            FROM 
                huesped_has_estado hhe
            JOIN 
                huesped hu ON hhe.id_huesped = hu.id_huesped
            JOIN 
                estadia es ON hhe.id_estadia = es.id_estadia
            JOIN 
                habitacion ha ON es.id_habitacion = ha.id_habitacion
            WHERE 
              ha.id_habitacion = $idHabitacion
          ORDER BY es.fecha_fin DESC
          LIMIT 1";

            $ocupanteResultado = mysqli_query($conexion, $consultaOcupante);
            $ocupante = mysqli_fetch_assoc($ocupanteResultado);
          ?>

<!-- Modal para mostrar la información de la habitación -->
          <div id="modal<?php echo $row['id_habitacion']; ?>" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
            <div class="relative bg-gradient-to-br from-white via-indigo-100 to-blue-100 rounded-3xl shadow-2xl p-8 w-[95%] md:w-[650px] max-h-[90vh] overflow-y-auto animate__animated animate__fadeIn">
              <button onclick="toggleModal('<?php echo $row['id_habitacion']; ?>')" class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-3xl font-bold leading-none">&times;</button>
              <img src="../img/<?php echo $row['imagen'] ?? 'default.jpg'; ?>" alt="Imagen habitación" class="w-full h-60 object-cover rounded-xl shadow-md mb-6">

              <?php if ($rebaja > 0): ?>
                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-xl shadow animate-pulse">
                  -<?= $rebaja ?>%
                </div>
              <?php endif; ?>
              <h2 class="text-4xl font-extrabold text-indigo-900 mb-4 text-center">🛏️ <?php echo $row['nombre']; ?></h2>
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
                <h5 class="text-lg font-semibold text-indigo-900 mb-2">📞 Encargado</h5>
                <p class="text-gray-700 text-base"><strong>Teléfono:</strong> <?php echo $row['telefono_encargado'] ?? 'No disponible'; ?></p>
              </div>
              <div class="text-center">
                <button disabled class="px-6 py-2 rounded-full font-semibold text-sm shadow-md transition cursor-default <?php echo ($row['disponibilidad'] == 1) ? 'bg-green-200 text-green-800 hover:bg-green-300' : 'bg-red-200 text-red-800 hover:bg-red-300'; ?>">
                  <?php echo ($row['disponibilidad'] == 1) ? '✅ Disponible' : '❌ No disponible'; ?>
                </button>
               
                <?php if ($row['disponibilidad'] != 1 && $ocupante): ?>
                  <div class="mt-4 p-4 bg-yellow-100 text-yellow-800 rounded-xl shadow text-center">
                    🧑 <strong>Ocupado por:</strong> <?= $ocupante['huesped'] ?><br>
                    🕒 <strong>Desde:</strong> <?= $ocupante['inicio'] ?><br>
                    🕒 <strong>Hasta:</strong> <?= $ocupante['fin'] ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </main>





    <footer class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-center text-indigo-200 py-6 shadow-inner">
      <p class="text-sm">&copy; <?php echo date('Y'); ?> Aloja - Panel de Administración.</p>
    </footer>

    <div id="customAlert" class="alert-overlay hidden">
      <div class="alert-box">
        <h3 class="text-lg font-bold mb-4">¿Estás seguro de eliminar esta habitación?</h3>
        <div class="flex justify-center gap-4">
          <button onclick="ejecutarEliminacion()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Sí, eliminar</button>
          <button onclick="cerrarAlerta()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

    

    <script>
      let habitacionAEliminar = null;

      function toggleModal(id) {
        const modal = document.getElementById('modal' + id);
        modal.classList.toggle('hidden');
      }

      function confirmarEliminacion(id) {
        habitacionAEliminar = id;
        document.getElementById('customAlert').classList.remove('hidden');
      }

      function cerrarAlerta() {
        habitacionAEliminar = null;
        document.getElementById('customAlert').classList.add('hidden');
      }

      function ejecutarEliminacion() {
        if (habitacionAEliminar) {
          window.location.href = `../php/eliminar_habitacion.php?id=${habitacionAEliminar}`;
        }
      }

     
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
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>

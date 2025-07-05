<?php
session_start();

$conn = new mysqli("localhost", "root", "", "aloja");

$alerta = ""; // variable que contendrá el script de SweetAlert

// Validar sesión
if (!isset($_SESSION['admin'])) {
    $alerta = "
    <script>
    window.onload = function() {
        Swal.fire({
            icon: 'warning',
            title: 'Sesión no iniciada',
            text: 'Por favor inicia sesión como administrador.',
            confirmButtonColor: '#F59E0B'
        }).then(() => {
            window.location.href = '../login_admin.php';
        });
    }
    </script>";
}

// Procesar POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $historia = $_POST['historia'];
    $atencion_personalizada = $_POST['atencion_personalizada'];
    $filosofia_servicio = $_POST['filosofia_servicio'];

    if (empty($historia) || empty($atencion_personalizada) || empty($filosofia_servicio)) {
        $alerta = "
        <script>
        window.onload = function() {
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Por favor completa todos los campos.',
                confirmButtonColor: '#F59E0B'
            });
        }
        </script>";
    } else {
        // Consulta segura con prepared statements
        $stmt = $conn->prepare("UPDATE nosotros SET historia = ?, atencion_personalizada = ?, filosofia_servicio = ? WHERE id = 1");
        $stmt->bind_param("sss", $historia, $atencion_personalizada, $filosofia_servicio);

        if ($stmt->execute()) {
            $alerta = "
            <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'La información se actualizó correctamente.',
                    confirmButtonColor: '#4F46E5'
                }).then(() => {
                    window.location.href = 'nosotros_admin.php';
                });
            }
            </script>";
        } else {
            $alerta = "
            <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar los datos.',
                    confirmButtonColor: '#DC2626'
                });
            }
            </script>";
        }

        $stmt->close();
    }
}

// Obtener datos actuales
$nosotros = $conn->query("SELECT * FROM nosotros LIMIT 1")->fetch_assoc();
?>


<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Nosotros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      function mostrarCancelar() {
        document.getElementById('btn-cancelar').classList.remove('hidden');
      }
      function ocultarCancelar() {
        document.getElementById('btn-cancelar').classList.add('hidden');
        document.querySelectorAll('.edit-input').forEach(input => input.value = input.defaultValue);
      }
    </script>
</head>
<body class="bg-gray-300">
  <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-4">
        <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
        <div>
          <h1 class="text-3xl font-extrabold bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-200 bg-clip-text text-transparent">Panel de Administración</h1>
          <p class="text-sm text-indigo-200">Gestión de nosotros</p>
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

  <main>

  
    <div class="px-6 py-10">
      <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

        <div class="bg-white rounded-xl shadow-2xl p-6 border-t-4 border-indigo-500 hover:scale-[1.02] transition">
          <h3 class="text-indigo-900 text-xl font-bold mb-3">📖 Historia</h3>
          <p class="text-gray-700 text-sm leading-relaxed"><?php echo $nosotros['historia']; ?></p>
        </div>

        <div class="bg-white rounded-xl shadow-2xl p-6 border-t-4 border-blue-500 hover:scale-[1.02] transition">
          <h3 class="text-blue-900 text-xl font-bold mb-3">🤝 Atención Personalizada</h3>
          <p class="text-gray-700 text-sm leading-relaxed"><?php echo $nosotros['atencion_personalizada']; ?></p>
        </div>

        <div class="bg-white rounded-xl shadow-2xl p-6 border-t-4 border-purple-500 hover:scale-[1.02] transition">
          <h3 class="text-purple-900 text-xl font-bold mb-3">✨ Filosofía de Servicio</h3>
          <p class="text-gray-700 text-sm leading-relaxed"><?php echo $nosotros['filosofia_servicio']; ?></p>
        </div>

      </div>
    </div>

    <div class="modal fade" id="modal20" tabindex="-1" aria-labelledby="modal20Label" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-fullscreen-sm-down">

        <div class="modal-content">
          <div class="modal-body">
            <form method="post" class="space-y-6">
              <h3 class="text-center text-3xl font-extrabold bg-gradient-to-r from-gray-900 via-indigo-800 to-blue-700 bg-clip-text text-transparent mb-6 tracking-wide uppercase">🛠️ Editar Información de Nosotros</h3>
              <div class="px-6 space-y-6">
                <div>
                  <label class="block text-gray-700 font-semibold mb-1">Historia:</label>
                  <input type="text" name="historia" class="w-full border border-indigo-200 bg-white shadow-sm rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition edit-input" value="<?= $nosotros['historia'] ?>" oninput="mostrarCancelar()">
                </div>

                <div>
                  <label class="block text-gray-700 font-semibold mb-1">Atención Personalizada:</label>
                  <input type="text" name="atencion_personalizada" class="w-full border border-blue-200 bg-white shadow-sm rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 transition edit-input" value="<?= $nosotros['atencion_personalizada'] ?>" oninput="mostrarCancelar()">
                </div>

                <div>
                  <label class="block text-gray-700 font-semibold mb-1">Filosofía de Servicio:</label>
                  <input type="text" name="filosofia_servicio" class="w-full border border-purple-200 bg-white shadow-sm rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-400 transition edit-input" value="<?= $nosotros['filosofia_servicio'] ?>" oninput="mostrarCancelar()">
                </div>

                <div class="flex justify-center gap-4 pt-4">
                  <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow transition" type="submit">Guardar cambios</button>
                  <button type="button" id="btn-cancelar" onclick="ocultarCancelar()" class="hidden bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded shadow transition">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </main>

  <footer class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-center text-indigo-200 py-6 mt-12 shadow-inner">
    <p class="text-sm">&copy; <?php echo date('Y'); ?> Aloja. Todos los derechos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?= $alerta ?>

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

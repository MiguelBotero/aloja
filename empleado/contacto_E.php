<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$conn = new mysqli("localhost", "root", "", "aloja");
$usuario = $_SESSION['usuario'];
$sql = "SELECT usuario FROM empleado WHERE usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql);
$empleado = mysqli_fetch_assoc($resultado); // <-- aquí sí obtienes el nombre

$alerta = ""; // Variable para mostrar SweetAlert2 en el HTML

if (!isset($_SESSION['usuario'])) {
    $alerta = "
    <script>
    window.onload = function() {
        Swal.fire({
            icon: 'warning',
            title: 'Sesión no iniciada',
            text: 'Por favor inicia sesión como empleado.',
            confirmButtonColor: '#F59E0B',
            confirmButtonText: 'Ir al login'
        }).then(() => {
            window.location.href = '../sesion.php';
        });
    }
    </script>";
}

$stmt = $conn->prepare("SELECT * FROM contactos WHERE id = 1");
$stmt->execute();
$result = $stmt->get_result();
$datos = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $whatsapp = $_POST['whatsapp'];
    $telefono = $_POST['telefono'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $tiktok = $_POST['tiktok'];
    $recepcion = $_POST['recepcion'];
    $eventos = $_POST['eventos'];
    $reservas_email = $_POST['reservas_email'];
    $recursos_email = $_POST['recursos_email'];
    $twitter = $_POST['twitter'];
    $email = $_POST['email'];

    if (empty($whatsapp) || empty($telefono) || empty($email)) {
        $alerta = "
        <script>
        window.onload = function() {
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Completa WhatsApp, Teléfono y Email.',
                confirmButtonColor: '#F59E0B',
                confirmButtonText: 'Volver'
            });
        }
        </script>";
    } else {
        $stmt = $conn->prepare("UPDATE contactos SET whatsapp=?, telefono=?, facebook=?, instagram=?, tiktok=?, recepcion=?, eventos=?, reservas_email=?, recursos_email=?, twitter=?, email=? WHERE id=1");
        $stmt->bind_param("sssssssssss", $whatsapp, $telefono, $facebook, $instagram, $tiktok, $recepcion, $eventos, $reservas_email, $recursos_email, $twitter, $email);
        
        if ($stmt->execute()) {
            $alerta = "
            <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'Los datos de contacto fueron actualizados correctamente',
                    confirmButtonColor: '#4F46E5',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'contactos_E.php';
                });
            }
            </script>";
        } else {
            $alerta = "
            <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al actualizar',
                    text: 'No se pudo guardar los cambios.',
                    confirmButtonColor: '#DC2626',
                    confirmButtonText: 'Cerrar'
                });
            }
            </script>";
        }
    }
}
?>



<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Panel Admin - Contactos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-300">



<header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
  <div class="flex justify-between items-center">
    <div class="flex items-center gap-4">
      <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
      <div>
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-200 bg-clip-text text-transparent">Panel de Administración</h1>
        <p class="text-sm text-indigo-200">Gestión de contactos</p>
      </div>
    </div>
    <?php $pagina = basename($_SERVER['PHP_SELF']); ?>
    <nav class="flex flex-wrap gap-4 text-sm md:text-base">
            <a href="index_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'index_E.php') ? 'border-b-2 border-white' : ''; ?>">🏠 Inicio</a>
            <a href="formulario_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'formulario_E.php') ? 'border-b-2 border-white' : ''; ?>">📝 Registrar</a>
            <a href="ver_tablas_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ver_tablas_E.php') ? 'border-b-2 border-white' : ''; ?>">📋 Ver Datos</a>
            <a href="galeria_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'galeria_E.php') ? 'border-b-2 border-white' : ''; ?>">🖼️ Galería</a>
            <a href="ubicacion_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ubicacion_E.php') ? 'border-b-2 border-white' : ''; ?>">📍 Ubicación</a>
            <a href="nosotros_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'nosotros_E.php') ? 'border-b-2 border-white' : ''; ?>">👥 Nosotros</a>
            <a href="contacto_E.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'contactos_E.php') ? 'border-b-2 border-white' : ''; ?>">📞 Contacto</a>
            <a href="../php/cerrar_sesion_admin.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-white font-bold shadow">Cerrar sesión</a>
            <!-- Perfil del empleado -->
            <div class="flex items-center gap-2 bg-indigo-900 px-3 py-2 rounded-xl shadow-md">
                <img src="../img/perfil.jpg" alt="Perfil" class="w-10 h-10 rounded-full border-2 border-white">
                <span class="text-white font-medium text-sm hidden sm:block"><?php echo $empleado['usuario']; ?></span>
            </div>
        </nav>
  </div>
</header>

<div class="max-w-screen-xl mx-auto px-6 py-8 grid grid-cols-1 lg:grid-cols-[1.3fr_1fr] gap-14 items-start min-h-[70vh]">
  <!-- Formulario -->
  <div class="bg-white rounded-3xl shadow-2xl px-10 py-14 w-full h-full flex flex-col justify-start border-4 border-blue-900">
    <h3 class="text-4xl text-blue-900 font-extrabold mb-10 text-center">Editar Contacto</h3>
    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <input type="tel" name="whatsapp" value="<?= $datos['whatsapp'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-green-400 bg-green-50" placeholder="WhatsApp">
      <input type="tel" name="telefono" value="<?= $datos['telefono'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-indigo-50" placeholder="Teléfono">
      <input type="text" name="facebook" value="<?= $datos['facebook'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-blue-50" placeholder="Facebook">
      <input type="text" name="instagram" value="<?= $datos['instagram'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-pink-50" placeholder="Instagram">
      <input type="text" name="tiktok" value="<?= $datos['tiktok'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-purple-50" placeholder="TikTok">
      <input type="tel" name="recepcion" value="<?= $datos['recepcion'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-indigo-50" placeholder="Recepción">
      <input type="text" name="eventos" value="<?= $datos['eventos'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-orange-50" placeholder="Eventos">
      <input type="text" name="reservas_email" value="<?= $datos['reservas_email'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-yellow-50" placeholder="Email Reservas">
      <input type="text" name="recursos_email" value="<?= $datos['recursos_email'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-teal-50" placeholder="Email Recursos Humanos">
      <input type="text" name="twitter" value="<?= $datos['twitter'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-sky-50" placeholder="Twitter / X">
      <div class="md:col-span-2">
        <input type="text" name="email" value="<?= $datos['email'] ?>" class="w-full p-3 rounded-xl border border-indigo-400 shadow-inner focus:ring-2 focus:ring-indigo-400 bg-gray-50" placeholder="Email General">
      </div>
      <div class="md:col-span-2 flex justify-center mt-4">
        <button type="submit" class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 hover:from-blue-950 hover:via-indigo-950 hover:to-gray-950 px-8 text-white font-bold py-3 rounded-xl shadow transition-all duration-300">Guardar</button>
      </div>
    </form>
  </div>

  <!-- Vista previa -->
  <main class="w-full h-full">
    <h2 class="text-4xl font-extrabold text-blue-900 mb-8 text-center">Contáctanos</h2>
    <div class="grid grid-cols-1 gap-6">
      <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-6 rounded-3xl shadow-xl text-gray-900">
        <h3 class="text-2xl font-bold mb-4">📞 Teléfonos</h3>
        <p><strong>Recepción:</strong> <?= $datos['recepcion'] ?></p>
        <p><strong>Reservas:</strong> <?= $datos['telefono'] ?></p>
        <p><strong>Eventos:</strong> <?= $datos['eventos'] ?></p>
      </div>
      <div class="bg-gradient-to-br from-purple-400 via-gray-300 to-gray-200 p-6 rounded-3xl shadow-xl text-gray-900">
        <h3 class="text-2xl font-bold mb-4">🌐 Redes Sociales</h3>
        <p><strong>Instagram:</strong> <?= $datos['instagram'] ?></p>
        <p><strong>Facebook:</strong> <?= $datos['facebook'] ?></p>
        <p><strong>Twitter / X:</strong> <?= $datos['twitter'] ?></p>
        <p><strong>TikTok:</strong> <?= $datos['tiktok'] ?></p>
      </div>
      <div class="bg-gradient-to-br from-rose-400 via-gray-300 to-gray-200 p-6 rounded-3xl shadow-xl text-gray-900">
        <h3 class="text-2xl font-bold mb-4">✉️ Correos</h3>
        <p><strong>General:</strong> <?= $datos['email'] ?></p>
        <p><strong>Reservas:</strong> <?= $datos['reservas_email'] ?></p>
        <p><strong>Recursos Humanos:</strong> <?= $datos['recursos_email'] ?></p>
      </div>
      <div class="bg-gradient-to-br from-lime-400 via-gray-300 to-gray-200 p-6 rounded-3xl shadow-xl text-gray-900">
        <h3 class="text-2xl font-bold mb-4">💬 WhatsApp</h3>
        <p><strong>Atención al Cliente:</strong> <?= $datos['whatsapp'] ?></p>
      </div>
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $alerta ?>
...
<?= $alerta ?>

<script>
    // Temporizador de inactividad
    const tiempoMaximoInactividad = 300000;                             // 5 min
    const tiempoAviso = 60000;                                          // 1 min antes

      setTimeout(() => {                                                  // 5 min
        alert("Tu sesión está a punto de expirar. Por favor, realiza alguna acción."); // aviso 1 min antes
      }, tiempoMaximoInactividad - tiempoAviso);  // 5 min - 1 min antes

      setTimeout(() => {                                                  // 5 min
        window.location.href = "../php/cerrar_sesion.php";                         // Redirigir al logout
      }, tiempoMaximoInactividad);
      
  </script>
</body>
</html>




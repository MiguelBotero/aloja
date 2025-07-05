<?php
include '../config/conexion.php';
session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['usuario'])) {
    echo "Sesión no iniciada";
    exit();
}

// Obtener datos del empleado que ha iniciado sesión
$usuario = $_SESSION['usuario'];
$sql = "SELECT usuario FROM empleado WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexion, $sql);
$empleado = mysqli_fetch_assoc($resultado); // <-- aquí sí obtienes el nombre

$id = $_GET['id'];
$result = mysqli_query($conexion, "SELECT * FROM tarifa WHERE id_tarifa = $id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tarifa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

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

    <main>
        <div class="container mx-auto p-6 bg-gray-900 text-white max-w-xl rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Editar Tarifa</h2>
            <form action="../php/empleado_CRUD/actualizar_tarifa.php" method="POST" class="space-y-4">
                <input type="hidden" name="id_tarifa" value="<?= $row['id_tarifa'] ?>">

                <div>
                    <label class="block mb-1">Día</label>
                    <input type="number" name="dia" value="<?= $row['dia'] ?>" class="w-full px-4 py-2 text-black rounded" required>
                </div>
                <div>
                    <label class="block mb-1">Semana</label>
                    <input type="text" name="semana" value="<?= $row['semana'] ?>" class="w-full px-4 py-2 text-black rounded" required>
                </div>
                <div>
                    <label class="block mb-1">Quincena</label>
                    <input type="number" name="quincena" value="<?= $row['quincena'] ?>" class="w-full px-4 py-2 text-black rounded" required>
                </div>
                <div>
                    <label class="block mb-1">Mensual</label>
                    <input type="number" name="mensual" value="<?= $row['mensual'] ?>" class="w-full px-4 py-2 text-black rounded" required>
                </div>
                <div>
                    <label class="block mb-1">ID Habitación</label>
                    <input type="number" name="id_habitacion" value="<?= $row['id_habitacion'] ?>" class="w-full px-4 py-2 text-black rounded" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white py-2 px-6 rounded">Actualizar</button>
                </div>
            </form>
        </div>
    </main>

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
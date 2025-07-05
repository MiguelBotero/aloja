<?php 
include "../config/conexion.php";

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
$sql = "SELECT * FROM huesped WHERE id_huesped= $id";
$resultado = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Registro - Aloja</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300">

<header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
  <div class="flex justify-between items-center">
    <div class="flex items-center gap-4">
      <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
      <div class="text-left">
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-200 bg-clip-text text-transparent">Panel de Empleado</h1>
        <p class="text-sm text-indigo-200">formulario</p>
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

<main class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-xl shadow-indigo-900">
  <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Actualizar un registro</h2>
  <form action="../php/empleado_CRUD/actualizar_registro.php" method="post" class="space-y-5">
    <input type="hidden" name="id_huesped" value="<?= $row['id_huesped'] ?>">

    <div>
      <label class="block font-semibold text-gray-800">Nombre completo</label>
      <input type="text" name="nombre_completo" value="<?= $row['nombre_completo'] ?>" class="mt-1 w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
    </div>

    <div>
      <label class="block font-semibold text-gray-800">Tipo documento</label>
      <select name="tipo_documento" class="mt-1 w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
        <option value="">Selecciona una opción</option>
        <option value="cedula" <?= $row['tipo_documento'] === 'cedula' ? 'selected' : '' ?>>Cédula</option>
        <option value="Pasaporte" <?= $row['tipo_documento'] === 'Pasaporte' ? 'selected' : '' ?>>Pasaporte</option>
        <option value="Carnet de extranjería" <?= $row['tipo_documento'] === 'Carnet de extranjería' ? 'selected' : '' ?>>Carnet de extranjería</option>
        <option value="Otro" <?= $row['tipo_documento'] === 'Otro' ? 'selected' : '' ?>>Otro</option>
      </select>
    </div>

    <div>
      <label class="block font-semibold text-gray-800">Número documento</label>
      <input type="number" name="numero_documento" value="<?= $row['numero_documento'] ?>" class="mt-1 w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
    </div>

    <div>
      <label class="block font-semibold text-gray-800">Teléfono huésped</label>
      <input type="number" name="telefono_huesped" value="<?= $row['telefono_huesped'] ?>" class="mt-1 w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
    </div>

    <div>
      <label class="block font-semibold text-gray-800">Origen</label>
      <input type="text" name="origen" value="<?= $row['origen'] ?>" class="mt-1 w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
    </div>

    <div>
      <label class="block font-semibold text-gray-800">Nombre contacto</label>
      <input type="text" name="nombre_contacto" value="<?= $row['nombre_contacto'] ?>" class="mt-1 w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
    </div>

    <div>
      <label class="block font-semibold text-gray-800">Teléfono contacto</label>
      <input type="number" name="telefono_contacto" value="<?= $row['telefono_contacto'] ?>" class="mt-1 w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
    </div>

    <div>
      <label class="block font-semibold text-gray-800">Observaciones</label>
      <textarea name="observaciones" rows="3" class="mt-1 w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"><?= $row['observaciones'] ?></textarea>
    </div>

    <div class="flex justify-between mt-6">
      <a href="ver_tablas_E.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Cancelar</a>
      <button type="submit" class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 hover:opacity-90 text-white font-bold py-2 px-6 rounded-lg shadow-lg">Actualizar</button>
    </div>
  </form>
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

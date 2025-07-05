<?php 
include "../config/conexion.php";
session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
    exit();
}
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
                <a href="../php/cerrar_sesion_admin.php" class="bg-red-600 hover:bg-red-700 px-4 py-1.5 rounded text-white font-bold shadow text-sm">
                Cerrar sesión
                </a>
            </nav>
  </div>
</header>

<main class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-xl shadow-indigo-900">
  <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Actualizar un registro</h2>
  <form action="../php/actualizar_registro.php" method="post" class="space-y-5">
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
      <a href="ver_tablas.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Cancelar</a>
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

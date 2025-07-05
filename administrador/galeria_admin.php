<?php
include '../config/conexion.php';

session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
    exit();
}

// Subida de imagen
if (isset($_POST['subir_foto'])) {
    $categoria = $_POST['categoria'];
    $nombreArchivo = time() . '_' . basename($_FILES['foto']['name']);
    $rutaTemporal = $_FILES['foto']['tmp_name'];
    $rutaDestino = '../img/uploads/' . $nombreArchivo;

    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        $sql = "INSERT INTO fotos (ruta, categoria) VALUES ('$nombreArchivo', '$categoria')";
        mysqli_query($conexion, $sql);
    }
}

// Eliminar imagen
if (isset($_POST['eliminar_foto'])) {
    $id = $_POST['eliminar_foto'];
    $consulta = mysqli_query($conexion, "SELECT ruta FROM fotos WHERE id = $id");
    $fila = mysqli_fetch_assoc($consulta);

    if ($fila) {
        $rutaImagen = '../img/uploads/' . $fila['ruta'];
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }
        mysqli_query($conexion, "DELETE FROM fotos WHERE id = $id");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Aloja - Panel Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
  <div class="flex justify-between items-center">
    <div class="flex items-center gap-4">
      <img src="img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
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

<main class="max-w-6xl mx-auto p-6 mt-8 bg-white rounded-3xl shadow-xl">
  <h2 class="text-2xl font-bold text-indigo-900 mb-6">Editar Información</h2>

  

  <hr class="my-8">

  <h3 class="text-xl font-semibold text-indigo-800 mb-4">Subir nueva foto</h3>
  <form method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
    <input type="file" name="foto" class="p-2 border border-gray-300 rounded-lg w-full sm:w-auto" required>
    <select name="categoria" class="p-2 border border-gray-300 rounded-lg w-full sm:w-auto" required>
      <option value="hotel">Hotel</option>
      <option value="habitacion">Habitación</option>
      <option value="zona">Zona</option>
    </select>
    <button type="submit" name="subir_foto" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 w-full sm:w-auto">Subir</button>
  </form>

  <hr class="my-8">

  <h3 class="text-xl font-semibold text-indigo-800 mb-6">Fotos actuales por sección</h3>

  <?php
  $categorias = ['hotel' => '🏨 Hotel', 'habitacion' => '🛏️ Habitación', 'zona' => '🌳 Zona'];

  foreach ($categorias as $cat => $titulo) {
    echo "<h4 class='text-lg font-bold text-gray-700 mt-8 mb-4'>$titulo</h4>";
    echo "<div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6'>";

    $query = "SELECT * FROM fotos WHERE categoria = '$cat' ORDER BY id DESC";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="relative group border border-gray-200 rounded-xl overflow-hidden shadow hover:shadow-lg transition">';
        echo '<img src="../img/uploads/' . htmlspecialchars($row['ruta']) . '" alt="Foto" class="w-full h-56 object-cover">';
        echo '<form method="POST" class="absolute top-2 right-2">';
        echo '<input type="hidden" name="eliminar_foto" value="' . $row['id'] . '">';
        echo '<button type="submit" class="bg-red-600 text-white text-sm px-3 py-1 rounded shadow hover:bg-red-700">Eliminar</button>';
        echo '</form>';
        echo '<div class="absolute bottom-0 left-0 bg-black/60 text-white text-xs px-2 py-1 rounded-tr-md">' . $row['categoria'] . '</div>';
        echo '</div>';
      }
    } else {
      echo "<p class='col-span-4 text-sm text-gray-500'>No hay imágenes en esta categoría.</p>";
    }

    echo "</div>";
  }
  ?>
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

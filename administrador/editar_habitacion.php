<?php 
include "../config/conexion.php";

session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
    exit();
}

// Asegurar que el ID sea seguro y un número entero
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Usar consulta preparada para evitar inyecciones
$stmt = $conexion->prepare("SELECT * FROM habitacion WHERE id_habitacion = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$habitacion = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Habitación</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300">

<!-- Navegador -->
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
      <a href="../php/cerrar_sesion_admin.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-white font-bold shadow">Cerrar sesión</a>
    </nav>
  </div>
</header>

<!-- Contenido principal -->
<main class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-xl shadow-indigo-900">
  <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Editar Habitación</h2>
  <form action="../php/actualizar_habitacion.php" method="POST" enctype="multipart/form-data" class="space-y-5">
    <input type="hidden" name="id" value="<?php echo $habitacion['id_habitacion']; ?>">
    <input type="hidden" name="imagen_actual" value="<?php echo $habitacion['imagen']; ?>">

    <div class="mb-4">
      <label class="block font-semibold text-gray-800">Imagen actual</label>
      <img id="preview" src="../img/<?php echo file_exists('../img/' . $habitacion['imagen']) ? htmlspecialchars($habitacion['imagen']) : 'default.jpg'; ?>" 
          alt="Imagen habitación" class="rounded-lg shadow w-60 h-40 object-cover mb-2">

      <input type="file" id="imagen" name="imagen" accept="image/*"
            class="w-full px-4 py-2 border border-indigo-200 rounded-md">
    </div>

      <div>
        <label class="block font-semibold text-gray-800">Nombre habitación</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($habitacion['nombre']); ?>" 
              class="w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
      </div>

      <div>
        <label class="block font-semibold text-gray-800">Descripción</label>
        <textarea name="dotacion" rows="4"
                  class="w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required><?php echo htmlspecialchars($habitacion['dotacion']); ?></textarea>
      </div>

      <div>
        <label class="block font-semibold text-gray-800">Teléfono encargado</label>
        <input type="tel" name="telefono_encargado" value="<?php echo htmlspecialchars($habitacion['telefono_encargado']); ?>" 
              class="w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
      </div>

      <div>
        <label class="block font-semibold text-gray-800">Precio</label>
        <input type="number" name="precio" value="<?php echo htmlspecialchars($habitacion['precio']); ?>" 
              class="w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" min="0" required>
      </div>

      <div>
        <label class="block font-semibold text-gray-800">Disponibilidad</label>
        <select name="disponibilidad" 
                class="w-full px-4 py-2 border border-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
          <option value="1" <?php echo ($habitacion['disponibilidad'] == 1) ? 'selected' : ''; ?>>Disponible</option>
          <option value="0" <?php echo ($habitacion['disponibilidad'] == 0) ? 'selected' : ''; ?>>No disponible</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="rebaja" class="block mb-1 font-semibold text-gray-700">Rebaja (%)</label>
        <input type="number" name="rebaja" id="rebaja" value="<?php echo isset($habitacion['rebaja']) ? htmlspecialchars($habitacion['rebaja']) : 0; ?>" 
              min="0" max="100" class="w-full border border-gray-300 rounded-lg px-4 py-2">
      </div>


    <div class="flex justify-between mt-6">
      <a href="index_admin.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Cancelar</a>
      <button type="submit" class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 hover:opacity-90 text-white font-bold py-2 px-6 rounded-lg shadow-lg">Actualizar</button>
    </div>
  </form>
</main>

<script>
  document.getElementById("imagen").addEventListener("change", function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("preview");
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = "../img/<?php echo $habitacion['imagen']; ?>";
    }
  });

  
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

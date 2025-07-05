<?php
include("config/conexion.php");

$sql = "SELECT * FROM contactos LIMIT 1";
$resultado = mysqli_query($conexion, $sql);
$datos = mysqli_fetch_assoc($resultado);
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacto - Aloja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300 text-white min-h-screen">
    <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 shadow-2xl px-6 py-4">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-4">
        <img class="w-24 h-24 p-2 object-cover rounded-full border-4 border-white shadow-md" src="img/aloja-removebg-preview.png" alt="Logo">
        <h1 class="text-4xl font-extrabold tracking-wide text-indigo-100 drop-shadow-md">Bienvenido a Aloja</h1>
        </div>
        <div class="flex flex-wrap md:flex-nowrap items-center gap-20">
        <?php $pagina = basename($_SERVER['PHP_SELF']); ?>
        <nav class="flex flex-wrap gap-4 text-sm md:text-base">
            <a href="index.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'index.php') ? 'border-b-2 border-white' : ''; ?>">🏠 Inicio</a>
            <a href="galeria.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'galeria.php') ? 'border-b-2 border-white' : ''; ?>">🖼️ Galería</a>
            <a href="ubicacion.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'ubicacion.php') ? 'border-b-2 border-white' : ''; ?>">📍 Ubicación</a>
            <a href="nosotros.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'nosotros.php') ? 'border-b-2 border-white' : ''; ?>">👥 Nosotros</a>
            <a href="contactos.php" class="px-4 py-2 rounded transition hover:bg-indigo-700 <?php echo ($pagina === 'contactos.php') ? 'border-b-2 border-white' : ''; ?>">📞 Contacto</a>
        </nav>
        <a href="sesion.php" class="ml-2 bg-gradient-to-r from-zinc-950 via-indigo-950 to-blue-950 hover:from-blue-950 hover:via-indigo-950 hover:to-zinc-950 text-white px-5 py-2 rounded-xl font-semibold shadow-lg transition">Iniciar sesión</a>
        </div>
    </div>
    </header>

    <main class="max-w-screen-2xl mx-auto px-8 py-24">
    <h2 class="text-6xl font-extrabold text-center text-indigo-900 mb-24 drop-shadow-md">Contáctanos</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-12 rounded-3xl shadow-2xl text-gray-900 hover:scale-105 transition-transform border border-indigo-500 hover:scale-[1.02] transition">
        <h3 class="text-5xl font-bold mb-8 bg-gradient-to-r from-sky-400 to-cyan-600 text-transparent bg-clip-text">📞 Teléfonos</h3>
        <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Recepción:</span> <?= $datos['recepcion'] ?></p>
        <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Reservas:</span> <?= $datos['telefono'] ?></p>
        <p class="text-xl"><span class="font-semibold text-indigo-900">Eventos:</span> <?= $datos['eventos'] ?></p>
        </div>

        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-12 rounded-3xl shadow-2xl text-gray-900 hover:scale-105 transition-transform border border-indigo-500 hover:scale-[1.02] transition">
        <h3 class="text-5xl font-bold mb-8 bg-gradient-to-r from-purple-500 to-violet-700 text-transparent bg-clip-text">🌐 Redes Sociales</h3>
        <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Instagram:</span> <?= $datos['instagram'] ?></p>
        <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Facebook:</span> <?= $datos['facebook'] ?></p>
        <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Twitter / X:</span> <?= $datos['twitter'] ?></p>
        <p class="text-xl"><span class="font-semibold text-indigo-900">TikTok:</span> <?= $datos['tiktok'] ?></p>
        </div>

        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-12 rounded-3xl shadow-2xl text-gray-900 hover:scale-105 transition-transform border border-indigo-500 hover:scale-[1.02] transition">
        <h3 class="text-5xl font-bold mb-8 bg-gradient-to-r from-rose-500 to-fuchsia-600 text-transparent bg-clip-text">✉️ Correos</h3>
        <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">General:</span> <?= $datos['email'] ?></p>
        <p class="text-xl mb-2"><span class="font-semibold text-indigo-900">Reservas:</span> <?= $datos['reservas_email'] ?></p>
        <p class="text-xl"><span class="font-semibold text-indigo-900">Recursos Humanos:</span> <?= $datos['recursos_email'] ?></p>
        </div>

        <div class="bg-gradient-to-br from-indigo-400 via-gray-300 to-gray-200 p-12 rounded-3xl shadow-2xl text-gray-900 hover:scale-105 transition-transform border border-indigo-500 hover:scale-[1.02] transition">
        <h3 class="text-5xl font-bold mb-8 bg-gradient-to-r from-lime-400 to-emerald-600 text-transparent bg-clip-text">💬 WhatsApp</h3>
        <p class="text-xl"><span class="font-semibold text-indigo-900">Atención al Cliente:</span> <?= $datos['whatsapp'] ?></p>
        </div>

    </div>
    </main>



    <footer class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-center text-indigo-200 py-6 mt-12 shadow-inner">
    <p class="text-sm">&copy; <?php echo date('Y'); ?> Aloja. Todos los derechos reservados.</p>
    </footer>

</body>
</html>

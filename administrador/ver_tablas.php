<?php
include "../config/conexion.php";
session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['admin'])) {
    echo "Sesión no iniciada";
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
    html, body {
      height: 100%;
    }
    body {
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1;
    }
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 0.95rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      border-radius: 1rem;
    }
    thead {
      background: linear-gradient(to right, #0f172a, #312e81, #1e3a8a);
      color: white;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    th, td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }
    tbody tr:nth-child(even) {
      background-color: #f3f4f6;
    }
    tbody tr:nth-child(odd) {
      background-color: #e0e7ff;
    }
    tbody tr:hover {
      background-color: #c7d2fe;
      transition: background-color 0.3s ease;
    }
    tbody td {
      vertical-align: middle;
    }
  </style>
</head>
<body class="bg-gray-300 min-h-screen">
    <!-- Navegador -->
    <header class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 px-8 py-6 text-white shadow-xl">
      <div class="flex justify-between items-center">
        <div class="flex items-center gap-4">
          <img src="../img/aloja-removebg-preview.png" class="w-20 h-20 rounded-full border-4 border-white shadow-lg" alt="Logo">
          <div>
            <h1 class="text-3xl font-extrabold bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-200 bg-clip-text text-transparent">Panel de Administración</h1>
            <p class="text-sm text-indigo-200">Gestión de datos</p>
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

  
    <div class="p-6 max-w-7xl mx-auto">
      <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <label for="tablaSelect" class="block text-left text-lg text-gray-700 mb-2 font-bold">Selecciona la tabla que deseas ver:</label>
        <select class="block w-full px-4 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring focus:border-indigo-500 mb-6" id="tablaSelect">
          <option value="huesped">Huésped</option>
          <option value="estadia">Estadías</option>
          <option value="empleados">Empleados</option>
          <option value="novedades">Novedades</option>
          <option value="huesped_has_estado">Huésped has estado</option>
          <option value="pagos">Pagos</option>
          <option value="tarifas">Tarifas</option>
          <option value="otroingreso">Otros ingresos</option>
        </select>
        <p class="text-sm text-gray-500">Puedes filtrar los datos fácilmente seleccionando una tabla específica del sistema.</p>
      </div>

      <div class="space-y-10">
        <div id="tabla_huesped" class="tabla-contenido">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-2xl font-bold text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t">Tabla Huésped</h2>
            <?php include '../tablas/ver_huesped.php'; ?>
          </div>
        </div>

        <div id="tabla_estadia" class="tabla-contenido hidden">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-2xl font-bold text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t">Tabla Estadías</h2>
            <?php include '../tablas/ver_estadia.php'; ?>
          </div>
        </div>

        <div id="tabla_empleados" class="tabla-contenido hidden">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-2xl font-bold text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t">Tabla Empleados</h2>
            <?php include '../tablas/ver_empleado.php'; ?>
          </div>
        </div>

        <div id="tabla_novedades" class="tabla-contenido hidden">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-2xl font-bold text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t">Tabla Novedades</h2>
            <?php include '../tablas/ver_novedades.php'; ?>
          </div>
        </div>

        <div id="tabla_huesped_has_estado" class="tabla-contenido hidden">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-2xl font-bold text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t">Tabla Huésped has Estado</h2>
            <?php include '../tablas/ver_huesped_has_estado.php'; ?>
          </div>
        </div>

        <div id="tabla_pagos" class="tabla-contenido hidden">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-2xl font-bold text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t">Tabla Pagos</h2>
            <?php include '../tablas/ver_pagos.php'; ?>
          </div>
        </div>

        <div id="tabla_tarifas" class="tabla-contenido hidden">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-2xl font-bold text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t">Tabla Tarifas</h2>
            <?php include '../tablas/ver_tarifa.php'; ?>
          </div>
        </div>

        <div id="tabla_otroingreso" class="tabla-contenido hidden">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-2xl font-bold text-white bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 py-2 px-4 rounded-t">Tabla Otros Ingresos</h2>
            <?php include '../tablas/ver_otros_ingresos.php'; ?>
          </div>
        </div>

      </div>
    </div>

  </main>

    <footer class="bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-center text-indigo-200 py-6 mt-12 shadow-inner">
      <p class="text-sm">&copy; <?php echo date('Y'); ?> Aloja - Panel de Administración.</p>
    </footer>
  <script>
    const tablaSelect = document.getElementById('tablaSelect');
    const tablas = {
      huesped: document.getElementById('tabla_huesped'),
      estadia: document.getElementById('tabla_estadia'),
      empleados: document.getElementById('tabla_empleados'),
      novedades: document.getElementById('tabla_novedades'),
      huesped_has_estado: document.getElementById('tabla_huesped_has_estado'),
      pagos: document.getElementById('tabla_pagos'),
      tarifas: document.getElementById('tabla_tarifas'),
      otroingreso: document.getElementById('tabla_otroingreso')
    };

    function mostrarTabla(tabla) {
      for (const key in tablas) {
        if (tablas[key]) tablas[key].classList.add('hidden');
      }
      if (tablas[tabla]) tablas[tabla].classList.remove('hidden');
    }

    tablaSelect.addEventListener('change', function () {
      mostrarTabla(this.value);
    });

    mostrarTabla('huesped'); // Mostrar por defecto

   
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

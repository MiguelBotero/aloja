<?php
include '../config/conexion.php';

// Obtener ingresos desde la tabla de pagos
$sql_ingresos = "SELECT SUM(valor) AS total_ingresos FROM pagos";
$result_ingresos = mysqli_query($conexion, $sql_ingresos);
$data_ingresos = mysqli_fetch_assoc($result_ingresos);
$total_ingresos = $data_ingresos['total_ingresos'] ?? 0;

// Suponemos un egreso fijo (ejemplo)
$total_egresos = 1500000;

$utilidad = $total_ingresos - $total_egresos;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Informe Financiero</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
    }
    .header-gradient {
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-5xl bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="header-gradient text-white p-6 text-center">
      <h1 class="text-3xl font-bold">Informe Financiero</h1>
      <p class="text-blue-100 mt-1">Generado el <?= date('d/m/Y') ?></p>
    </div>

    <div class="p-6">
      <!-- Ingresos -->
      <h2 class="text-xl font-semibold text-green-700 mb-2">Ingresos Registrados</h2>
      <table class="w-full mb-6 text-left border-collapse">
        <thead>
          <tr class="bg-green-100 text-green-900">
            <th class="py-2 px-4 border-b">Concepto</th>
            <th class="py-2 px-4 border-b">Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr class="hover:bg-green-50">
            <td class="py-2 px-4 border-b">Reservas (tabla pagos)</td>
            <td class="py-2 px-4 border-b">$<?= number_format($total_ingresos) ?></td>
          </tr>
        </tbody>
      </table>

      <!-- Egresos -->
      <h2 class="text-xl font-semibold text-red-700 mb-2">Egresos Estimados</h2>
      <table class="w-full mb-6 text-left border-collapse">
        <thead>
          <tr class="bg-red-100 text-red-900">
            <th class="py-2 px-4 border-b">Concepto</th>
            <th class="py-2 px-4 border-b">Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr class="hover:bg-red-50">
            <td class="py-2 px-4 border-b">Costos operativos (estimado)</td>
            <td class="py-2 px-4 border-b">$<?= number_format($total_egresos) ?></td>
          </tr>
        </tbody>
      </table>

      <!-- Utilidad -->
      <div class="text-right mt-6">
        <p class="text-xl font-bold <?= $utilidad >= 0 ? 'text-green-700' : 'text-red-700' ?>">
          Utilidad Neta: $<?= number_format($utilidad) ?>
        </p>
      </div>
    </div>

    <!-- Botones de acción -->
    <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-4">
      <button onclick="descargarPDF()" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
        <i class="fas fa-file-pdf mr-2"></i> Descargar PDF
      </button>
      <a href="index_admin.php" class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Volver al Panel
      </a>
    </div>
  </div>

  <!-- PDF Export -->
  <script>
    function descargarPDF() {
      const element = document.querySelector(".w-full.max-w-5xl");
      html2pdf().from(element).set({
        margin: 0.5,
        filename: 'informe_financiero.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
      }).save();
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
  
</body>
</html>
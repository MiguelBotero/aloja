<?php
session_start();

// Verificar si es administrador
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Acceso restringido solo para el administrador'); window.location.href='../sesion_admin.php';</script>";
    exit();
}

include("../config/conexion.php");

// Consultar todos los huéspedes
$query = "SELECT * FROM huesped";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Huéspedes | Sistema Hotelero</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        
        @media print {
            @page {
                size: landscape;
                margin: 0.5cm;
            }
            
            body {
                font-size: 10px;
                background: white;
            }
            
            .print-container {
                box-shadow: none;
                border: none;
                margin: 0;
                padding: 0;
                width: 100%;
            }
            
            .no-print {
                display: none !important;
            }
            
            table {
                page-break-inside: auto;
            }
            
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
        
        .header-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .table-row-hover:hover {
            background-color: #f1f5f9;
            transition: background-color 0.2s ease;
        }
        
        .sticky-header th {
            position: sticky;
            top: 0;
            z-index: 10;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 print:p-0">
    <div class="print-container w-full max-w-7xl bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Encabezado con diseño mejorado -->
        <div class="header-gradient bg-gradient-to-r from-gray-950 via-indigo-950 to-blue-950 text-white p-6 text-center">
            <div class="flex justify-between items-center mb-4 no-print">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-hotel text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Informe de Huéspedes</h1>
                    <p class="text-blue-100 mt-1">Sistema de Gestión Hotelera</p>
                </div>
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
            <div class="print-only text-center py-2">
                <h1 class="text-xl font-bold">Informe de Huéspedes</h1>
                <p class="text-xs">Generado el <?= date('d/m/Y H:i') ?></p>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="p-6">
            <!-- Resumen estadístico -->
            <div class="bg-blue-50 rounded-lg p-4 mb-6 flex flex-wrap justify-around items-center no-print">
                <div class="text-center px-4 py-2">
                    <div class="text-2xl font-bold text-blue-700">
                        <?= mysqli_num_rows($resultado) ?>
                    </div>
                    <div class="text-sm text-blue-600">Huéspedes registrados</div>
                </div>
                <div class="text-center px-4 py-2">
                    <div class="text-2xl font-bold text-blue-700">
                        <?= date('d/m/Y') ?>
                    </div>
                    <div class="text-sm text-blue-600">Fecha del informe</div>
                </div>
            </div>
            
            <!-- Tabla de huéspedes -->
            <div class="overflow-x-auto max-h-[calc(100vh-300px)] print:max-h-none">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="sticky-header bg-gray-100">
                            <th class="px-4 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nombre Completo</th>
                            <th class="px-4 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Documento</th>
                            <th class="px-4 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Teléfono</th>
                            <th class="px-4 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Origen</th>
                            <th class="px-4 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Contacto</th>
                            <th class="px-4 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                            <tr class="table-row-hover">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700"><?= $fila['id_huesped'] ?></td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900"><?= $fila['nombre_completo'] ?></td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    <span class="font-semibold"><?= $fila['tipo_documento'] ?></span><br>
                                    <?= $fila['numero_documento'] ?>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    <i class="fas fa-phone-alt mr-1 text-blue-500"></i> <?= $fila['telefono_huesped'] ?>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700"><?= $fila['origen'] ?></td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    <div class="font-medium"><?= $fila['nombre_contacto'] ?></div>
                                    <div class="text-xs text-gray-500"><?= $fila['telefono_contacto'] ?></div>
                                </td>
                                <td class="px-4 py-3 whitespace-normal text-sm text-gray-700 max-w-xs"><?= $fila['observaciones'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pie de página -->
            <div class="mt-8 pt-4 border-t border-gray-200 text-center text-sm text-gray-500 no-print">
                <p>Este informe fue generado automáticamente por el sistema de gestión hotelera.</p>
                <p class="mt-1">© <?= date('Y') ?> Hotel Elegante - Todos los derechos reservados</p>
            </div>
            
            <div class="print-only text-center text-xs text-gray-500 mt-4">
                <p>Página 1 de 1 | Generado el <?= date('d/m/Y H:i') ?></p>
            </div>
        </div>
        
        <!-- Botones de acción -->
        <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-4 no-print">
            <button onclick="window.print()" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-print mr-2"></i> Imprimir/PDF
            </button>
            <a href="index_admin.php" class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Volver al Panel
            </a>
        </div>
    </div>
    
    <script>
        // Agregar numeración de filas automáticamente
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                const firstCell = row.querySelector('td:first-child');
                if (firstCell) {
                    firstCell.textContent = index + 1;
                }
            });
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

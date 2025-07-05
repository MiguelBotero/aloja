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


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "SELECT * FROM otroingreso WHERE id_otroingreso = '$id'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $otroingreso = mysqli_fetch_assoc($resultado);
    } else {
        echo "<script>alert('Ingreso no encontrado.'); window.location.href='ver_tablas.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID no proporcionado.'); window.location.href='ver_tablas.php';</script>";
    exit();
}



?>


<!doctype html>
<html lang="en">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-200 text-gray-800 min-h-screen">
        <div class="text-center">

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

            <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h2 class="text-2xl font-bold mb-4">Editar otros ingreso</h2>
                <form action="../php/empleado_CRUD/actualizar_otro_ingresos.php" method="POST">
                    <input type="hidden" name="id_otroingreso" value="<?= $otroingreso['id_otroingreso'] ?>">
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">fecha registro</label>
                        <input type="date" name="fecha_registro" id="fecha_registro"value="<?= $otroingreso['fecha_registro'] ?>"class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                       
                    </div>

                    <div class="mb-4">
                        <label for="total" class="block text-sm font-medium text-gray-700">monto:</label>
                        <input type="number" name="total" id="total"value="<?= $otroingreso['total'] ?>"class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>

                    <div class="mb-4">
                        <label for="id_empleado" class="block text-sm font-medium text-gray-700">ID Empleado</label>
                        <select name="id_empleado" id="id_empleado" required
                            class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Seleccione un empleado</option>
                            <?php
                            include '../config/conexion.php';
                            $result = mysqli_query($conexion, "SELECT id_empleado FROM empleado");
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = ($row['id_empleado'] == $otroingreso['id_empleado']) ? 'selected' : '';
                                echo "<option value='{$row['id_empleado']}' $selected>ID {$row['id_empleado']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="text-end">
                        <a href="ver_tablas_E.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Cancelar</a>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-700 via-blue-600 to-blue-800 hover:from-blue-800 hover:to-blue-900 text-white font-semibold py-2 px-4 rounded-md shadow">
                            Actualizar
                        </button>
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
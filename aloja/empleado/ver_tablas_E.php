

<?php
session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['usuario'])) {
    echo "Sesión no iniciada";
    exit();
}

// Conectar a la base de datos
include('../config/conexion.php');

// Obtener datos del empleado que ha iniciado sesión
$usuario = $_SESSION['usuario'];
$sql = "SELECT usuario FROM empleado WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexion, $sql);
$empleado = mysqli_fetch_assoc($resultado); // <-- aquí sí obtienes el nombre


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="../css/pagina5.css">

    <style>
        .navegador{
            background-color: rgba(0, 0, 0, 0.289);
            height: 100%;
    
        }

  
  
        li{
            margin-left: 2px;
            margin-bottom: 70px;
        }
        .nav-link{
            color: rgb(255, 252, 246);
        }
        
        .nav-link:hover{
            background-color: rgba(55, 55, 230, 0.508);
            color: white;
        }





       .tabla {
            margin: 30px;
        
        
        }

        .tabla th,
        .tabla td{
            border: 2px solid black;
        

        } 



        .tabla tbody tr:nth-child(odd) td {
            background-color:white;
        }

        .tabla tbody tr:nth-child(even) td {
            background-color:rgb(165, 165, 165);
        }

        .titulo {
            background-color: rgba(0, 0, 0, 0.289);
        }

        .titulo h2{
        font-size: 100px;
        color: white;
      }

        .titulo h3{
          color: gray;
          margin-left: 325px;
          text-align: left;
        }


    </style>
  </head>
  <body>
    <div class="text-center">

        <div class="row">
          <div class="col-12 titulo">
            <h2>Bienvenido a Aloja</h2>
            <h3>Empleado. . .</h3>
          </div>
        </div>

        
        <div class="row">
            <div class="col-lg-2 col-12 ">
                <ul class="nav d-flex flex-row flex-lg-column navegador">

                     <li class="nav-item text-white">
                        <img src="../img/perfil.jpg" alt="">
                        <p><?php echo $empleado['usuario'];?></p>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index_E.php">inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Registro
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="formulario_E.php"> datos huesped</a></li>
                            <li><a class="dropdown-item" href="#">Ver datos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="galeria_E.php">Galeria</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="ubicacion_E.php">Ubicación</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="nosotros_E.php">información del hotel</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contacto_E.php">contacto y redes</a>
                    </li>

                    <li class="nav-item">
                        <a href="../php/cerrar_sesion_admin.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-lg-9">

                <div class="container mt-4">
                    <label for="tablaSelect" class="form-label text-white">Selecciona la tabla que deseas ver:</label>
                    <select class="form-select" id="tablaSelect">
                        <option value="huesped">Huésped</option>
                        <option value="estadia">Estadías</option>
                        <option value="empleados">Empleados</option>
                        <option value="novedades">novedades</option>
                        <option value="huesped_has_estado">Huesped has estado</option>
                        <option value="pagos">Pagos</option>
                        <option value="tarifas">Tarifa</option>
                        <option value="otroingreso">otros ingresos</option>
                    </select>
                </div>

                <div class="container mt-4">

                    <!-- Tabla Huesped -->
                    <div id="tabla_huesped" class="tabla-contenido d-none">
                        <?php include '../tablas/ver_huesped.php'; ?>
                    </div>

                    <!-- Tabla Estadía -->
                    <div id="tabla_estadia" class="tabla-contenido d-none">
                        <?php include '../tablas/ver_estadia.php'; ?>
                    </div>

                    <!-- Tabla Empleados -->
                    <div id="tabla_empleados" class="tabla-contenido d-none">
                        <?php include '../tablas/ver_empleado.php'; ?>
                    </div>

                    <!-- Tabla Novedades -->
                    <div id="tabla_novedades" class="tabla-contenido d-none">
                        <?php include '../tablas/ver_novedades.php'; ?>
                    </div>

                    <!-- Tabla huesped_has_estado -->
                    <div id="tabla_huesped_has_estado" class="tabla-contenido d-none">
                        <?php include '../tablas/ver_huesped_has_estado.php'; ?>
                    </div>

                    <!-- Tabla pagos -->
                    <div id="tabla_pagos" class="tabla-contenido d-none">
                        <?php include '../tablas/ver_pagos.php'; ?>
                    </div>

                    <!-- Tabla tarifas -->
                    <div id="tabla_tarifas" class="tabla-contenido d-none">
                        <?php include '../tablas/ver_tarifa.php'; ?>
                    </div>

                    <!-- Tabla otro ingreso -->
                    <div id="tabla_otroingreso" class="tabla-contenido d-none">
                        <?php include '../tablas/ver_otros_ingresos.php'; ?>
                    </div>


                </div>
            </div>

        </div>
        
    </div>

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
        otroingreso: document.getElementById('tabla_otroingreso'),
    };

    tablaSelect.addEventListener('change', function () {
        for (const key in tablas) {
            tablas[key].classList.add('d-none');
        }
        const selected = this.value;
        if (tablas[selected]) {
            tablas[selected].classList.remove('d-none');
        }
    });

    // Mostrar uno por defecto si quieres
    // tablas.huesped.classList.remove('d-none');
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>















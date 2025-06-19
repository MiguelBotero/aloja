<?php
// Conectar a la base de datos
include('../config/conexion.php');

// Consulta para obtener las habitaciones
$query = "SELECT * FROM habitacion"; 
$result = mysqli_query($conexion, $query);
?>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../sesion_.php");
    exit();
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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

  .titulo {
   background-color: rgba(0, 0, 0, 0.289);
}

.titulo h2{
  font-size: 105px;
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

    <div class=" text-center ">
        <div class="row">
          <div class="col-12 titulo">
            <h2>Bienvenido a Aloja</h2>
            <h3>Administrador . . .</h3>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 col-12 ">
            <ul class="nav d-flex flex-row flex-lg-column navegador">

              <li class="nav-item">
                <img src="" alt="">
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">inicio</a>
              </li>


              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Registro
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="formulario.php">Registro</a></li>
                  <li><a class="dropdown-item" href="ver_tablas.php">Ver datos</a></li>
                </ul>
              </li>


                
              <li class="nav-item">
                <a class="nav-link" href="galeria_admin.php">Galeria</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="ubicacion_admin.php">Ubicación</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="nosotros_admin.php">información del hotel</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="contactos_admin.php">contacto y redes</a>
              </li>

              <li class="nav-item">
              <a href="../php/cerrar_sesion_admin.php">Cerrar sesión</a>
              </li>
            </ul>
          </div>
          
          <div class="col-12 col-lg-8 mb-3 habitaciones">

          <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <div class="col">
                <div class="card habitacion1 text-white">
                  <img src="../img/<?php echo $row['imagen']; ?>" class="card-img-top" alt="Habitación">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                    <p class="card-text"><?php echo $row['precio']; ?></p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['id_habitacion']; ?>">Ver más</button>
                  </div>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="modal<?php echo $row['id_habitacion']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $row['id_habitacion']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel<?php echo $row['id_habitacion']; ?>">Información de la Habitación</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                      <div class="row text-white">
                        <!-- Imagen a la izquierda -->
                        <div class="col-md-4 mb-3 text-white">
                          <img src="../img/<?php echo $row['imagen']; ?>" alt="Imagen habitación" class="img-fluid rounded">
                        </div>

                        <!-- Información a la derecha -->
                        <div class="col-md-8">
                          <h3>Descripción</h3>
                          <p><?php echo $row['dotacion']; ?></p>

                          <div class="row">
                            <!-- Contactos -->
                            <div class="col-md-6">
                              <h5>Encargado</h5>
                              <p><strong>Teléfono:</strong><?php echo $row['telefono_encargado']; ?></p>
                            </div>

                            <!-- Mapa + Estado -->
                            <div class="col-md-6">
                              <h5>Ubicación</h5>
                              <div style="width: 100%; height: 200px;">
                                <iframe
                                  src="<?php echo $row['mapa']; ?>"
                                  width="100%"
                                  height="100%"
                                  style="border:0;"
                                  allowfullscreen=""
                                  loading="lazy"
                                  referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                              </div>
                              <br>
                              <!-- Switch de disponibilidad -->
                              <div class="estado-container">
                                <label class="switch">
                                  <input type="checkbox"
                                        class="disponibilidad-switch"
                                        <?php echo ($row['disponibilidad'] == 1 ? 'checked' : ''); ?>
                                        onchange="cambiarDisponibilidad(<?php echo $row['id_habitacion']; ?>, this)">
                                  <span class="slider"></span>
                                </label>
                                <span class="estado-texto"><?php echo ($row['disponibilidad'] == 1 ? 'Disponible' : 'No disponible'); ?></span>

                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      <a href="../php/editar_habitacion.php?id=<?php echo $row['id_habitacion']; ?>" class="btn btn-warning btn-sm">Editar</a>
                      <a href="../php/eliminar_habitacion.php?id=<?php echo $row['id_habitacion']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta habitación?')">Eliminar</a>
                    </div>

                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
            

          </div>
        </div> 
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', () => {
          document.querySelectorAll('.disponibilidad-switch').forEach(input => {
            actualizarColorSwitch(input);
          });
        });

        function cambiarDisponibilidad(idHabitacion, checkbox) {
          actualizarColorSwitch(checkbox);

          const contenedor = checkbox.closest('.estado-container');
          const texto = contenedor.querySelector('.estado-texto');
          texto.textContent = checkbox.checked ? 'Disponible' : 'No disponible';

          // Aquí podrías guardar con AJAX si quieres
        }

        function actualizarColorSwitch(input) {
          const slider = input.nextElementSibling;
          if (input.checked) {
            slider.style.backgroundColor = '#28a745'; // verde
          } else {
            slider.style.backgroundColor = '#dc3545'; // rojo
          }
        }
      </script>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>


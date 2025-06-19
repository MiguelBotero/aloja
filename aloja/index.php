<?php
// Conectar a la base de datos
include('config/conexion.php');

// Consulta para obtener las habitaciones
$where = [];

if (!empty($_GET['busqueda'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_GET['busqueda']);
    $where[] = "nombre LIKE '%$busqueda%'";
}

if (isset($_GET['disponibilidad']) && $_GET['disponibilidad'] !== '') {
    $disponibilidad = intval($_GET['disponibilidad']);
    $where[] = "disponibilidad = $disponibilidad";
}

$where_sql = '';
if (!empty($where)) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

$query = "SELECT * FROM habitacion $where_sql";

$result = mysqli_query($conexion, $query);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido a Aloja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="css/pagina5.css">

    <style>

      .titulo {
          background-color: rgba(0, 0, 0, 0.289);
        }

      .titulo h3{
        font-size: 105px;
        color: white;
      }
            
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
      
    </style>
  </head>

  <body>

    <div class="text-center">
        <div class="row">
          <div class="col-12 titulo">
            <h3>Bienvenido a Aloja</h3>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 col-12">
            <ul class="nav d-flex flex-row flex-lg-column navegador">
              <li class="nav-item">
                <a class="nav-link" href="#">Inicio</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="galeria.php">Galería</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="ubicacion.php">Ubicación</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="nosotros.php">Nosotros</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="contactos.php">Contacto</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="sesion.php">Inicio de sesión</a>
              </li>
            </ul>
          </div>
          
         
          <div class="col-12 col-lg-8 mb-3 ">

              <!-- FORMULARIO DE BÚSQUEDA (en la parte superior, no al lado) -->
    
              <div class=" mt-4 col-12 col-lg-12 mb-3">
                <form method="GET">
                  <div class="row g-3 justify-content-center">
                    <div class="col-md-4">
                      <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre..." value="<?php echo isset($_GET['busqueda']) ? $_GET['busqueda'] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                      <select name="disponibilidad" class="form-select">
                        <option value="">Todas las habitaciones</option>
                        <option value="1" <?php if(isset($_GET['disponibilidad']) && $_GET['disponibilidad'] === "1") echo "selected"; ?>>Solo disponibles</option>
                        <option value="0" <?php if(isset($_GET['disponibilidad']) && $_GET['disponibilidad'] === "0") echo "selected"; ?>>Solo no disponibles</option>
                      </select>
                    </div>

                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                  </div>
                </form>
              </div>
    

              <!-- Grid de habitaciones debajo del filtro -->
              <div class="row  mt-4 habitaciones mb-3">
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                  <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card habitacion1 text-white">
                    <img src="img/<?php echo $row['imagen']; ?>" alt="Imagen habitación" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
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
                            <div class="col-md-4 mb-3">
                            <img src="img/<?php echo $row['imagen']; ?>" alt="Imagen habitación" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">

                            </div>

                            <!-- Información a la derecha -->
                            <div class="col-md-8">
                              <h3>Descripción</h3>
                              <p><?php echo $row['dotacion']; ?></p>

                              <div class="row">
                                <!-- Contactos -->
                                <div class="col-md-6">
                                  <h5>Encargado</h5>
                                  <p><strong>Teléfono:</strong> <?php echo $row['telefono_encargado']; ?></p>
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
                                  <!-- Disponibilidad solo vista (sin interacción) -->
                                  <div class="estado-container">
                                    <label class="switch">
                                      <input type="checkbox" disabled <?php echo ($row['disponibilidad'] == 1 ? 'checked' : ''); ?>>
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
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              </div>
          </div>
        </div> 
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>

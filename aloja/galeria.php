<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" 
    crossorigin="anonymous">

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
        
        .carousel-item{
            width: 300px;
            height: 300px;
        }

        .carousel-item img{
            width: 100%;
            height: 100%;
        }

        .contenedor-fotos{
            background-color: rgba(243, 228, 228, 0.1);
            margin-top: 30px;
            border: 1px solid white;
        }

        .contenedor-zona{
            background-color: rgba(243, 228, 228, 0.1);
            margin-top: 30px;
            height: 700px;

           

        }

        .contenedor-zona img{
            width: 60%;
            height: 25%;
        }

        .zona-img2{
            width: 55%;
            height: 25%;
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
            <div class="col-lg-2 col-12 ">
                <ul class="nav d-flex flex-row flex-lg-column navegador">

                    <li class="nav-item">
                        <img src="" alt="">
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">inicio</a>
                    </li>
                        
                    <li class="nav-item">
                        <a class="nav-link" href="#">Galeria</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="ubicacion.php">Ubicación</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contactos.php">Contactos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="sesion.php">Inicio de sesión</a>
                    </li>
                </ul>
            </div>


            

                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="col-8 contenedor-fotos">
                            <div>
                                <h3>Fotos hotel</h3>

                                <div id="carouselExampleAutoplaying1" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                    
                                        <div class="carousel-item active">
                                            <img src="img/foto-hotel.jpg"  class="d-block " alt="..." style="width: 600px; margin-left:30px;">
                                        </div>
                                        
                                        <div class="carousel-item">
                                            <img src="img/foto-hotel2.jpg" class="d-block " alt="..." style="width: 600px; margin-left:30px;">
                                        </div>
                                        
                                        
                                    
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>


                                <div class="col-12">
            
                                    <h3>habitaciones</h3>
                                        <div id="carouselExampleAutoplaying3" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
            
                                            <div class="carousel-item active">
                                            <img src="img/dormitorio-blanco-gris-negro.jpg"  class="d-block " alt="..." style="width: 600px; margin-left:30px;">
                                        </div>
                                        
                                        <div class="carousel-item">
                                            <img src="img/dormitorio-blanco-gris.jpg" class="d-block " alt="..." style="width: 600px; margin-left:30px;">
                                        </div>
                                        
                                        <div class="carousel-item">
                                            <img src="img/habitacion-elegante-moderna.jpg" class="d-block " alt="..." style="width: 600px; margin-left:30px;">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="img/habitacion4.jpg" class="d-block" alt="..." style="width: 600px; margin-left:30px;">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="img/habitacion5.jpg" class="d-block" alt="..." style="width: 600px; margin-left:30px;">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="img/habitacion6.jpg" class="d-block" alt="..." style="width: 600px; margin-left:30px;">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="img/habitacion7.jpg" class="d-block" alt="..." style="width: 600px; margin-left:30px;">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="img/habitacion8.jpg" class="d-block" alt="..." style="width: 600px; margin-left:30px;">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="img/habitacion9.jpg" class="d-block" alt="..." style="width: 600px; margin-left:30px;">
                                        </div>
            
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying3" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying3" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                            </button>
                                    </div>
                                            
                                </div>
                            </div>
                        
                        </div>

                    
                    

                
                    
                    
                    
                    
                            <div class="col-4">
                                <div class="contenedor-zona text-white">
                                    
                                    <h3>Zona comunes</h3>

                                    <div>
                                        <img src="img/parque_berrio.jpeg" alt="foto">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae accusantium velit iure cupiditate officiis quos repellendus sed corrupti, quidem eos vero vitae labore inventore impedit ipsum. Vero magni architecto aliquid.</p>
                                    </div>

                                    <div>
                                        <img src="img/parque_berrio2.jpeg" alt="foto" class="zona-img2">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore maxime quo distinctio repellat et recusandae rem hic cum, quae expedita dignissimos dolore perspiciatis temporibus ea minima adipisci, commodi necessitatibus ab!</p>
                                    </div>
                                    

                                </div>
                            </div>
                        
                        
                    </div>
                    
                </div>
        
  
            





        </div>
        
        



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
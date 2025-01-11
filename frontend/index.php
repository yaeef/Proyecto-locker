<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/tbs.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Locker ESCOM</title>
</head>
<body>
    <header class="header">
        <h1 class="header__titulo centrar-texto"><span></span>LOCKER <span>ESCOM</span></h1>
        <img src="img/menu-resp.png" alt="Burger-Menu" class="menu-resp">
    </header>
    <nav class="nav">
        <div class="nav__barra contenedor">
            <a class="nav__enlace boton--seleccion" href="index.php">Inicio</a>
            <a class="nav__enlace" href="solicitud.php">Solicitud</a>
            <?php
                session_start();
                if(isset($_SESSION['session']))
                {
                    echo '<a class="nav__enlace" href="profiles/alumno/alumno.php">Acceso</a>';
                }
                else
                {
                    echo '<a class="nav__enlace" href="acceso.php">Acceso</a>';
                }
            ?>
            <a class="nav__enlace" href="admin.php">Admin</a>
        </div>
    </nav>

    
    <div class="carousel slide" data-bs-ride="carousel" id="index-noticias">
        <div class="carousel-indicators">
            <button class="active" data-bs-target="#index-noticias" data-bs-slide-to="0"></button>
            <button data-bs-target="#index-noticias" data-bs-slide-to="1"></button>
            <button data-bs-target="#index-noticias" data-bs-slide-to="2"></button>
            <button data-bs-target="#index-noticias" data-bs-slide-to="3"></button>
        </div>
        <div class="carousel-inner carousel-fade carousel-dark">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/heror.jpeg" alt="Mascota de ESCOM">
                <div class="carousel-caption d-none d-md-block">
                        <div class="hero__info">
                            <a href="solicitud.php" class="boton boton-hero">Solicitar casillero</a>
                        </div>
                </div>
            </div>
            <div class="carousel-item">
                <a href="https://www.ipn.mx/daes/servicios/becas/resultados-convocatoriageneral-2025-1.html" target="_blank"><img class="d-block w-100" src="img/n1.webp" alt="Resultados de convocatora de BECAS"></a>
            </div>
            <div class="carousel-item">
                <a href="https://www.test.desarrolloweb.ipn.mx/assets/files/daes/docs/becas/becalos25-1.pdf" target="_blank"><img class="d-block w-100" src="img/n2.webp" alt="Convocatoria BECALOS"></a>
            </div>
            <div class="carousel-item">
                <a href="https://www.test.desarrolloweb.ipn.mx/assets/files/daes/docs/becas/becatelcel-telmex25-1.pdf" target="_blank" ><img class="d-block w-100" src="img/n3.webp" alt="Beca de Excelencia TELMEX"></a>
            </div>
            
        </div>

        <button class="carousel-control-prev" data-bs-target="#index-noticias" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" data-bs-target="#index-noticias" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <main class="contenedor sombra">
        <h2 class="actividadesTitulo">Actividades culturales</h2>
        <div class="actividades">
            <section class="actividad">
                <h3>Actividad 1</h3>
                <div class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="1.5"> <path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25"></path> <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> </svg> 
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea tenetur perspiciatis quidem veritatis velit in sint dolor</p>
            </section>
            <section class="actividad">
                <h3>Actividad 2</h3>
                <div class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="1.5"> <path d="M4 10l0 6"></path> <path d="M20 10l0 6"></path> <path d="M7 9h10v8a1 1 0 0 1 -1 1h-8a1 1 0 0 1 -1 -1v-8a5 5 0 0 1 10 0"></path> <path d="M8 3l1 2"></path> <path d="M16 3l-1 2"></path> <path d="M9 18l0 3"></path> <path d="M15 18l0 3"></path> </svg> 
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="1.5"> <path d="M8.286 7.008c-3.216 0 -4.286 3.23 -4.286 5.92c0 3.229 2.143 8.072 4.286 8.072c1.165 -.05 1.799 -.538 3.214 -.538c1.406 0 1.607 .538 3.214 .538s4.286 -3.229 4.286 -5.381c-.03 -.011 -2.649 -.434 -2.679 -3.23c-.02 -2.335 2.589 -3.179 2.679 -3.228c-1.096 -1.606 -3.162 -2.113 -3.75 -2.153c-1.535 -.12 -3.032 1.077 -3.75 1.077c-.729 0 -2.036 -1.077 -3.214 -1.077z"></path> <path d="M12 4a2 2 0 0 0 2 -2a2 2 0 0 0 -2 2"></path> </svg> 
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea tenetur perspiciatis quidem veritatis velit in sint dolor</p>
            </section>
            <section class="actividad">
                <h3>Actividad 3</h3>
                <div class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="1.5"> <path d="M8.286 7.008c-3.216 0 -4.286 3.23 -4.286 5.92c0 3.229 2.143 8.072 4.286 8.072c1.165 -.05 1.799 -.538 3.214 -.538c1.406 0 1.607 .538 3.214 .538s4.286 -3.229 4.286 -5.381c-.03 -.011 -2.649 -.434 -2.679 -3.23c-.02 -2.335 2.589 -3.179 2.679 -3.228c-1.096 -1.606 -3.162 -2.113 -3.75 -2.153c-1.535 -.12 -3.032 1.077 -3.75 1.077c-.729 0 -2.036 -1.077 -3.214 -1.077z"></path> <path d="M12 4a2 2 0 0 0 2 -2a2 2 0 0 0 -2 2"></path> </svg> 
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea tenetur perspiciatis quidem veritatis velit in sint dolor</p>
            </section>
        </div>
    </main>
    <footer>
        <div class="footer contenedor">
            <div class="footer__logos">
                <a href="http://www.ipn.mx/" target="_blank"><img src="img/IPN-Logo.png" alt="Logotipo del IPN"></a>
                <a href="http://www.escom.ipn.mx/" target="_blank"><img src="img/logoESCOMBlanco.png" alt="Logotipo de ESCOM"></a>
                
            </div>
            <div class="footer__texto">
            <p>Gestión de Casilleros | ESCOM IPN |Todos los derechos reservados ©</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
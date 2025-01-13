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
            <a class="nav__enlace" href="solicitud.php">Registro</a>
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
        <h2 class="actividadesTitulo ">Actividades Culturales</h2>
        <h3 class="centrar-texto">La ESCOM cuenta con los siguientes talleres culturales</h3>
        <div class="actividades">
            <section class="actividad">
                <h3 class="actividadesSubtitulo">Artes Plásticas</h3>
                <div class="icono">
                    <img src="img/artes.png" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="80" height="80" stroke-width="1.5"> <path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25"></path> <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                </div>
                <p>
                    Aprende a expresar tus emociones y sentimientos por medio de la pintura y el dibujo.
                    <br>
                    <b>Profra.</b> Martha Aurora Torres Hernández<br>
                    <b>Horario:</b> Miércoles y Viernes de 13:00 a 18:00hrs.
                </p>
            </section>
            <section class="actividad">
                <h3>Creación literaria</h3>
                <div class="icono">
                    <img src="img/literatura.png" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="80" height="80" stroke-width="1.5"> <path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25"></path> <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                </div>
                <p>
                    Podrás adquirir técnicas y métodos para formar hábitos de lectura y escritura. Además prepara a los alumnos para participar en concursos de poesía, cuento, lectura en atril y declamación.
                    <br>
                    <b>Prof.</b> Julián Castruita Morán<br>
                    <b>Horario:</b> Jueves de 11:00 a 16:00hrs.
                </p>
            </section>
            <section class="actividad">
                <h3>Teatro</h3>
                <div class="icono">
                    <img src="img/teatro.png" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="80" height="80" stroke-width="1.5"> <path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25"></path> <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                </div>
                <p>
                    Aprende a expresarte en público a través de diversas técnicas teatrales, contribuyendo así a un mejor desarrollo integral.
                    <br>
                    <b>Profra.</b> Verónica Hernández<br>
                    <b>Horario:</b> Martes de 12:00 a 15:00hrs y Miércoles de 15:30 a 18:30hrs.
                </p>
            </section>
        </div>  
        <hr><br>
        <h2 class="actividadesTitulo">Actividades Deportivas</h2>
        <p class="centrar-texto">La ESCOM participa activamente en diferentes actividades a través de 
            selecciones y equipos representatitos en torneos internos e interpolitécnicos.
        </p>
        <div class="actividades">
            <section class="actividad">
                <h3 class="actividadesSubtitulo">Fútbol: Soccer, Siete y Rápido (varonil/femenil)</h3>
                <div class="icono">
                    <img src="img/soccer.png" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="80" height="80" stroke-width="1.5"> <path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25"></path> <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                </div>
                <p>
                    <b>Prof.</b> Diego Espinosa Gómez<br>
                    <b>Horario:</b> Martes de 16:00 a 19:00hrs, Miércoles de 10:00 a 18:00hrs y Viernes de 12:00 a 20:00hrs.
                </p>
            </section>
            <section class="actividad">
                <h3>Voleibol (varonil/fememil)</h3>
                <div class="icono">
                    <img src="img/voleibol.png" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="80" height="80" stroke-width="1.5"> <path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25"></path> <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                </div>
                <p>
                    <b>Prof.</b> Hugo Hernández	Vera<br>
                    <b>Horario:</b> Martes y Jueves de 12:00 a 19:00hrs.
                </p>
            </section>
            <section class="actividad">
                <h3>Clubes deportivos (varonil/femenil)</h3>
                <div class="icono">
                    <img src="img/clubes.png" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" width="80" height="80" stroke-width="1.5"> <path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25"></path> <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path> <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                </div>
                <p>
                    <ul>
                        <li>Taekwondo</li>
                        <li>Ajedrez</li>
                        <li>Barras</li>
                        <li>Ping Pong</li>
                        <li>Tochito bandera</li>
                    </ul>
                    Para más información consulta: <a href="https://www.facebook.com/ESCOMculturaydeportes" target="_blank">Actividades Culturales y Deportivas ESCOM</a>
                </p>
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

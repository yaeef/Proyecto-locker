<?php
    session_start();
    if(!isset($_SESSION['session']) && !($_SESSION['estado'] == 'B' || $_SESSION['estado'] == 'E' || $$_SESSION['estado'] == 'H'))
    {
        header("location:../../acceso.php?notif=200");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../img/tbs.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Acceso</title>
</head>
<body>
    <header class="header">
        <h1 class="header__titulo centrar-texto"><span></span>LOCKER <span>ESCOM</span></h1>
        <img src="../../img/menu-resp.png" alt="Burger-Menu" class="menu-resp">
    </header>
    <nav class="nav">
        <div class="nav__barra contenedor">
            <a class="nav__enlace" href="../../index.php">Inicio</a>
            <a class="nav__enlace" href="../../solicitud.php">Solicitud</a>
            <a class="nav__enlace boton--seleccion" href="../../../backend/logout.php">Logout</a>
            <a class="nav__enlace" href="../../admin.php">Admin</a>
        </div> 
    </nav>
    <main>
        <section class="contenedor sombra">
        <?php 
            echo '<h2 class="titulo-form"> Bienvenido @' . $_SESSION['usuario'] . '</h2>';

            if($_SESSION['estado'] == "B")
            {
                echo '
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg-custom">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Términos y Condiciones</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" disabled></button>
                            </div>
                            <div class="modal-body">
                                <img src="../../img/terminos.png" alt="Imagen de Términos y condiciones para el uso de casilleros de ESCOM">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="window.location.href=\'../../../backend/profiles/alumno/rechazar.php\'">Rechazar</button>
                                <button type="button" class="btn btn-primary" onclick="window.location.href=\'../../../backend/profiles/alumno/aceptar.php\'">Aceptar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() { var myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), { backdrop: "static", keyboard: false }); myModal.show(); });
                    </script>
                    <style>
                        .modal-backdrop { background-color: rgba(0, 0, 0, 1); }
                        @media only screen and (min-width: 1000px)
                        {
                            .modal-lg-custom { max-width: 45%; }
                        }       
                    </style>
                    ';
            }
            if($_SESSION['estado'] == "E")
            {
                echo '
                    <form action="../../../backend/profiles/alumno/comprobante.php" class="formulario" method="post" name="form-comprobante" id="form-comprobante" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Sube tu comprobante de pago</legend>
                            <div class="">
                                <div class="formulario__campo">
                                    <label for="comprobante">Comprobante de pago</label>
                                    <label for="comprobante" class="botonArchivo">seleccionar comprobante</label>
                                    <input type="file" name="comprobante" id="comprobante" accept="application/pdf" required style="display:none;">
                                    <span id="nombreArchivo3" style="color: var(--primario);">Ningún archivo seleccionado</span>
                                </div>
                            </div>
                            <div class="formulario__boton">
                                <input class="boton" type="submit" value="Subir">
                            </div>
                        </fieldset>
                    </form>
                    <script>
                        var comprobante = document.getElementById("comprobante");
                        var nombreArchivo3 = document.getElementById("nombreArchivo3");

                        comprobante.addEventListener("change", () =>
                        {
                            if(comprobante.files.length > 0)
                            {
                                nombreArchivo3.textContent = comprobante.files[0].name;
                            }
                            else
                            {
                                nombreArchivo3.textContent = "Ningún archivo seleccionado";
                            }
                        });
                    </script>
            ';
            }
            if($_SESSION['estado'] == "H")
            {
                echo '<h3 style="text-align: center;">Descargar acuse</h3>';
            }
            
        ?>

        </section>
    </main>
    <footer>
        <div class="footer contenedor">
            <div class="footer__logos">
                <a href="http://www.ipn.mx/" target="_blank"><img src="../../img/IPN-Logo.png" alt="Logotipo del IPN"></a>
                <a href="http://www.escom.ipn.mx/" target="_blank"><img src="../../img/logoESCOMBlanco.png" alt="Logotipo de ESCOM"></a>
                
            </div>
            <div class="footer__texto">
            <p>Gestión de Casilleros | ESCOM IPN |Todos los derechos reservados ©</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

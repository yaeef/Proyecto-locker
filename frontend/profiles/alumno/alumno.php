<?php
    session_start();
    if(!isset($_SESSION['session']) || $_SESSION['session'] != 'alumno')
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
    <style>
        .card
        { 
            margin: 1rem auto;
            display: grid; 
            grid-template-columns: 1fr 5fr;
            align-items: center; 
            border: 1px solid #ccc; 
            border-radius: 8px; 

            padding: 10px; 
            width: min(40rem, 100%);
        } 
        .icon 
        { 
            margin-right: 10px; 
        } 
        .icon img 
        { 
            width: 24px; height: 24px; 
        } 
        .info 
        { font-size: 16px; 
        } 
        .info span 
        { 
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1 class="header__titulo centrar-texto"><span></span>LOCKER <span>ESCOM</span></h1>
        <img src="../../img/menu-resp.png" alt="Burger-Menu" class="menu-resp">
    </header>
    <nav class="nav">
        <div class="nav__barra contenedor">
            <a class="nav__enlace" href="../../index.php">Inicio</a>
            <a class="nav__enlace" href="../../solicitud.php">Registro</a>
            <a class="nav__enlace boton--seleccion" href="alumno.php">Acceso</a>
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
                    <div class="formulario__boton">
                        <input class="boton" type="button" onclick="window.location.href=\'../../../backend/logout.php\'" value="Logout" style="background-color:red;">
                    </div>
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
                echo    '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: min(60rem, 100%); margin: 3rem auto; text-align: center;">El pago de tu casillero procedió, a continuación podras descargar el acuse en el cual puedes obtener la información completa de tu casillero.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
                
                echo '  <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Nombre"> 
                            </div> 
                            <div class="info"> 
                                <span>Nombre: </span>'. ucfirst($_SESSION['nombre']) .'
                            </div> 
                        </div> 
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Apellido Paterno"> 
                            </div> 
                            <div class="info"> 
                                <span>Apellido Paterno: </span>' . ucfirst($_SESSION['paterno']) .'
                            </div> 
                        </div> 
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Apellido Materno"> 
                            </div> 
                            <div class="info"> 
                                <span>Apellido Materno: </span>' . ucfirst($_SESSION['materno']) .'
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/fingerprint.png" alt="Boleta"> 
                            </div> 
                            <div class="info"> 
                                <span>Boleta: </span>' . $_SESSION['boleta'] .'
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/locker.png" alt="casillero"> 
                            </div> 
                            <div class="info"> 
                                <span>Casillero: </span>' . $_SESSION['casillero'] .'
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/schedule.png" alt="Semestre"> 
                            </div> 
                            <div class="info"> 
                                <span>Semestre: </span>  2025-1
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/height.png" alt="Estatura"> 
                            </div> 
                            <div class="info"> 
                                <span>estatura: </span>' . $_SESSION['estatura'] .'
                            </div>
                        </div>';

                echo    '<div class="formulario__boton">
                            <input class="boton" type="button" onclick="window.location.href=\'../../../backend/logout.php\'" value="Logout" style="background-color:red;">
                            <input class="boton" type="button" onclick="window.open(\'../../../backend/profiles/alumno/acuse.php\',\'_blank\')" value="Acuse">
                        </div>';
            }
            if($_SESSION['estado'] == "F" || $_SESSION['estado'] == "I")
            {
                if($_SESSION['estado'] == "F")
                {
                    echo    '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width: min(60rem, 100%); margin: 3rem auto; text-align: center;">Tu pago esta en revisión, inicia sesión dentro de 24 horas.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
                }
                elseif($_SESSION['estado'] == "I")
                {
                    echo    '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width: min(60rem, 100%); margin: 3rem auto; text-align: center;">Debes renovar tu casillero debido al fin de semestre, tienes una semana para renovarlo.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
                }
                echo '  <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Nombre"> 
                            </div> 
                            <div class="info"> 
                                <span>Nombre: </span>'. ucfirst($_SESSION['nombre']) .'
                            </div> 
                        </div> 
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Apellido Paterno"> 
                            </div> 
                            <div class="info"> 
                                <span>Apellido Paterno: </span>' . ucfirst($_SESSION['paterno']) .'
                            </div> 
                        </div> 
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Apellido Materno"> 
                            </div> 
                            <div class="info"> 
                                <span>Apellido Materno: </span>' . ucfirst($_SESSION['materno']) .'
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/fingerprint.png" alt="Boleta"> 
                            </div> 
                            <div class="info"> 
                                <span>Boleta: </span>' . $_SESSION['boleta'] .'
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/locker.png" alt="casillero"> 
                            </div> 
                            <div class="info"> 
                                <span>Casillero: </span>' . $_SESSION['casillero'] .'
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/schedule.png" alt="Semestre"> 
                            </div> 
                            <div class="info"> 
                                <span>Semestre: </span>  2025-1
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/height.png" alt="Estatura"> 
                            </div> 
                            <div class="info"> 
                                <span>estatura: </span>' . $_SESSION['estatura'] .'
                            </div>
                        </div>';

                echo    '<div class="formulario__boton">
                            <input class="boton" type="button" onclick="window.location.href=\'../../../backend/logout.php\'" value="Logout" style="background-color:red;">
                        </div>';
            }
            if($_SESSION['estado'] == "C" || $_SESSION['estado'] == "D" | $_SESSION['estado'] == "G")
            {
                if($_SESSION['estado'] == "C")
                {
                    echo    '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width: min(60rem, 100%); margin: 3rem auto; text-align: center;">Actualmente estas en liste de espera, no tienes casillero asignado.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
                }
                elseif($_SESSION['estado'] == "D")
                {
                    echo    '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width: min(60rem, 100%); margin: 3rem auto; text-align: center;">Tu solicitud esta en proceso, en menos de 24 horas se te asignara un casillero.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
                }
                elseif($_SESSION['estado'] == "G")
                {
                    echo    '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width: min(60rem, 100%); margin: 3rem auto; text-align: center;">En este momento no tienes casillero asignado y ninguna solicitud pendiente, solicita un casillero.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
                }
                
                echo '  <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Nombre"> 
                            </div> 
                            <div class="info"> 
                                <span>Nombre: </span>'. ucfirst($_SESSION['nombre']) .'
                            </div> 
                        </div> 
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Apellido Paterno"> 
                            </div> 
                            <div class="info"> 
                                <span>Apellido Paterno: </span>' . ucfirst($_SESSION['paterno']) .'
                            </div> 
                        </div> 
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/user.png" alt="Apellido Materno"> 
                            </div> 
                            <div class="info"> 
                                <span>Apellido Materno: </span>' . ucfirst($_SESSION['materno']) .'
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/fingerprint.png" alt="Boleta"> 
                            </div> 
                            <div class="info"> 
                                <span>Boleta: </span>' . $_SESSION['boleta'] .'
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/schedule.png" alt="Semestre"> 
                            </div> 
                            <div class="info"> 
                                <span>Semestre: </span>  2025-1
                            </div>
                        </div>
                        <div class="card"> 
                            <div class="icon"> 
                                <img src="../../img/height.png" alt="Estatura"> 
                            </div> 
                            <div class="info"> 
                                <span>estatura: </span>' . $_SESSION['estatura'] .'
                            </div>
                        </div>';

                echo    '<div class="formulario__boton">
                            <input class="boton" type="button" onclick="window.location.href=\'../../../backend/logout.php\'" value="Logout" style="background-color:red;">
                        </div>';
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/tbs.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b0411e9f37.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    
    <title>Solicitud</title>
</head>
<body>
    <header class="header">
        <h1 class="header__titulo centrar-texto"><span></span>LOCKER <span>ESCOM</span></h1>
        <img src="img/menu-resp.png" alt="Burger-Menu" class="menu-resp">
    </header>
    
    <nav class="nav">
        <div class="nav__barra contenedor">
            <a class="nav__enlace" href="index.php">Inicio</a>
            <a class="nav__enlace boton--seleccion" href="solicitud.php">Solicitud</a>
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
    <main>
        <section class="contenedor sombra">
        <h2 class="titulo-form">¡Solicita tu casillero!</h2>
        <!--Manejo de notificaciones-->
        <?php
            require "notificaciones.php";
            if(!empty($_GET) && isset($_GET['notif']))
            {
                global $notificaciones;
                echo $notificaciones[$_GET['notif']];
                ?>
                <script> //Cierre automático de la notificación
                    setTimeout(function()
                    { 
                        var alertElement = document.querySelector('.alert'); 
                        var alertInstance = new bootstrap.Alert(alertElement); 
                        alertInstance.close(); 
                    }, 20000); 
                </script>
                <?php
            }
        ?>
        
        <form action="../backend/solicitud.php" class="formulario" method="POST" name="solicitud" id="solicitud" enctype="multipart/form-data">
            <fieldset>
                <legend>Llena la siguiente solicitud:</legend>
                <div class="formulario__campo">
                    <label for="tipoSolicitud">Tipo de solicitud</label>
                    <select name="tipoSolicitud" name="tipoSolicitud" id="tipoSolicitud" requiered>
                        <option value="0" disabled selected>--Seleccionar--</option>
                        <option value="1">renovación</option>
                        <option value="2">primera vez</option>
                    </select>
                </div>
                <div class="contenedor-campos">
                    <div class="formulario__campo">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" required placeholder="Ejemplo: Juan" >
                    </div>
                    <div class="formulario__campo">
                        <label for="paterno">Apellido Paterno</label>
                        <input type="text" name="paterno" id="paterno" required placeholder="Ejemplo: Perez">
                    </div>
                    <div class="formulario__campo">
                        <label for="materno">Apellido Materno</label>
                        <input type="text" name="materno" id="materno" placeholder="Ejemplo: Martinez">
                    </div>
                    <div class="formulario__campo">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" name="telefono" id="telefono" placeholder="Ejemplo: 5512345678">
                    </div>
                    <div class="formulario__campo">
                        <label for="estatura">Estatura</label>
                        <input type="number" name="estatura" id="estatura" step="0.01" min="0" max="2.55" required placeholder="Ejemplo : 1.71 m">
                    </div>
                    <div class="formulario__campo">
                        <label for="correo">Correo Institucional</label>
                        <input type="email" name="correo" id="correo" required placeholder="Ejemplo: jperezm2100@alumno.ipn.mx">
                    </div>
                    <div class="formulario__campo">
                        <label for="boleta">Boleta</label>
                        <input type="tel" name="boleta" id="boleta" required placeholder="Ejemplo: 2020631324">
                    </div>
                    
                    <div class="formulario__campo">
                        <label for="casillero" id="label-casillero">Casillero anterior</label>
                        <input type="tel" name="casillero" id="casillero" placeholder="Ejemplo: 17">
                    </div>

                    <div class="formulario__campo">
                        <label for="credencial" >Credencial IPN</label>
                        <label for="credencial" class="botonArchivo">Subir archivo</label>
                        <input type="file" name="credencial" id="credencial" accept="application/pdf" required style="display:none;">
                        <span id="nombreArchivo1">Ningún archivo seleccionado</span>
                    </div>
                    <div class="formulario__campo">
                        <label for="horario">Horario</label>
                        <label for="horario" class="botonArchivo">Subir archivo</label>
                        <input type="file" name="horario" id="horario" accept="application/pdf" required style="display:none;">
                        <span id="nombreArchivo2">Ningún archivo seleccionado</span>
                    </div>
                    <div class="formulario__campo">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" required placeholder="Ejemplo: juan-PM_17">
                    </div>
                    <div class="formulario__campo">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" required placeholder="Ejemplo: Juanperez17.">
                    </div>
                </div>
                <div class="formulario__boton">
                    <input class="boton" type="reset" value="Limpiar">
                    <input class="boton" type="button" value="Registrar" id="registrar">
                </div>
            </fieldset>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmación de datos:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="outputModal">
                            <div class="output">
                                <label for="mNombre">Nombre: </label>
                                <output type="text" id="mNombre">...</output>
                            </div>
                             <div class="output">
                                <label for="mPaterno">Paterno: </label>
                                <output type="text" id="mPaterno">...</output>
                            </div>
                            <div class="output">
                                <label for="mMaterno">Materno: </label>
                                <output type="text" id="mMaterno">...</output>
                            </div>
                            <div class="output">
                                <label for="mTelefono">Teléfono: </label>
                                <output type="text" id="mTelefono">...</output>
                            </div>
                            <div class="output">
                                <label for="mEstatura">Estatura </label>
                                <output type="text" id="mEstatura">...</output>
                            </div>
                            <div class="output">
                                <label for="mCorreo">Correo: </label>
                                <output type="text" id="mCorreo">...</output>
                            </div>
                            <div class="output">
                                <label for="mBoleta">Boleta: </label>
                                <output type="text" id="mBoleta">...</output>
                            </div>
                            <div class="output">
                                <label for="mTipo">Tipo de Solicitud: </label>
                                <output type="text" id="mTipo">...</output>
                            </div>
                            <div class="output">
                                <label for="mCasillero">Casillero anterior: </label>
                                <output type="text" id="mCasillero">...</output>
                            </div>
                            <div class="output">
                                <label for="mCredencial">Credencial IPN: </label>
                                <output type="text" id="mCredencial">...</output>
                            </div>
                            <div class="output">
                                <label for="mHorario">Horario IPN: </label>
                                <output type="text" id="mHorario">...</output>
                            </div>
                            <div class="output">
                                <label for="mUsuario">Usuario: </label>
                                <output type="text" id="mUsuario">...</output>
                            </div>
                            <div class="output">
                                <label for="mPassword">Contraseña: </label>
                                <output type="text" id="mPassword">...</output>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Modificar</button>
                        <button type="submit" class="btn btn-primary" >Enviar</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
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
    <script src="js/er.js"></script>
    <script src="js/keydown.js"></script>
    <script src="js/tipoSolicitud.js"></script>
    <script src="js/archivos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
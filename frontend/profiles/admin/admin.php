<?php
    session_start();
    if(!isset($_SESSION['session']) || $_SESSION['session'] != 'admin')
    {
        header("location:../../admin.php?notif=200");
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
        #casilleros 
        {
            display: grid;
            gap: 5px;
            justify-items: center;
        }
        @media only screen and (min-width: 1200px)
        {
            #casilleros
            {
                grid-template-columns: repeat(25,1fr);
            }
        }
        @media only screen and (max-width: 1199px) and (min-width: 992px)
        {
            #casilleros
            {
                grid-template-columns: repeat(20,1fr);
            }
        }
        @media only screen and (max-width: 991px) and (min-width: 768px)
        {
            #casilleros
            {
                grid-template-columns: repeat(10,1fr);
            }
        }
        @media only screen and (max-width: 767px)
        {
            #casilleros
            {
                grid-template-columns: repeat(5,1fr);
            }
        }
        .casillero
        {
            width: 100%;
            padding-top: 100%;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .casillero .numero
        {
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 14px;
            font-weight: bold;
            text-shadow: 1px 1px 2px black;
        }
        .pendiente
        {
            background-image: url(../../../frontend/img/pendiente.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .ocupado
        {
            background-image: url(../../../frontend/img/ocupado.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .disponible
        {
            background-image: url(../../../frontend/img/disponible.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .pendiente:hover,
        .ocupado:hover,
        .disponible:hover
        {
            transform: scale(1.3,1.3);
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
            <a class="nav__enlace" href="../../acceso.php">Acceso</a>
            <a class="nav__enlace boton--seleccion" href="admin.php">Admin</a>
        </div> 
    </nav>
    <main>
        <section class="contenedor sombra" style="margin-bottom: 38rem;">
        <?php 
            echo '<h2 class="titulo-form"> Bienvenido @' . $_SESSION['usuario'] . '</h2>';
        ?>
        <!--Manejo de notificaciones-->
        <?php
            require "../../notificaciones.php";
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
        
        <div id="casilleros">
            <!-- Casilleros se llenarán dinámicamente -->
        </div>

        <!-- Modal structure -->
        <div class="modal fade" id="lockerModal" tabindex="-1" aria-labelledby="lockerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="lockerModalLabel">Detalles del Casillero</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalContent">
                        <!-- Modal content will be populated with JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="formulario__boton">
            <input class="boton" type="button" onclick="window.location.href='../../../backend/logoutA.php'" value="Logout" style="background-color:red;">
            <input class="boton" type="button" onclick="window.location.href='../../solicitud.php'" value="Registrar">
        </div>
        </section>
        
    </main>
    <footer>
        <div class="footer contenedor" >
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
    <script>
    document.addEventListener("DOMContentLoaded", function(){
        //Obtención de datos json con AJAX
        $.ajax
        ({
            url: '../../../backend/profiles/admin/obtenerDatos.php',
            type: 'GET',
            success:function(data) //Se pasa como parametro los datos JSON obtenidos en obtenerDatos.php
                    {
                        var contenedorCasilleros = document.getElementById('casilleros');
                        //var alumnosConCasillero = data.alumnosConCasillero;
                        var alumnosSinCasillero = data.alumnosSinCasillero;
                        var casilleros = data.casilleros;
                        
                        casilleros.forEach(function(casillero)  //Casillero representa una instancia de la variable casilleros
                        {
                            var casilleroDiv = document.createElement('div');
                            if(casillero.asignado == 1 && casillero.pagado == 0)
                            {
                                casilleroDiv.className = 'casillero pendiente';
                            }
                            else if(casillero.asignado == 1 && casillero.pagado == 1)
                            {
                                casilleroDiv.className = 'casillero ocupado';
                            }
                            else
                            {
                                casilleroDiv.className = 'casillero disponible';
                            }
                            casilleroDiv.setAttribute('data-id', casillero.idCasillero);
                            casilleroDiv.setAttribute('data-asignado', casillero.asignado);

                            var numeroDiv = document.createElement('div');
                            numeroDiv.className = 'numero';
                            numeroDiv.textContent = casillero.idCasillero;
                            casilleroDiv.appendChild(numeroDiv);

                            if(casillero.asignado)
                            {
                                casilleroDiv.setAttribute('data-propietario', casillero.nombre + ' ' + casillero.paterno + ' ' + casillero.materno);
                                casilleroDiv.setAttribute('data-pagado',casillero.pagado);
                                casilleroDiv.setAttribute('data-propietarioBoleta', casillero.boleta);
                                casilleroDiv.setAttribute('data-estado',casillero.estado);
                                casilleroDiv.setAttribute('data-idPropietario',casillero.idPersona)
                                casilleroDiv.setAttribute('data-comprobantePago',casillero.comprobantePago);
                                casilleroDiv.setAttribute('data-credencial',casillero.credencial)
                                casilleroDiv.setAttribute('data-horario',casillero.horario);

                            }

                            casilleroDiv.addEventListener('click', function()
                            {
                                var asignado = this.getAttribute('data-asignado');
                                var modalContenido = '';

                                if(asignado == "0") //Si la instancia de casillero esta libre
                                {
                                    if(alumnosSinCasillero != null)
                                    {
                                        modalContenido = 'Selecciona un alumno para asignar este casillero: ';
                                        alumnosSinCasillero.forEach(function(alumno)   //Alumno representa una instancia de alumnosSinCasillero
                                        {
                                            modalContenido += '<button style="margin: 5px 0;" class="btn btn-outline-dark" onclick="asignarCasillero(' +casillero.idCasillero + ', ' + alumno.boleta + ')">' + alumno.boleta + ' | ' + alumno.nombre + ' ' + alumno.paterno + ' ' + alumno.materno + ' | ' + alumno.estatura + ' cm</button>';
                                            modalContenido += '<button style="margin: 5px 5px;" class="btn btn-outline-primary" onclick="mostrarCredencial(\'' + alumno.credencial + '\')"> Credencial </button>';
                                            modalContenido += '<button style="margin: 5px 0;" class="btn btn-outline-warning" onclick="mostrarHorario(\'' + alumno.horario + '\')"> Horario </button><br>';
                                        });
                                    }
                                    else
                                    {
                                        modalContenido += 'No hay alumnos por asignar ';
                                    }
                                }
                                else //Si la instancia de casillero esta ocupada
                                {
                                    var propietario = this.getAttribute('data-propietario'); //Se obtiene de los atributos que asignó previamente en casillero.forEach
                                    var pagado = this.getAttribute('data-pagado');
                                    var boleta = this.getAttribute('data-propietarioBoleta');
                                    var comprobantePago = this.getAttribute('data-comprobantePago');
                                    var credencial = this.getAttribute('data-credencial');
                                    var horario = this.getAttribute('data-horario');

                                    if(pagado == "1") //Si el casillero esta pagado
                                    {
                                        modalContenido = 'Información del casillero: <br>';
                                        modalContenido += 'Propietario: ' + propietario + '<br>';
                                        modalContenido += 'boleta: ' + boleta + '<br>';
                                        modalContenido += 'semestre: 2024/2025-2 (febrero-agosto)';
                                        modalContenido += '<br><br><button class="btn btn-outline-success" onclick="mostrarComprobantePago(\'' + comprobantePago + '\')">Comprobante de pago</button>';
                                        modalContenido += '<button style="margin: 5px 5px;" class="btn btn-outline-primary" onclick="mostrarCredencial(\'' + credencial + '\')"> Credencial </button>';
                                        modalContenido += '<button style="margin: 5px 0;" class="btn btn-outline-warning" onclick="mostrarHorario(\'' + horario + '\')"> Horario </button>';
                                        modalContenido += '<button style="margin: 5px 5px;" class="btn btn-danger" onclick="liberarCasillero(' + casillero.idCasillero + ', ' + boleta + ')">Liberar casillero</button>';
                                    }
                                    else //Si el casillero no esta pagado          AQUI CHECAR EN QUE ESTADO ESTA Y MOSTRAR DISTINTO MODAL, AGREGUÉ ESTADO A CASILLERO
                                    {
                                        var comprobantePago = this.getAttribute('data-comprobantePago');
                                        var estado = this.getAttribute('data-estado');
                                        var idPersona = this.getAttribute('data-idPropietario');
                                        modalContenido = 'Infomación del casillero: <br>';

                                        if(estado == "B")
                                        {
                                            modalContenido += 'El alumno ' + propietario  + ' con boleta [' + boleta + '] aun no acepta términos y condiciones.';
                                            modalContenido += '<br><br><button style="margin: 5px 5px;" class="btn btn-danger" onclick="liberarCasillero(' + casillero.idCasillero + ', ' + boleta + ')">Liberar casillero</button>';
                                        }
                                        else if(estado == "E")
                                        {
                                            modalContenido += 'El alumno ' + propietario  + ' con boleta [' + boleta + '] aun no sube comprobante de pago.'; 
                                            modalContenido += '<br><br><button style="margin: 5px 5px;" class="btn btn-danger" onclick="liberarCasillero(' + casillero.idCasillero + ', ' + boleta + ')">Liberar casillero</button>';
                                        }
                                        else if(estado == "I")
                                        {
                                            modalContenido += 'El alumno ' + propietario  + ' con boleta [' + boleta + '] aun no solicita renovar su casillero con número: ' + this.getAttribute('data-id'); 
                                            modalContenido += '<br><br><button style="margin: 5px 5px;" class="btn btn-danger" onclick="liberarCasillero(' + casillero.idCasillero + ', ' + boleta + ')">Liberar casillero</button>';
                                        }
                                        else if (estado == "F")
                                        {
                                            modalContenido += 'propietario: ' + propietario + '<br>';
                                            modalContenido += 'boleta: ' + boleta + '<br>';
                                            modalContenido += 'semestre: 2024/2025-2 (febrero-agosto)' + '<br><br><br>';
                                            modalContenido += '<button class="btn btn-primary" onclick="mostrarComprobantePago(\'' + comprobantePago + '\')">Mostrar comprobante</button>';
                                            modalContenido += '<button class="btn btn-success" onclick="aceptarPago(' + casillero.idCasillero + ', ' + boleta + ')" style="margin: 0 5px;">Aceptar pago</button>';
                                            modalContenido += '<button class="btn btn-danger" onclick="rechazarPago(' + casillero.idCasillero + ', ' + boleta + ')">Rechazar pago</button>';
                                        }

                                    }
                                }
                                document.getElementById('modalContent').innerHTML = modalContenido;
                                $('#lockerModal').modal('show');
                            });
                            contenedorCasilleros.appendChild(casilleroDiv);
                        });
                    },
            error:  function(error)
                    {
                        alert('No hay Alumnos registrados :(');
                    }
        });
    });
    //Funciones
    function asignarCasillero(idCasillero,idPersona)
    {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '../../../backend/profiles/admin/asignarCasillero.php';

        var inputCasillero = document.createElement('input');
        inputCasillero.type = 'hidden';
        inputCasillero.name = 'idCasilleroAsignar';
        inputCasillero.value = idCasillero;

        var inputAlumno = document.createElement('input');
        inputAlumno.type = 'hidden';
        inputAlumno.name = 'inputAlumnoAsignar';
        inputAlumno.value = idPersona;

        form.appendChild(inputCasillero);
        form.appendChild(inputAlumno);
        document.body.appendChild(form);
        form.submit();
    }

    function aceptarPago(idCasillero,boleta)
    {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '../../../backend/profiles/admin/aceptarPago.php';

        var inputCasillero = document.createElement('input');
        inputCasillero.type = 'hidden';
        inputCasillero.name = 'idCasilleroAceptar';
        inputCasillero.value = idCasillero;

        var inputBoleta = document.createElement('input');
        inputBoleta.type = 'hidden';
        inputBoleta.name = 'inputAlumnoAceptar';
        inputBoleta.value = boleta;

        form.appendChild(inputCasillero);
        form.appendChild(inputBoleta);
        document.body.appendChild(form);
        form.submit();
    }

    function rechazarPago(idCasillero,idPersona)
    {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '../../../backend/profiles/admin/rechazarPago.php';

        var inputCasillero = document.createElement('input');
        inputCasillero.type = 'hidden';
        inputCasillero.name = 'idCasilleroRechazar';
        inputCasillero.value = idCasillero;

        var inputAlumno = document.createElement('input');
        inputAlumno.type = 'hidden';
        inputAlumno.name = 'inputAlumnoRechazar';
        inputAlumno.value = idPersona;

        form.appendChild(inputCasillero);
        form.appendChild(inputAlumno);
        document.body.appendChild(form);
        form.submit();
    }

    function liberarCasillero(idCasillero,idPersona) 
    {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '../../../backend/profiles/admin/liberarCasillero.php';

        var inputCasillero = document.createElement('input');
        inputCasillero.type = 'hidden';
        inputCasillero.name = 'idCasilleroLiberar';
        inputCasillero.value = idCasillero;

        var inputAlumno = document.createElement('input');
        inputAlumno.type = 'hidden';
        inputAlumno.name = 'inputAlumnoLiberar';
        inputAlumno.value = idPersona;

        form.appendChild(inputCasillero);
        form.appendChild(inputAlumno);
        document.body.appendChild(form);
        form.submit();
    }

    function mostrarComprobantePago(comprobantePagoPath)
    {
        window.open('../../../backend/'+comprobantePagoPath, '_blank');
    }
    function mostrarCredencial(credencialPath)
    {
        window.open('../../../backend/'+credencialPath, '_blank');
    }
    function mostrarHorario(horarioPath)
    {
        window.open('../../../backend/'+horarioPath, '_blank');
    }
</script>
</body>
</html>

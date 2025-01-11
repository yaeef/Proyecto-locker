<?php 
    require "../db/conection/conection.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST["tipoSolicitud"] == 2) //Si es registro por primera vez
        {
            #VERIFICACIÓN DE EXISTENCIA DE DATOS
            if(!isset($_POST['nombre'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['paterno'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['materno'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['telefono'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['estatura'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['correo'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['boleta'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_FILES['credencial'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_FILES['horario'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['usuario'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['password'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}

            $conexion = conectarBD();
            $existeBoleta = evaluarExistencia($conexion,$_POST['boleta'],'boleta');
            $existeCorreo = evaluarExistencia($conexion,$_POST['correo'],'correo');
            $existeUsuario = evaluarExistencia($conexion,$_POST['usuario'],'usuario');
            $existenCasilleros = evaluarDisponibilidadCasilleros($conexion);

            if($existeBoleta)//Ya existe la boleta
            {
                desconectarBD($conexion);
                header("location:../frontend/solicitud.php?notif=1");
                exit();
            }
            else
            {
                if($existeCorreo)//Ya existe el correo
                {
                    desconectarBD($conexion);
                    header("location:../frontend/solicitud.php?notif=2");
                    exit();
                }
                else
                {
                    if($existeUsuario)//Ya existe el usuario
                    {
                        desconectarBD($conexion);
                        header("location:../frontend/solicitud.php?notif=3");
                        exit();
                    }
                    else
                    {
                        $error = insertarEstadoInicialA($conexion);  //Inserción de solicitud en estado A | USUARIO NUEVO
                        if($error)
                        {
                            desconectarBD($conexion);
                            header("location:../frontend/solicitud.php?notif=-1");
                            exit();
                        }

                        if($existenCasilleros)//Si hay casilleros
                        {
                            $error = transicionAD($conexion,trim($_POST['boleta'])); //Transición A->D
                            if(!$error)
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=0");
                                exit();
                            }
                            else
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=-1");
                                exit();
                            }
                        }
                        else//Si no hay casilleros
                        {
                            $error = transicionAC($conexion,trim($_POST['boleta'])); //Transición A->C
                            if(!$error)
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=4");
                                exit();
                            }
                            else
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=-1");
                                exit();
                            }
                        }
                    }
                }
            }
        }
        elseif($_POST["tipoSolicitud"] == 1) //Si es registro por renovacion
        {
            #VERIFICACIÓN DE EXISTENCIA DE DATOS
            if(!isset($_POST['nombre'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['paterno'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['materno'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['telefono'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['estatura'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['correo'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['boleta'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['casillero'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_FILES['credencial'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_FILES['horario'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['usuario'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}
            if(!isset($_POST['password'])) {header("location:../frontend/solicitud.php?notif=-3"); exit();}


            $conexion = conectarBD();
            $existeBoleta = evaluarExistencia($conexion,$_POST['boleta'],'boleta');
            $existeCorreo = evaluarExistencia($conexion,$_POST['correo'],'correo');
            $existeUsuario = evaluarExistencia($conexion,$_POST['usuario'],'usuario');
            $existenCasilleros = evaluarDisponibilidadCasilleros($conexion);
            $casilleroDisponible = disponibleCasillero($conexion,$_POST['casillero']);
            


            if($existeBoleta)//Si existe boleta
            {
                $alumno = recuperarAlumno($conexion,$_POST['boleta']); //Alumno recuperado de la BD para comprobación de campos
                $identificadorAlumno = $alumno['idPersona'];
                $estadoAlumno = identificarEstado($conexion,$alumno['boleta']);

                
                if($estadoAlumno == 'I')//Si el alumno se encuentra en estado I
                {
                    //Obtener Casillero
                    $identificadorCasillero = identificarCasillero($conexion,$identificadorAlumno);
                    if($identificadorCasillero == $_POST['casillero'])//Si el casillero coincide
                    {
                        if($_POST['usuario'] == $alumno['usuario'])//Si coincide usuario
                        {
                            if($_POST['correo'] == $alumno['correo'])//Si coincide el correo
                            {
                                if(password_verify($_POST['password'], $alumno['contrasena']))//Si coincide la contraseña 
                                {
                                    $error = transicionIE($conexion,trim($_POST['boleta'])); //Transición I->E
                                    if(!$error)
                                    {
                                        desconectarBD($conexion);
                                        header("location:../frontend/solicitud.php?notif=10");
                                        exit();
                                    }
                                    else
                                    {
                                        desconectarBD($conexion);
                                        header("location:../frontend/solicitud.php?notif=-1");
                                        exit();
                                    }
                                }
                                else//Contraseña incorrecta
                                {
                                    desconectarBD($conexion);
                                    header("location:../frontend/solicitud.php?notif=9");
                                    exit();
                                }
                            }
                            else//Correo incorrecto
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=8");
                                exit();
                            }
                        }
                        else//Usuario incorrecto
                        {
                            desconectarBD($conexion);
                            header("location:../frontend/solicitud.php?notif=7");
                            exit();
                        }
                    }
                    else//Casillero incorrecto
                    {
                        desconectarBD($conexion);
                        header("location:../frontend/solicitud.php?notif=13");
                        exit();
                    }
                    
                }
                elseif($estadoAlumno == 'G')//Si el alumno se encuentra en estado G
                {
                    if($_POST['usuario'] == $alumno['usuario'])//Si coincide usuario
                    {
                        if($_POST['correo'] == $alumno['correo'])//Si coincide el correo
                        {
                            if(password_verify($_POST['password'], $alumno['contrasena']))//Si coincide la contraseña
                            {
                                $error = transicionGA($conexion,trim($_POST['boleta'])); //Transición G->A
                                if($error)
                                {
                                    desconectarBD($conexion);
                                    header("location:../frontend/solicitud.php?notif=-1");
                                    exit();
                                }
                                if($existenCasilleros)//Si hay casilleros
                                {
                                    $error = transicionAD($conexion,trim($_POST['boleta'])); //Transición A->D
                                    if(!$error)
                                    {
                                        desconectarBD($conexion);
                                        header("location:../frontend/solicitud.php?notif=11");
                                        exit();
                                    }
                                    else
                                    {
                                        desconectarBD($conexion);
                                        header("location:../frontend/solicitud.php?notif=-1");
                                        exit();
                                    }
                                }
                                else//Si no hay casilleros
                                {
                                    $error = transicionAC($conexion,trim($_POST['boleta'])); //Transición A->C
                                    if(!$error)
                                    {
                                        desconectarBD($conexion);
                                        header("location:../frontend/solicitud.php?notif=12");
                                        exit();
                                    }
                                    else
                                    {
                                        desconectarBD($conexion);
                                        header("location:../frontend/solicitud.php?notif=-1");
                                        exit();
                                    }
                                }
                            }
                            else//Contraseña incorrecta
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=9");
                                exit();
                            }
                        }
                        else//Correo incorrecto
                        {
                            desconectarBD($conexion);
                            header("location:../frontend/solicitud.php?notif=8");
                            exit();
                        }
                    }
                    else//Usuario incorrecto
                    {
                        desconectarBD($conexion);
                        header("location:../frontend/solicitud.php?notif=7");
                        exit();
                    }
                }
                else//Si el alumno se encuentra en algun otro estado que no requiere renovación
                {
                    desconectarBD($conexion);
                    header("location:../frontend/solicitud.php?notif=6");
                    exit();
                }
            }
            else//Si no existe boleta
            {
                if($existeUsuario)//Ya existe el usuario pero no la boleta
                {
                    desconectarBD($conexion);
                    header("location:../frontend/solicitud.php?notif=3");
                    exit();
                }
                else
                {
                    if($existeCorreo)//Ya existe el correo pero no la boleta
                    {
                        desconectarBD($conexion);
                        header("location:../frontend/solicitud.php?notif=2");
                        exit();
                    }
                    else
                    {
                        if($casilleroDisponible && $existenCasilleros)//Si esta disponible el casillero seleccionado y existen espacios 
                        {
                            $error = insertarEstadoInicialE($conexion); //Función de insercion en estado inicial E | POBLACIÓN DE BD
                            if(!$error)
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=0");
                                exit();
                            }
                            else
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=-1");
                                exit();
                            }
                        }
                        else
                        {
                            $error = insertarEstadoInicialA($conexion);  //Inserción de solicitud en estado A | USUARIO NUEVO
                            if($error)
                            {
                                desconectarBD($conexion);
                                header("location:../frontend/solicitud.php?notif=-1");
                                exit();
                            }

                            if($existenCasilleros)//Si hay casilleros
                            {
                                $error = transicionAD($conexion,trim($_POST['boleta'])); //Transición A->D
                                if(!$error)
                                {
                                    desconectarBD($conexion);
                                    header("location:../frontend/solicitud.php?notif=0");
                                    exit();
                                }
                                else
                                {
                                    desconectarBD($conexion);
                                    header("location:../frontend/solicitud.php?notif=-1");
                                    exit();
                                }
                            }
                            else//Si no hay casilleros
                            {
                                $error = transicionAC($conexion,trim($_POST['boleta'])); //Transición A->C
                                if(!$error)
                                {
                                    desconectarBD($conexion);
                                    header("location:../frontend/solicitud.php?notif=4");
                                    exit();
                                }
                                else
                                {
                                    desconectarBD($conexion);
                                    header("location:../frontend/solicitud.php?notif=-1");
                                    exit();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    else
    {
        header("location:../frontend/solicitud.php?notif=-2"); //Método POST no detectado, denegar acceso
        exit();
    }
?>

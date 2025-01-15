/*Revision de campos antes de submit mediante expresiones regulares*/

var btnRegistrar = document.getElementById("registrar");

btnRegistrar.addEventListener("click", () =>
{
    var tipoSolicitud = document.forms.solicitud.tipoSolicitud.value;
    var nombre = document.forms.solicitud.nombre.value;
    var paterno = document.forms.solicitud.paterno.value;
    var materno = document.forms.solicitud.materno.value;
    var telefono = document.forms.solicitud.telefono.value;
    var estatura = document.forms.solicitud.estatura.value;
    var email = document.forms.solicitud.correo.value;
    var boleta = document.forms.solicitud.boleta.value;
    var casillero = document.forms.solicitud.casillero.value;
    var credencial = document.forms.solicitud.credencial.value;
    var horario = document.forms.solicitud.horario.value;
    var usuario = document.forms.solicitud.usuario.value;
    var password = document.forms.solicitud.password.value;

    var erCorreo = /^[a-zA-Z0-9._-]+@alumno\.ipn\.mx$/;
    var erBoleta = /^20\d{8}$/;
    var erTelefono = /^\d{10}$/;
    var erEstatura = /^(1(\.\d{1,2})?|2(\.([0-4][0-9]|5[0-5]))?)$/;
    var erNombres = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s']+$/;
    var erCasillero = /^(100|[1-9]?[0-9])$/; //Revisar porque acepta el cero
    var erArchivo = /\.pdf$/i;
    var erUsuarioL = /^.{6,}$/;
    var erUsuarioF = /^[a-zA-Z0-9_-]+$/;
    var erPasswordM = /(?=.*[A-Z])/;
    var erPasswordm = /(?=.*[a-z])/;
    var erPasswordD= /(?=.*\d)/;
    var erPasswordL = /^.{8,20}$/;

    if(tipoSolicitud == 0)
    {
        document.getElementById("tipoSolicitud").setAttribute("style","border:solid; border-color: tomato;");
        alert("No has seleccionado el tipo de solicitud");
        return;
    }
    else
    {
        document.getElementById("tipoSolicitud").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erNombres.test(nombre))
    {
        document.getElementById("nombre").setAttribute("style","border:solid; border-color: tomato;");
        alert("El nombre ingresado no es válido.");
        return;
    }
    else
    {
        document.getElementById("nombre").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erNombres.test(paterno))
    {
        document.getElementById("paterno").setAttribute("style","border:solid; border-color: tomato;");
        alert("El apellido paterno ingresado no es válido.");
        return;
    }
    else
    {
        document.getElementById("paterno").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erNombres.test(materno))
    {
        document.getElementById("materno").setAttribute("style","border:solid; border-color: tomato;");
        alert("El apellido materno ingresado no es válido.");
        return;
    }
    else
    {
        document.getElementById("materno").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erTelefono.test(telefono))
    {
        document.getElementById("telefono").setAttribute("style","border:solid; border-color: tomato;");
        alert("EL número de teléfono no es válido");
        return;
    }
    else
    {
        document.getElementById("telefono").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }

    if(!erEstatura.test(estatura))
    {
        document.getElementById("estatura").setAttribute("style","border:solid; border-color: tomato;");
        alert("El valor de la estatura debe estar entre 1m y 2.55m");
        return;
    }
    else
    {
        document.getElementById("estatura").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }


    if(!erCorreo.test(email))
    {
        document.getElementById("correo").setAttribute("style","border:solid; border-color: tomato;");
        alert("El correo no pertenece al IPN.");
        return;
    }
    else
    {
        document.getElementById("correo").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erBoleta.test(boleta))
    {
        document.getElementById("boleta").setAttribute("style","border:solid; border-color: tomato;");
        alert("El número de boleta no pertenece al IPN");
        return;
    }
    else
    {
        document.getElementById("boleta").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(tipoSolicitud == 1) //Si es renovación
    {
        if(!erCasillero.test(casillero))
        {
            document.getElementById("casillero").setAttribute("style","border:solid; border-color: tomato;");
            alert("El número de casillero debe estar entre 1 y 100");
            return;
        }
        else
        {
            document.getElementById("casillero").setAttribute("style","border:solid; border-color: #AEDD2B;");
        }

    }
    if(!erArchivo.test(credencial))
    {
        alert("El archivo de la credencial no es válido.");
        return;
    }
    if(!erArchivo.test(horario))
    {
        alert("El archivo del horario no es válido.");
        return;
    }
    if(!erUsuarioL.test(usuario))
    {
        document.getElementById("usuario").setAttribute("style","border:solid; border-color: tomato;");
        alert("El nombre de usuario debe contener al menos 6 caracteres");
        return;
    }
    else
    {
        document.getElementById("usuario").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erUsuarioF.test(usuario))
    {
        document.getElementById("usuario").setAttribute("style","border:solid; border-color: tomato;");
        alert("El usuario solo debe contener letras, números y/o guiones");
        return;
    }
    else
    {
        document.getElementById("usuario").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erPasswordM.test(password))
    {
        document.getElementById("password").setAttribute("style","border:solid; border-color: tomato;");
        alert("La contraseña debe contener al menos una letra MAYUSCULA");
        return;
    }
    else
    {
        document.getElementById("password").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erPasswordm.test(password))
    {
        document.getElementById("password").setAttribute("style","border:solid; border-color: tomato;");
        alert("La contraseña debe contener al menos una letra minuscula");
        return;
    }
    else
    {
        document.getElementById("password").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erPasswordD.test(password))
    {
        document.getElementById("password").setAttribute("style","border:solid; border-color: tomato;");
        alert("La contraseña debe contener al menos un dígito");
        return;
    }
    else
    {
        document.getElementById("password").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    if(!erPasswordL.test(password))
    {
        document.getElementById("password").setAttribute("style","border:solid; border-color: tomato;");
        alert("La contraseña debe contener entre 8 y 20 caracteres");
        return;
    }
    else
    {
        document.getElementById("password").setAttribute("style","border:solid; border-color: #AEDD2B;");
    }
    //Si no hay algun return entonces muestra el modal al haber algun cambio en el boton registrar

    document.getElementById("mNombre").innerHTML = nombre;
    document.getElementById("mPaterno").innerHTML = paterno;
    document.getElementById("mMaterno").innerHTML = materno;
    document.getElementById("mTelefono").innerHTML = telefono;
    document.getElementById("mEstatura").innerHTML = estatura;
    document.getElementById("mCorreo").innerHTML = email;
    document.getElementById("mBoleta").innerHTML = boleta;

    if(tipoSolicitud == 0)
    {
        document.getElementById("mTipo").innerHTML = "Sin seleccionar";
    }
    else if(tipoSolicitud == 1)
    {
        document.getElementById("mTipo").innerHTML = "Renovación";
    }
    else
    {
        document.getElementById("mTipo").innerHTML = "Primera vez";
    }
    
    document.getElementById("mCasillero").innerHTML = casillero;
    document.getElementById("mCredencial").innerHTML = credencial;
    document.getElementById("mHorario").innerHTML = horario;
    document.getElementById("mUsuario").innerHTML = usuario;
    document.getElementById("mPassword").innerHTML = password;
    var miModal = new bootstrap.Modal(document.getElementById("staticBackdrop"));
    miModal.show();
    
  });

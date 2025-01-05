var credencial = document.getElementById("credencial");
var horario = document.getElementById("horario");
var nombreArchivo1 = document.getElementById("nombreArchivo1");
var nombreArchivo2 = document.getElementById("nombreArchivo2");

credencial.addEventListener("change", () =>
{
    if(credencial.files.length > 0)
    {
        nombreArchivo1.textContent = credencial.files[0].name;
    }
    else
    {
        nombreArchivo1.textContent = "Ningún archivo seleccionado";
    }
    
});

horario.addEventListener("change", () =>
{
    if(horario.files.length > 0)
    {
        nombreArchivo2.textContent = horario.files[0].name;
    }
    else
    {
        nombreArchivo2.textContent = "Ningún archivo seleccionado";
    }
});

    
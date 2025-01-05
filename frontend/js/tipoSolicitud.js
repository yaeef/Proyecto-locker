var tipoSolicitud = document.getElementById("tipoSolicitud");

tipoSolicitud.addEventListener("change", () =>
{
    var tipo = tipoSolicitud.value;
    if(tipo == 2) //SIN ANTECEDENTES
    {
        document.getElementById("casillero").style.display = "none";
        document.getElementById("label-casillero").style.display = "none"
        document.getElementById("casillero").removeAttribute("required");
    }
    else         
    {
        document.getElementById("casillero").style.display = "block";
        document.getElementById("label-casillero").style.display = "block";
        document.getElementById("casillero").setAttribute("required","");
    }

});
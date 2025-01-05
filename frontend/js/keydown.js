/*Se anula la funcionalidad de enter para evitar submit sin mostrar modal*/

var formulario = document.getElementById("solicitud");

formulario.addEventListener('keydown', () =>
{
    if (event.key === 'Enter') 
    {
        event.preventDefault();  
    }
});
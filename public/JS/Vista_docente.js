// Función para copiar el código al portapapeles
function copyCode() {
    const code = document.getElementById('class-code').innerText;
    
    navigator.clipboard.writeText(code).then(() => {
        const btn = document.querySelector('.copy-btn');
        const originalText = btn.innerHTML;
        
        btn.innerHTML = '<i class="fa-solid fa-check"></i> ¡Copiado!';
        btn.style.background = "#2c7a7b";
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.background = "rgba(255, 255, 255, 0.2)";
        }, 2000);
    });
}

//  añadir lógica para borrar o editar
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        if(confirm('¿Estás seguro de eliminar a este estudiante?')) {
            btn.closest('.student-item').remove();
        }
    });
});
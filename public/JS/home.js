document.addEventListener("DOMContentLoaded", function () {
    // Scrolling suave en links de navegación
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            // Si el enlace es solo '#', ignorar
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (target) {
                // Cerrar menú móvil automáticamente si está abierto al hacer click
                const navbarCollapse = document.getElementById('navbarSortly');
                if(navbarCollapse && navbarCollapse.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if(bsCollapse) bsCollapse.hide();
                }

                // Ajustar scroll descontando la altura del header fijo
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Efecto visual dinámico al hacer scroll sobre el Header
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            header.style.backdropFilter = 'blur(10px)';
            header.style.boxShadow = '0 4px 6px -1px rgba(0,0,0,0.05)';
        } else {
            header.style.backgroundColor = '#ffffff';
            header.style.backdropFilter = '';
            header.style.boxShadow = '';
        }
    });
});
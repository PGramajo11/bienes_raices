document.addEventListener('DOMContentLoaded', function () {

    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    const temaGuardado = localStorage.getItem('tema'); // <-- Nuevo

    console.log(prefiereDarkMode.matches);

    // 🔹 1. Aplicar tema guardado, o detectar el del sistema
    if (temaGuardado) {
        document.body.classList.toggle('dark-mode', temaGuardado === 'oscuro');
    } else {
        document.body.classList.toggle('dark-mode', prefiereDarkMode.matches);
    }

    // 🔹 2. Escuchar cambios del sistema SOLO si el usuario no forzó uno manual
    prefiereDarkMode.addEventListener('change', function () {
        const tienePreferenciaUsuario = localStorage.getItem('tema');
        if (!tienePreferenciaUsuario) {
            document.body.classList.toggle('dark-mode', prefiereDarkMode.matches);
        }
    });

    // 🔹 3. Click del botón: alternar y guardar preferencia
    botonDarkMode.addEventListener('click', function () {
        const esOscuro = document.body.classList.toggle('dark-mode');
        localStorage.setItem('tema', esOscuro ? 'oscuro' : 'claro');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}


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

    //Muestra campos condicionales en formulario contacto
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero de Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]" required>

            <p>Elija fecha y hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu correo electronico" id="email" name="contacto[email]" required>
        `;
    }
}


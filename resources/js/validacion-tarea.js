document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        const titulo = document.getElementById('titulo').value;
        const descripcion = document.getElementById('descripcion').value;
        const scriptPattern = /<script\b[^>]*>(.*?)<\/script>/gi;

        let errores = [];

        if (!titulo.trim()) {
            errores.push("El título es obligatorio.");
        }

        if (titulo.length > 255) {
            errores.push("El título no puede tener más de 255 caracteres.");
        }

        if (descripcion.length > 1000) {
            errores.push("La descripción no puede tener más de 1000 caracteres.");
        }

        if (scriptPattern.test(titulo) || scriptPattern.test(descripcion)) {
            errores.push("No se permite insertar código malicioso.");
        }

        if (errores.length > 0) {
            e.preventDefault();
            alert(errores.join("\n"));
        }
    });
});

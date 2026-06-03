document.addEventListener('DOMContentLoaded', function() {
    const botonesEstado = document.querySelectorAll('.btn-estado');

    botonesEstado.forEach(boton => {
        boton.addEventListener('click', function() {
                    
            if (this.classList.contains('activo')) return;

            const contenedorPadre = this.closest('.btns-estado');
            const idTarea = contenedorPadre.getAttribute('data-id');
            const nuevoEstado = this.getAttribute('data-estado');

            const formData = new FormData();
            formData.append('id', idTarea);
            formData.append('estado', nuevoEstado);

            fetch(`/tareas/${idTarea}/estado`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.exito) {
                    const botonesHermanos = contenedorPadre.querySelectorAll('.btn-estado');
                    botonesHermanos.forEach(b => b.classList.remove('activo'));
                            
                    this.classList.add('activo');
                } else {
                    alert('Error: ' + (data.mensaje || 'No se pudo actualizar el estado.'));
                }
            })
            .catch(error => {
                console.error('Error AJAX:', error);
                alert('Hubo un problema de conexión con el servidor.');
            });
        });
    });
});

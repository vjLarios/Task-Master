// public/assets/js/app.js

document.addEventListener('DOMContentLoaded', () => {
  // 1) Filtro en tiempo real (buscador de tareas)
  const searchInput = document.querySelector('.search-container input[type="text"]');
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const text = searchInput.value.trim().toLowerCase();
      document.querySelectorAll('.card-container .card').forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        card.style.display = title.includes(text) ? '' : 'none';
      });
    });
    searchInput.focus();
  }

  // 2) Validación de formularios (vacíos + fecha)
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', e => {
      // Campos vacíos
      const emptyField = Array.from(form.querySelectorAll('.validable'))
        .find(el => el.value.trim() === '');
      if (emptyField) {
        e.preventDefault();
        Swal.fire({
          icon: 'error',
          title: 'Campo obligatorio',
          text: 'Por favor completa todos los campos requeridos.'
        });
        return;
      }

      // Fecha válida (YYYY-MM-DD)
      const dateInput = form.querySelector('#due_date');
      if (dateInput) {
        const val = dateInput.value.trim();
        const re = /^\d{4}-\d{2}-\d{2}$/;
        if (!re.test(val) || isNaN(new Date(val).getTime())) {
          e.preventDefault();
          Swal.fire({
            icon: 'error',
            title: 'Fecha inválida',
            text: 'Por favor ingresa una fecha en formato AAAA-MM-DD válida.'
          });
          return;
        }
      }
      // si pasa ambas, deja que el formulario se envíe
    });
  });

  // 3) DELETE vía fetch() con SweetAlert2
  document.querySelectorAll('[data-method="DELETE"]').forEach(el => {
    el.addEventListener('click', e => {
      e.preventDefault();
      const url = el.getAttribute('href') || el.dataset.url;
      Swal.fire({
        title: '¿Eliminar tarea?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then(result => {
        if (result.isConfirmed) {
          fetch(url, { method: 'DELETE' })
            .then(res => {
              // Si tu endpoint redirige, aquí fallará; ideal que devuelva JSON:
              return res.json ? res.json() : { success: true };
            })
            .then(data => {
              if (data.success !== false) {
                Swal.fire({
                  icon: 'success',
                  title: 'Eliminado',
                  text: data.message || 'Tarea eliminada.',
                  timer: 1200,
                  showConfirmButton: false
                }).then(() => window.location.reload());
              } else {
                Swal.fire('Error', data.message || 'No se pudo eliminar.', 'error');
              }
            })
            .catch(() => {
              Swal.fire('Error', 'Error de conexión', 'error');
            });
        }
      });
    });
  });
});

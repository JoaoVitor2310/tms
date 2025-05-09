document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const title = form.dataset.title || 'Deseja realmente excluir?';
        const text = form.dataset.text || 'Você não poderá reverter esta ação.';

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
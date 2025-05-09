document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.clickable-row').forEach(function (row) {
        row.addEventListener('click', function (e) {
            // Evita o clique se foi em um botão (editar/deletar)
            if (e.target.closest('a') || e.target.closest('form')) return;
            window.location.href = this.dataset.href;
        });
    });
});
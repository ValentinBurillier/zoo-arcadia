document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alert => {
        // Afficher l'alerte après un court délai
        setTimeout(() => {
            alert.classList.add('show');
        }, 100);

        // Disparition automatique après un délai
        setTimeout(() => {
            alert.classList.add('hide');
            setTimeout(() => {
                alert.remove();
            }, 300); // Délai de transition
        }, 5000); // 5 secondes
    });
});
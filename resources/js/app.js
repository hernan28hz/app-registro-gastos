import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const formatCopInput = (input) => {
    const digits = input.value.replace(/\D/g, '');
    input.value = digits ? new Intl.NumberFormat('es-CO').format(Number(digits)) : '';
};

document.querySelectorAll('[data-cop-input]').forEach((input) => {
    formatCopInput(input);

    input.addEventListener('input', () => formatCopInput(input));

    input.form?.addEventListener('submit', () => {
        input.value = input.value.replace(/\D/g, '');
    });
});

import Alpine from 'alpinejs';
import { createIcons, icons } from 'lucide';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });
});

// Re-run createIcons when Alpine mutates or on dynamic content
window.refreshIcons = () => {
    setTimeout(() => {
        createIcons({ icons });
    }, 50);
};

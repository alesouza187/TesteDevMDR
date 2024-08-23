import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



window.openModal = function(modalId) {
    document.getElementById(modalId).style.display = 'block'
    document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
}

window.closeModal = function(modalId) {
    document.getElementById(modalId).style.display = 'none'
    document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
}
document.onkeydown = function(event) {
    event = event || window.event;
    if (event.keyCode === 27) {
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        let modals = document.getElementsByClassName('modal');
        Array.prototype.slice.call(modals).forEach(i => {
            i.style.display = 'none'
        })
    }
};

const button = document.getElementById('status');
if (button) {
    button.onclick = function() {
        var checkbox = document.getElementById('status');
        var deleteStatus = document.getElementById('deleteStatus');
        deleteStatus.value = checkbox.checked ? 'true' : 'false';
    };
}


const formatter = new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
function mask(e) {
    const input = e.target;
    input.value = input.value.replace(/\D+/g, '');
    if (input.value.length === 0)
        return;
    const maxDigits = parseInt(input.dataset.maxDigits);
    if (input.value.length > maxDigits) {
        input.value = input.value.substring(0, maxDigits);
    }
    input.value = formatter.format(parseInt(input.value) / 100);
}

const inputElement = document.querySelector('#valor');
if (inputElement) {
    inputElement.addEventListener('input', mask);
}
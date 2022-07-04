require('./bootstrap');

//sweetalert2
import Swal from 'sweetalert2';
window.Swal = Swal;

window.addEventListener('confirm', event => {
    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('delete', event.detail.id);
        }
    });
});

//turbolinks
var Turbolinks = require("turbolinks")
Turbolinks.start()

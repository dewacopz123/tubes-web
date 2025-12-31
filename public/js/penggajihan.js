document.addEventListener('DOMContentLoaded', function () {

    const popup = document.getElementById('popupContainer');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    document.getElementById('btnAddPenggajian').addEventListener('click', function () {
        fetch('/penggajian/create')
            .then(res => res.text())
            .then(html => popup.innerHTML = html);
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.btnEdit')) {
            const id = e.target.closest('.btnEdit').dataset.id;

            fetch(`/penggajian/edit/${id}`)
                .then(res => res.text())
                .then(html => popup.innerHTML = html);
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.hasAttribute('data-close')) {
            popup.innerHTML = '';
        }
    });

    document.addEventListener('submit', function (e) {
        if (e.target.id === 'formPenggajian') {
            e.preventDefault();

            const formData = new FormData(e.target);
            const id = document.getElementById('penggajian_id')?.value;

            let url = '/penggajian/store';
            let method = 'POST';

            if (id) {
                url = `/penggajian/update/${id}`;
                method = 'POST';
                formData.append('_method', 'PUT');
            }

            fetch(url, {
                method: method,
                headers: { 'X-CSRF-TOKEN': csrf },
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                alert(res.message);
                location.reload();
            });
        }
    });

});

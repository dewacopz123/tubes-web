document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('popupContainer');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    // Open Create Modal
    document.getElementById('btnAddPenggajian')?.addEventListener('click', function () {
        fetch('/penggajian/create')
            .then(res => res.text())
            .then(html => popup.innerHTML = html);
    });

    // Open Edit Modal
    document.addEventListener('click', function (e) {
        if (e.target.closest('.btnEdit')) {
            const id = e.target.closest('.btnEdit').dataset.id;
            fetch(`/penggajian/edit/${id}`)
                .then(res => res.text())
                .then(html => popup.innerHTML = html);
        }
    });

    // Close Modal
    document.addEventListener('click', function (e) {
        if (e.target.hasAttribute('data-close')) popup.innerHTML = '';
    });

    // Submit Form Create/Update
    document.addEventListener('submit', function (e) {
        if (e.target.id === 'formPenggajian') {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const id = document.getElementById('penggajian_id')?.value;

            let url = '/penggajian/store';
            let method = 'POST';

            if (id) {
                url = `/penggajian/update/${id}`;
                formData.append('_method', 'PUT');
            }

            fetch(url, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf },
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                alert(res.message);
                location.reload(); // bisa diganti dengan update row table langsung
            })
            .catch(err => console.error(err));
        }
    });

    // Delete Penggajian
    document.addEventListener('click', function (e) {
        if (e.target.closest('.btnDelete')) {
            const id = e.target.closest('.btnDelete').dataset.id;
            if (!confirm('Yakin ingin menghapus data ini?')) return;

            fetch(`/penggajian/delete/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(res => {
                alert(res.message);
                location.reload();
            });
        }
    });
});

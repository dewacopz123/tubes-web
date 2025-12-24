// ------------------- Fungsi untuk membuka & menutup modal -------------------
function openModal() {
  const modal = document.querySelector('.modal-form-overlay');
  if (modal) modal.style.display = 'flex';
}

function closeModal() {
  const modal = document.querySelector('.modal-form-overlay');
  if (modal) {
    modal.remove(); // hapus modal dari DOM agar bersih
  }
}

// ------------------- Preview gambar sebelum upload -------------------
function previewImageFile(event) {
  const file = event.target.files && event.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function () {
    const preview = document.getElementById('previewImage');
    if (preview) preview.src = reader.result;
  };
  reader.readAsDataURL(file);
}

// ------------------- Binding form upload -------------------
function bindUploadForm(form) {
  if (!form) return;

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    try {
      const response = await fetch('../../Views/Profiles/upload.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        // Update tampilan foto baru
        const newSrc = result.filePath + '?v=' + new Date().getTime();
        const preview = document.getElementById('previewImage');
        if (preview) preview.src = newSrc;

        const photo = document.querySelector('.photo');
        if (photo) photo.src = newSrc;

        closeModal();
        alert('Foto profil berhasil diperbarui!');
      } else {
        alert(result.message || 'Gagal mengunggah foto.');
      }
    } catch (err) {
      console.error(err);
      alert('Terjadi kesalahan saat mengunggah foto.');
    }
  });
}

// ------------------- Load modal dari file HTML -------------------
async function loadAndShowPhotoModal() {
  // Cegah duplikasi modal
  if (document.querySelector('.modal-form-overlay')) return;

  try {
    const resp = await fetch('AddEditPhoto.html');
    if (!resp.ok) throw new Error('Gagal memuat konten modal');

    const html = await resp.text();

    // Tambahkan modal ke body
    const container = document.createElement('div');
    container.innerHTML = html.trim();
    document.body.appendChild(container.firstElementChild);

    // Buka modal
    openModal();

    // Tombol close
    document.querySelectorAll('[data-close]').forEach(btn => {
      btn.addEventListener('click', closeModal);
    });

    // Input file preview
    const fileInput = document.getElementById('fileInput');
    if (fileInput) fileInput.addEventListener('change', previewImageFile);

    // Bind form submit
    const form = document.getElementById('formEditPhoto');
    bindUploadForm(form);

  } catch (err) {
    console.error(err);
    alert('Gagal membuka popup foto.');
  }
}

// ------------------- Event setelah DOM siap -------------------
document.addEventListener('DOMContentLoaded', function () {
  const profilePhoto = document.getElementById('profilePhoto');
  if (profilePhoto) {
    profilePhoto.style.cursor = 'pointer';
    profilePhoto.addEventListener('click', loadAndShowPhotoModal);
  }

  const existingForm = document.getElementById('formEditPhoto');
  if (existingForm) bindUploadForm(existingForm);
});

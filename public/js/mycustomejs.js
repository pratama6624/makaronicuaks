// Fungsi untuk menampilkan atau menyembunyikan password baru dan alert
function togglePasswordOptions() {
    const resetPasswordAlert = document.getElementById('reset-password-alert');
    const checkbox = document.getElementById('use-new-password');
    const recoverybutton = document.getElementById('recoverybutton');

    // Jika checkbox dipilih, tampilkan password baru dan alert
    if (checkbox.checked) {
        resetPasswordAlert.style.display = 'block';
        recoverybutton.disabled = false;
    } else {
        resetPasswordAlert.style.display = 'none';
        recoverybutton.disabled = true;
    }
}

function toggleDiscountAmount() {
    const discountStatus = document.getElementById("discount_status").value;
    const discountLabel = document.getElementById("discount_label");
    const discountLabelDescription = document.getElementById("discount_label_description");
    const discountInput = document.getElementById("discount_input");
    const discountInputDescription = document.getElementById("discount_input_description");

    if (discountStatus === "Sedang diskon") {
        discountLabel.style.display = "block";
        discountInput.style.display = "block";
        discountLabelDescription.style.display = "block";
        discountInputDescription.style.display = "block";
    } else {
        discountLabel.style.display = "none";
        discountInput.style.display = "none";
        discountLabelDescription.style.display = "none";
        discountInputDescription.style.display = "none";
    }
}

// Upload Image Preview

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById("previewImage");
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function previewAndUploadImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("previewImage").src = e.target.result;
        };
        reader.readAsDataURL(file);
        uploadImage(file);
    }
}

async function uploadImage(file) {
    const formData = new FormData();
    formData.append('image', file);

    try {
        const response = await fetch('/upload-image', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        if (result.status === 'success') {
            document.getElementById("previewImage").src = result.path;
            console.log('Gambar berhasil diunggah:', result.path);
        } else {
            console.error('Gagal mengunggah gambar:', result.message);
        }
    } catch (error) {
        console.error('Terjadi kesalahan saat mengunggah:', error);
    }
}

document.getElementById('imageUpload').addEventListener('change', uploadImage);

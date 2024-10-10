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
// Fungsi untuk menghilangkan semua flash messages setelah beberapa detik
function hideFlashMessages() {
    // Cari semua elemen dengan kelas 'flashdata'
    var flashMessages = document.querySelectorAll('.flashdata');

    // Iterasi melalui setiap flash message
    flashMessages.forEach(function(flashMessage) {
        // Set timer untuk menghilangkan masing-masing pesan
        setTimeout(function() {
            flashMessage.style.display = 'none';
        }, 7000); // 3000 ms = 3 detik
    });
}

// Panggil fungsi ketika halaman sudah siap
window.onload = hideFlashMessages;
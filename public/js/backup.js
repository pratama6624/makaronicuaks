document.addEventListener('DOMContentLoaded', function() {
    function updateQuantity(productId, action) {
        const url = '/updateCartQuantity';
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch(url, {
            method: 'POST',
            headers: {
                'content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ product_id: productId, action: action})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // TOTAL HARGA SUDAH DIDAPATKAN TETAPI BELUM TERHITUNG DISKON PERSONAL / EVENT
                // TOTAL HARGA YANG DIDAPATKAN MASIH SALAH KARENA SEPERTINYA YANG DIAMBIL ARRAY PERTAMA DAN TIDAK DINAMIS
                // DAN SATU LAGI UNTUK BAGIAN UPDATE TANPA RELOAD ERROR LAGI
                // CHECK AGAIN BROO, TAR SORE, OKEYYY
                console.log(data.total_price);
                const quantityElement = document.querySelector(`[data-product-id="${productId}"]`).closest('.menus').querySelector('.quantity').innerText = data.new_quantity;
                const totalPriceElement = document.querySelector('.total-price');
                
                if(quantityElement) {
                    quantityElement.innerHTML = data.new_quantity;
                }

                if(totalPriceElement) {
                    totalPriceElement.innerHTML = "Rp " + data.total_price.toLocaleString();
                }
            } else {
                alert(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.log('Error', error);
        })
    }

    document.querySelectorAll('.btn-decrement').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            updateQuantity(productId, 'decrement');
        });
    });

    document.querySelectorAll('.btn-increment').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            updateQuantity(productId, 'increment');
        });
    });
});
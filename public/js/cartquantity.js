document.querySelectorAll('.btn-increment, .btn-decrement').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.dataset.productId;
        const isIncrement = this.classList.contains('btn-increment');
        const quantityElement = this.parentNode.querySelector('.quantity');

        let quantity = parseInt(quantityElement.textContent);
        
        // Update kuantitas berdasarkan aksi
        quantity = isIncrement ? quantity + 1 : Math.max(quantity - 1, 1);

        // Kirim request AJAX
        fetch('/updateCartQuantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ product_id: productId, quantity: quantity }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log(data);
                // Update UI dengan data baru
                quantityElement.textContent = data.product.quantity;

                // Update total harga per produk
                const productPriceElement = document.querySelector(`.total-price[data-product-id="${productId}"]`);
                if (productPriceElement) {
                    productPriceElement.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.product.total_price)}`;
                }

                // Update total belanja keseluruhan
                const totalAmountElement = document.querySelector('.total-amount');
                if (totalAmountElement) {
                    totalAmountElement.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.total_amount)}`;
                }
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

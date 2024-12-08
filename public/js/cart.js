$(document).on('click', '.add-to-cart', function(event){
    event.preventDefault();
    const productId = $(this).data('product-id');

    $.ajax({
        url: '/product/addtocart',
        type: 'POST',
        data: {
            id_product: productId,
            quantity: 1
        },
        success: function(response) {
            console.log(response.status);
            if(response.status === 'success') {
                let currentCount = parseInt($('.cart-badge').text()) || 0;
                $('.cart-badge').text(currentCount + 1);
                console.log("Produk masuk keranjang");
                console.log(response.cart);
            } else {
                console.log("Produk gagal masuk keranjang");
            }
        },
        error: function() {
            console.log("Terjadi kesalahan bro, coba lagi nanti");
        }
    });
});
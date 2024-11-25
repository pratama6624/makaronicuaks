const searchInput = document.querySelector('.dataTable-input');
    const tableBody = document.querySelector('tbody');

    searchInput.addEventListener('input', function () {
        const query = this.value;

        // Kirim AJAX ke server untuk pencarian
        fetch(`/admin/products/search?query=${query}`)
            .then(response => response.json())
            .then(data => {
                // Bersihkan isi tabel
                tableBody.innerHTML = '';

                if (data.length > 0) {
                    data.forEach((product, index) => {
                        const discountAmount = product.discount_status == 1
                            ? product.price * (product.discount_amount / 100)
                            : product.precentage 
                                ? product.price * (product.precentage / 100)
                                : 0;

                        const afterDiscount = product.price - discountAmount;

                        let discount = product.discount_status == 1 
                            ? `<button class="btn btn-sm btn-danger">${product.discount_amount}%</button>` 
                            : product.id_discount != null 
                                ? `<button class="btn btn-sm btn-danger">${product.precentage}%</button>` 
                                : "-";

                        let discountNote = product.id_discount != null
                            ? product.name
                            : product.discount_status == 1 && product.discount_note != ""
                                ? product.discount_note
                                : "-";

                        tableBody.innerHTML += `
                            <tr class="clickable-row" onclick="window.location.href='${product.url}'">
                                <td>${index + 1}</td>
                                <td>${product.product_name}</td>
                                <td>${product.description}</td>
                                <td>${product.category}</td>
                                <td>${product.flavor}</td>
                                <td>
                                    ${discountAmount 
                                        ? `<b><s style="color: red">Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</s></b>
                                           Rp ${new Intl.NumberFormat('id-ID').format(afterDiscount)}`
                                        : `Rp ${new Intl.NumberFormat('id-ID').format(product.price)}`}
                                </td>
                                <td>${discountNote}</td>
                                <td>${discount}</td>
                                <td>${product.stock}</td>
                            </tr>
                        `;
                    });
                } else {
                    tableBody.innerHTML = `<tr><td colspan="9" class="text-center">No products found</td></tr>`;
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    });
const searchInput = document.querySelector('.dataTable-input');
const tableBody = document.querySelector('#liveSearchProductDetailList');

// Lazy Load
let offset = 0;
const limit = 10;
let isLoading = false;
let hasMoreData = true;
let activeQuery = '';

// Fungsi untuk menyimpan query pencarian ke session storage
function saveSearchQuery(query) {
    sessionStorage.setItem('searchQuery', query);
}

// Fungsi untuk mengambil query pencarian dari session storage
function getSavedSearchQuery() {
    return sessionStorage.getItem('searchQuery') || '';
}

function highlightText(text, query) {
    if (!query) return text;

    // RegExp untuk mencocokkan kata kunci (case-insensitive)
    const regex = new RegExp(`(${query})`, 'gi');

    // Bungkus kata kunci dengan tag <mark>
    return text.replace(regex, '<mark>$1</mark>');
}

// Fungsi untuk mengirim permintaan AJAX dan menampilkan hasil
function loadProducts(query = '') {
    if (isLoading || (!hasMoreData && query === activeQuery)) return;

    // Bersihkan isi tabel
    if (query !== activeQuery) {
        // Reset tabel dan offset jika query pencarian baru
        tableBody.innerHTML = '';
        offset = 0;
        hasMoreData = true;
    }

    isLoading = true;

    fetch(`/admin/products/search?query=${encodeURIComponent(query)}&offset=${offset}&limit=${limit}`)
        .then(response => response.json())
        .then(data => {

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

                    const productName = highlightText(product.product_name, query);
                    const productDescription = highlightText(product.description, query);
                    const productCategory = highlightText(product.category, query);
                    const productFlavor = highlightText(product.flavor, query);

                    const productRow = `
                        <tr class="clickable-row" onclick="saveSearchQuery('${query}'); window.location.href='${product.url}'">
                            <td>${offset + index + 1}</td>
                            <td>${productName}</td>
                            <td>${productDescription}</td>
                            <td>${productCategory}</td>
                            <td>${productFlavor}</td>
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
                    tableBody.innerHTML += productRow;
                });
                offset += limit;
                hasMoreData = data.length === limit;
            } else {
                hasMoreData = false;
                if (query && offset === 0) {
                    tableBody.innerHTML = `<tr><td colspan="9" class="text-center">Tidak ada hasil ditemukan</td></tr>`;
                };
            }
        })
        .catch(error => console.error('Error fetching data:', error))
        .finally(
            () => {
                isLoading = false;
                activeQuery = query;
            }
        );
}

// Ambil query pencarian yang tersimpan di session storage
const savedSearchQuery = getSavedSearchQuery();
if (savedSearchQuery) {
    searchInput.value = savedSearchQuery;
    activeQuery = savedSearchQuery;
    loadProducts(savedSearchQuery);
} else {
    loadProducts();
}

searchInput.addEventListener('input', function () {
    const query = this.value.trim();
    saveSearchQuery(query);
    offset = 0;
    hasMoreData = true; // Izinkan lazy load untuk pencarian baru
    loadProducts(query);
});

window.addEventListener('scroll', () => {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
        loadProducts(activeQuery);
    }
});

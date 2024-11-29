import { initLiveSearch } from '../livesearch.js';
import { highlightText } from '../utils.js';

const initialState = JSON.parse(sessionStorage.getItem('liveSearchState'));

initLiveSearch({
    searchInputSelector: '.dataProduct-input',
    tableBodySelector: '#liveSearchProduct',
    fetchUrl: '/admin/products/search',
    renderRowCallback: (product, index, query) => {
        // Hitung diskon
        const discountAmount = product.discount_status == 1
            ? product.price * (product.discount_amount / 100)
            : product.id_discount != null
                ? product.price * (product.precentage / 100)
                : 0;

        const afterDiscount = product.price - discountAmount;

        const discountLabel = product.discount_status == 1 || product.id_discount != null
            ? `
                <div class="overlay"></div>
                <div class="discount-label">
                    ${product.id_discount != null ? `${product.name}<br>` : ''}
                    ${product.discount_note ? `${product.discount_note}<br>` : ''}
                    ${product.discount_status == 1 && !product.id_discount ? product.discount_amount : product.precentage}% OFF
                </div>
              `
            : '';

        const productName = highlightText(product.product_name, query);

        // Render HTML card
        return `
            <div class="col-xl-2 col-md-6 col-sm-12">
                <a href="${product.url}" onclick="saveSearchQuery('${query}')" class="card clickable-rowonproduct">
                    <div class="card">
                        <div class="card-content">
                            <h6 style="padding: 10px; margin-bottom: 0px">${productName}</h6>
                            <div class="image-container position-relative">
                                ${discountLabel}
                                <img class="img-fluid w-100" src="/assets/images/products/${product.image}" alt="${product.product_name}">
                            </div>
                        </div>
                        <div style="padding: 10px; height: 40px;" class="d-flex justify-content-between align-items-center">
                            ${product.discount_status == 0 && !product.id_discount
                                ? `<span>Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</span>`
                                : `<b><s style="color: red">Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</s></b>`}
                            <span>${(product.discount_status == 1 || product.id_discount) ? `Rp ${new Intl.NumberFormat('id-ID').format(afterDiscount)}` : ''}</span>
                        </div>
                    </div>
                </a>
            </div>
        `;
    },
    limit: 10,
    initialState: initialState, // Pastikan ini ada
});

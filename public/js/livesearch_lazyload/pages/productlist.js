import { initLiveSearch } from '../livesearch.js';
import { saveSearchQuery, highlightText } from '../utils.js';

const initialState = JSON.parse(sessionStorage.getItem('liveSearchState'));

initLiveSearch({
    searchInputSelector: '.dataTableProductList-input',
    tableBodySelector: '#liveSearchProductDetailList',
    fetchUrl: '/admin/products/search',
    renderRowCallback: (product, index, query) => {
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

                    return `
                    <tr class="clickable-row" data-query="${query}" data-url="${product.url}">
                        <td>${index + 1}</td>
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
    },
    limit: 10,
    initialState: initialState, // Pastikan ini ada
});
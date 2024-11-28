import { saveSearchQuery, getSavedSearchQuery } from './utils.js';

let debounceTimeout;

export function initLiveSearch(config) {
    const {
        searchInputSelector,
        tableBodySelector,
        fetchUrl,
        renderRowCallback,
        limit = 10,
        extraParams = {}
    } = config;

    const searchInput = document.querySelector(searchInputSelector);
    const tableBody = document.querySelector(tableBodySelector);

    let offset = 0;
    let isLoading = false;
    let hasMoreData = true;
    let activeQuery = '';

    const savedQuery = getSavedSearchQuery();
    if (savedQuery) {
        searchInput.value = savedQuery; // Set nilai input pencarian
        activeQuery = savedQuery; // Set sebagai query aktif
    }

    const savedSearchQuery = getSavedSearchQuery();
    if (savedSearchQuery) {
        searchInput.value = savedSearchQuery;
        activeQuery = savedSearchQuery;
    }

    function loadProducts(query = '') {
        if (isLoading || (!hasMoreData && query === activeQuery)) return;

        if (query !== activeQuery) {
            tableBody.innerHTML = ''; // Reset data jika query baru
            offset = 0;
            hasMoreData = true;
        }

        isLoading = true;

        // Tambahkan parameter tambahan ke URL (jika ada)
        const urlParams = new URLSearchParams({
            query: encodeURIComponent(query),
            offset,
            limit,
            ...extraParams,
        });

        fetch(`${fetchUrl}?${urlParams}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach((item, index) => {
                        const productRow = renderRowCallback(item, offset + index, query);
                        tableBody.innerHTML += productRow;
                    });
                    offset += limit;
                    hasMoreData = data.length === limit;
                } else {
                    hasMoreData = false;
                    if (query && offset === 0) {
                        tableBody.innerHTML = `<tr><td colspan="9" class="text-center">Tidak ada hasil ditemukan</td></tr>`;
                    }
                }
            })
            .catch(error => console.error('Error fetching data:', error))
            .finally(() => {
                isLoading = false;
                activeQuery = query;
            });
    }

    // Event listener untuk input pencarian
    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        clearTimeout(debounceTimeout);

        sessionStorage.setItem('searchQuery', query);

        debounceTimeout = setTimeout(() => {
            offset = 0;
            hasMoreData = true;
            loadProducts(query);
        }, 500)
    });

    // Event listener untuk lazy load
    window.addEventListener('scroll', () => {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
            loadProducts(activeQuery);
        }
    });

    loadProducts(activeQuery);
}
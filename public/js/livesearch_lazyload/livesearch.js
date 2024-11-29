import { getSavedSearchQuery } from './utils.js';

let debounceTimeout;

export function initLiveSearch(config) {
    const {
        searchInputSelector,
        tableBodySelector,
        fetchUrl,
        renderRowCallback,
        limit = 10,
        extraParams = {},
        initialState = null,
    } = config;

    const searchInput = document.querySelector(searchInputSelector);
    const tableBody = document.querySelector(tableBodySelector);

    let offset = 0;
    let isLoading = false;
    let hasMoreData = true;
    let activeQuery = '';

    // Fungsi untuk menyimpan state
    function saveState() {
        const state = {
            query: activeQuery,
            items: [...tableBody.children].map((child) => child.outerHTML),
            offset,
            scrollPosition: window.scrollY,
        };
        sessionStorage.setItem('liveSearchState', JSON.stringify(state));
    }

    // Fungsi untuk memulihkan state
    function restoreState() {
        const isReturning = sessionStorage.getItem('returningFromDetail') === 'true';
        if (isReturning && initialState) {
            const { query, items, offset: savedOffset, scrollPosition } = initialState;

            searchInput.value = query || '';
            activeQuery = query || '';
            offset = savedOffset || 0;
            hasMoreData = true;
            tableBody.innerHTML = items.join('');
            window.scrollTo(0, scrollPosition || 0);

            // Hapus tanda "returningFromDetail" setelah memulihkan
            sessionStorage.removeItem('returningFromDetail');
        }
    }

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
                saveState();
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
        saveState();
    });

    restoreState(); // Pulihkan state awal
    loadProducts(activeQuery); // Load data pertama kali
}

// Reset scroll saat navigasi ke halaman lain
window.addEventListener('beforeunload', () => {
    if (!sessionStorage.getItem('returningFromDetail')) {
        window.scrollTo(0, 0);
    }
});

// Pulihkan posisi scroll saat halaman dimuat
// window.addEventListener('load', () => {
//     const savedPosition = sessionStorage.getItem('scrollPosition');
//     if (savedPosition) {
//         window.scrollTo(0, parseInt(savedPosition, 10));
//     }
// });

// Event listener untuk navigasi ke halaman detail
document.querySelector('#liveSearchProductDetailList', '#liveSearchProduct').addEventListener('click', (event) => {
    const row = event.target.closest('.clickable-row');
    if (row) {
        const query = row.getAttribute('data-query');
        const url = row.getAttribute('data-url');

        // Simpan posisi scroll dan tanda asal halaman sebelum navigasi
        sessionStorage.setItem('scrollPosition', window.scrollY);
        sessionStorage.setItem('returningFromDetail', 'true');

        // Navigasi ke halaman detail produk
        window.location.href = url;
    }
});

// Reset scroll untuk semua tautan navigasi lain
document.querySelectorAll('.nav-link.some-class').forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();

        window.scrollTo(0, 0); // Hanya berlaku untuk class tertentu
        const targetUrl = link.getAttribute('href');
        if (targetUrl) {
            window.location.href = targetUrl;
        }
    });
});
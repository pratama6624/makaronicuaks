// Fungsi untuk menyimpan query pencarian ke session storage
export function saveSearchQuery(query) {
    sessionStorage.setItem('searchQuery', query);
}

// Fungsi untuk mengambil query pencarian dari session storage
export function getSavedSearchQuery() {
    return sessionStorage.getItem('searchQuery') || '';
}

// Fungsi untuk menyoroti teks hasil pencarian
export function highlightText(text, query) {
    if (!query) return text;

    // RegExp untuk mencocokkan kata kunci (case-insensitive)
    const regex = new RegExp(`(${query})`, 'gi');

    // Bungkus kata kunci dengan tag <mark>
    return text.replace(regex, '<mark>$1</mark>');
}
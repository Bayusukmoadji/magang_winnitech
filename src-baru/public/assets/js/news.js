// public/assets/js/news.js (Versi Final Gabungan)

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("globalSearchInput");
    const articleGrid = document.querySelector(".row.g-4");
    const paginationContainer = document.getElementById("pagination-container");

    if (!articleGrid) return;

    // --- FUNGSI HELPER ---
    const debounce = (func, delay) => {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    };

    function createArticleCard(article) {
        const publicationDate = new Date(
            article.publication_date
        ).toLocaleDateString("id-ID", {
            day: "numeric",
            month: "long",
            year: "numeric",
        });
        const excerpt = article.excerpt || "";
        const imageUrl = `/storage/${article.image_path}`;
        const detailUrl = `/detailNews/${article.slug}`;

        return `
            <div class="col">
                <div class="card h-100 bg-dark text-white rounded-4">
                    <div class="news-card-image-container">
                        <a href="${detailUrl}"><img src="${imageUrl}" class="card-img-top rounded-top-4" alt="${article.title}"></a>
                        <div class="news-date-badge">${publicationDate}</div>
                    </div>
                    <div class="card-body p-2">
                        <p class="card-text fw-semibold">${article.title}</p>
                        <p class="deskripsigrid">${excerpt}</p>
                        <p class="news-author-line small mb-0">Author: <strong>${article.author_name}</strong></p>
                    </div>
                </div>
            </div>
        `;
    }

    // --- LOGIKA PENCARIAN AJAX ---
    if (searchInput) {
        const originalArticlesHtml = articleGrid.innerHTML; // Simpan konten awal

        const performAjaxSearch = async (event) => {
            const query = event.target.value.trim();

            if (query === "") {
                articleGrid.innerHTML = originalArticlesHtml; // Kembalikan jika input kosong
                if (paginationContainer)
                    paginationContainer.style.display = "block";
                return;
            }

            articleGrid.innerHTML =
                '<p class="text-white text-center col-12">Mencari...</p>';
            if (paginationContainer) paginationContainer.style.display = "none"; // Sembunyikan paginasi

            try {
                const response = await fetch(
                    `/api/search-news?query=${encodeURIComponent(query)}`
                );
                const articles = await response.json();

                articleGrid.innerHTML = ""; // Kosongkan grid

                if (articles.length > 0) {
                    articles.forEach((article) => {
                        articleGrid.insertAdjacentHTML(
                            "beforeend",
                            createArticleCard(article)
                        );
                    });
                } else {
                    articleGrid.innerHTML =
                        '<p class="text-white text-center col-12">Tidak ada hasil ditemukan.</p>';
                }
            } catch (error) {
                console.error("Pencarian gagal:", error);
                articleGrid.innerHTML =
                    '<p class="text-danger text-center col-12">Gagal melakukan pencarian.</p>';
            }
        };

        searchInput.addEventListener("input", debounce(performAjaxSearch, 500));
    }

    // Catatan: Fungsionalitas "Load More" dengan AJAX akan lebih kompleks dan bisa berkonflik
    // dengan paginasi standar. Untuk saat ini, kita fokus pada pencarian AJAX yang sudah berfungsi
    // dan mempertahankan paginasi standar Laravel yang sudah robust.
});

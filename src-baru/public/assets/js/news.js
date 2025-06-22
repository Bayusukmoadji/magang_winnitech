// public/assets/js/news.js (Final dengan Loading Rata Tengah Penuh)

document.addEventListener("DOMContentLoaded", function () {
    // --- Deklarasi Elemen Utama ---
    const searchInput = document.getElementById("globalSearchInput");
    const searchForm = document.getElementById("navSearchForm");
    const articleGrid = document.getElementById("news-article-grid");
    const loadMoreContainer = document.getElementById("load-more-container");
    const carouselContainer = document.getElementById("carousel-container");
    const mainContentSection = document.querySelector(
        ".container-lg.my-5.text-white"
    ); // Wadah konten utama

    if (!articleGrid) {
        return;
    }

    // --- Fungsi Helper ---
    function createArticleCard(article) {
        // ... (fungsi ini tidak berubah) ...
    }
    const debounce = (func, delay) => {
        /* ... (fungsi ini tidak berubah) ... */
    };

    // =============================
    // LOGIKA PENCARIAN AJAX
    // =============================
    if (searchInput && searchForm) {
        const performAjaxSearch = async (query) => {
            // !! PERUBAHAN DI SINI !!
            // 1. Buat elemen overlay dan spinner
            const loaderOverlay = document.createElement("div");
            loaderOverlay.className = "search-loader-overlay";
            loaderOverlay.innerHTML = `<div class="loading-indicator"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div><p>Mencari Berita...</p></div>`;

            // 2. Tempelkan ke body untuk menutupi seluruh layar
            document.body.appendChild(loaderOverlay);

            // 3. Sembunyikan konten utama
            if (mainContentSection) mainContentSection.style.display = "none";

            try {
                const response = await fetch(
                    `/api/search-news?query=${encodeURIComponent(query)}`
                );
                const articles = await response.json();

                // Kosongkan hanya grid berita, bukan seluruh section
                articleGrid.innerHTML = "";

                if (articles.length > 0) {
                    articles.forEach((article) => {
                        articleGrid.insertAdjacentHTML(
                            "beforeend",
                            createArticleCard(article)
                        );
                    });
                } else {
                    articleGrid.innerHTML =
                        '<p class="text-white text-center col-12 fs-4">Tidak ada berita yang cocok ditemukan.</p>';
                }
            } catch (error) {
                console.error("Pencarian gagal:", error);
                articleGrid.innerHTML =
                    '<p class="text-danger text-center col-12 fs-4">Gagal melakukan pencarian.</p>';
            } finally {
                // 4. Hapus overlay dan tampilkan kembali konten utama setelah selesai
                document.body.removeChild(loaderOverlay);
                if (mainContentSection)
                    mainContentSection.style.display = "block";
                if (loadMoreContainer) loadMoreContainer.style.display = "none"; // Tetap sembunyikan load more
                if (carouselContainer) carouselContainer.style.display = "none"; // Tetap sembunyikan carousel
            }
        };

        const debouncedSearch = debounce(performAjaxSearch, 500);

        searchInput.addEventListener("input", (event) => {
            const query = event.target.value.trim();
            if (query === "") {
                window.location.href = "/news";
                return;
            }
            debouncedSearch(query);
        });

        searchForm.addEventListener("submit", (event) => {
            event.preventDefault();
        });
    }

    // ... (Sisa kode untuk Load More tidak berubah) ...
});

// Untuk mempermudah, ini adalah kode lengkapnya sekali lagi:
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("globalSearchInput");
    const searchForm = document.getElementById("navSearchForm");
    const articleGrid = document.getElementById("news-article-grid");
    const loadMoreContainer = document.getElementById("load-more-container");
    const carouselContainer = document.getElementById("carousel-container");
    const mainContentSection = document.querySelector("section.container-lg");

    if (!articleGrid) {
        return;
    }

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
        const authorName = article.author_name || "Admin";
        return `<div class="col"><div class="card h-100 bg-dark text-white rounded-4"><div class="news-card-image-container"><a href="${detailUrl}"><img src="${imageUrl}" class="card-img-top rounded-top-4" alt="${article.title}"></a><div class="news-date-badge">${publicationDate}</div></div><div class="card-body p-2"><p class="card-text fw-semibold">${article.title}</p><p class="deskripsigrid">${excerpt}</p><p class="news-author-line small mb-0">Author: <strong>${authorName}</strong></p></div></div></div>`;
    }
    const debounce = (func, delay) => {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    };

    if (searchInput && searchForm) {
        const performAjaxSearch = async (query) => {
            const loaderOverlay = document.createElement("div");
            loaderOverlay.className = "search-loader-overlay";
            loaderOverlay.innerHTML = `<div class="loading-indicator"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div><p>Mencari Berita...</p></div>`;
            document.body.appendChild(loaderOverlay);
            if (mainContentSection) mainContentSection.style.display = "none";

            try {
                const response = await fetch(
                    `/api/search-news?query=${encodeURIComponent(query)}`
                );
                const articles = await response.json();
                articleGrid.innerHTML = "";
                if (articles.length > 0) {
                    articles.forEach((article) => {
                        articleGrid.insertAdjacentHTML(
                            "beforeend",
                            createArticleCard(article)
                        );
                    });
                } else {
                    articleGrid.innerHTML =
                        '<p class="text-white text-center col-12 fs-4">Tidak ada berita yang cocok ditemukan.</p>';
                }
            } catch (error) {
                console.error("Pencarian gagal:", error);
                articleGrid.innerHTML =
                    '<p class="text-danger text-center col-12 fs-4">Gagal melakukan pencarian.</p>';
            } finally {
                document.body.removeChild(loaderOverlay);
                if (mainContentSection)
                    mainContentSection.style.display = "block";
                if (carouselContainer) carouselContainer.style.display = "none";
                if (loadMoreContainer) loadMoreContainer.style.display = "none";
            }
        };
        const debouncedSearch = debounce(performAjaxSearch, 500);
        searchInput.addEventListener("input", (event) => {
            const query = event.target.value.trim();
            if (query === "") {
                window.location.href = "/news";
                return;
            }
            debouncedSearch(query);
        });
        searchForm.addEventListener("submit", (event) => {
            event.preventDefault();
        });
    }

    const loadMoreBtn = document.getElementById("load-more-news-btn");
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener("click", async function () {
            const nextPageUrl = this.dataset.nextPageUrl;
            if (!nextPageUrl) return;
            this.disabled = true;
            this.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`;
            try {
                const pageQuery = new URL(nextPageUrl).searchParams.get("page");
                const apiUrl = `/api/load-more-news?page=${pageQuery}`;
                const response = await fetch(apiUrl);
                const newData = await response.json();
                if (newData.data && newData.data.length > 0) {
                    newData.data.forEach((article) => {
                        articleGrid.insertAdjacentHTML(
                            "beforeend",
                            createArticleCard(article)
                        );
                    });
                    if (newData.next_page_url) {
                        this.dataset.nextPageUrl = newData.next_page_url;
                        this.disabled = false;
                        this.textContent = "Load More";
                    } else {
                        if (this.parentElement)
                            this.parentElement.style.display = "none";
                    }
                } else {
                    if (this.parentElement)
                        this.parentElement.style.display = "none";
                }
            } catch (error) {
                console.error("Gagal memuat berita:", error);
                this.textContent = "Gagal Memuat. Coba Lagi.";
                this.disabled = false;
            }
        });
    }
});

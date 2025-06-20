// File: public/assets/js/news.js

document.addEventListener("DOMContentLoaded", function () {
    const loadMoreBtn = document.getElementById("load-more-news-btn");
    const articleGrid = document.querySelector(".row.g-4");

    if (!loadMoreBtn || !articleGrid) {
        return; // Hentikan script jika tombol atau grid tidak ada
    }

    // Fungsi untuk membuat satu card artikel dari data JSON
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
                        <p class="news-author-line small mb-0">Author: <strong>${authorName}</strong></p>
                    </div>
                </div>
            </div>
        `;
    }

    // Tambahkan 'event listener' ke tombol "Load More"
    loadMoreBtn.addEventListener("click", async function () {
        const nextPageUrl = this.dataset.nextPageUrl;
        if (!nextPageUrl) return;

        this.disabled = true;
        this.textContent = "Loading...";

        try {
            // Ambil hanya nomor halaman dari URL lengkap
            const pageQuery = new URL(nextPageUrl).searchParams.get("page");
            // Panggil API yang sudah kita buat
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
                    this.dataset.nextPageUrl = newData.next_page_url; // Perbarui URL untuk request selanjutnya
                    this.disabled = false;
                    this.textContent = "Load More";
                } else {
                    this.style.display = "none"; // Sembunyikan jika tidak ada halaman lagi
                }
            } else {
                this.style.display = "none"; // Sembunyikan jika tidak ada data
            }
        } catch (error) {
            console.error("Gagal memuat berita:", error);
            this.textContent = "Gagal Memuat. Coba Lagi.";
            this.disabled = false;
        }
    });
});

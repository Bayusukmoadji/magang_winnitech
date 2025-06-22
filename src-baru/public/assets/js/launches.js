// public/assets/js/launches.js (Versi Final dengan Reset via Reload)

document.addEventListener("DOMContentLoaded", function () {
    // --- Deklarasi Elemen Utama ---
    const searchInput = document.getElementById("globalSearchInput");
    const searchForm = document.getElementById("navSearchForm");
    const launchGrid = document.getElementById("launchCards");
    const loadMoreContainer = document.getElementById("load-more-container");
    const loadMoreBtn = document.getElementById("load-more-launches-btn");

    if (!launchGrid) {
        return;
    }

    // --- Fungsi Helper ---
    function createLaunchCard(launch) {
        const launchDate = new Date(launch.launch_date).toLocaleDateString(
            "en-US",
            { month: "short", day: "numeric", year: "numeric" }
        );
        const short_description = launch.short_description || "";
        const imageUrl = `/storage/${launch.image_path}`;
        const detailUrl = `/detailLaunches/${launch.slug}`;
        return `<div class="col-md-6 col-lg-4"><div class="card launch-card h-100"><div class="launch-card-img-container"><a href="${detailUrl}"><img src="${imageUrl}" class="card-img-top launch-card-image" alt="${launch.title}"></a><div class="launch-date-badge">${launchDate}</div></div><div class="card-body"><h5 class="card-title launch-title">${launch.title}</h5><p class="card-text launch-company">${launch.company_name}</p><p class="card-text launch-description">${short_description}</p></div><div class="card-footer launch-card-footer"><a href="${detailUrl}" class="btn btn-sm btn-secondary-themed w-100">Read More <i class="bi bi-arrow-right-short"></i></a></div></div></div>`;
    }
    const debounce = (func, delay) => {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    };

    // =============================
    // LOGIKA PENCARIAN AJAX
    // =============================
    if (searchInput && searchForm) {
        const performAjaxSearch = async (query) => {
            if (loadMoreContainer) loadMoreContainer.style.display = "none";
            launchGrid.innerHTML =
                '<p class="text-white text-center col-12 fs-4">Mencari...</p>';

            try {
                const response = await fetch(
                    `/api/search-launches?query=${encodeURIComponent(query)}`
                );
                const launches = await response.json();
                launchGrid.innerHTML = "";
                if (launches.length > 0) {
                    launches.forEach((launch) => {
                        launchGrid.insertAdjacentHTML(
                            "beforeend",
                            createLaunchCard(launch)
                        );
                    });
                } else {
                    launchGrid.innerHTML =
                        '<p class="text-white text-center col-12 fs-4">Tidak ada produk yang cocok ditemukan.</p>';
                }
            } catch (error) {
                console.error("Pencarian gagal:", error);
                launchGrid.innerHTML =
                    '<p class="text-danger text-center col-12 fs-4">Gagal melakukan pencarian.</p>';
            }
        };

        const debouncedSearch = debounce(performAjaxSearch, 400);

        searchInput.addEventListener("input", (event) => {
            const query = event.target.value.trim();

            // !! PERUBAHAN DI SINI !!
            // Jika input kosong, reload halaman. Ini cara paling stabil.
            if (query === "") {
                window.location.href = "/launches";
                return;
            }

            debouncedSearch(query);
        });

        searchForm.addEventListener("submit", (event) => {
            event.preventDefault();
        });
    }

    // =============================
    // LOGIKA LOAD MORE
    // =============================
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener("click", async function () {
            const nextPageUrl = this.dataset.nextPageUrl;
            if (!nextPageUrl) return;
            this.disabled = true;
            this.textContent = "Loading...";
            try {
                const pageQuery = new URL(nextPageUrl).searchParams.get("page");
                const apiUrl = `/api/launches/load-more?page=${pageQuery}`;
                const response = await fetch(apiUrl);
                const newData = await response.json();
                if (newData.data && newData.data.length > 0) {
                    newData.data.forEach((launch) => {
                        launchGrid.insertAdjacentHTML(
                            "beforeend",
                            createLaunchCard(launch)
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
                console.error("Gagal memuat data launches:", error);
                this.textContent = "Gagal Memuat. Coba Lagi.";
                this.disabled = false;
            }
        });
    }
});

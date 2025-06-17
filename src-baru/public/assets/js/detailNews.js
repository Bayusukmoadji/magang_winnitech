// public/assets/js/detailNews.js (KODE FINAL)

// --- Fungsi Helper (didefinisikan di luar agar bersih) ---

/**
 * Menunda eksekusi fungsi hingga pengguna berhenti berinteraksi selama durasi tertentu.
 * @param {Function} func Fungsi yang akan dieksekusi.
 * @param {number} delay Waktu tunda dalam milidetik.
 */
function debounce(func, delay) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

/**
 * Mengubah format tanggal menjadi lebih mudah dibaca (misal: 17 Juni 2025).
 * @param {string} dateString String tanggal dari server.
 */
function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const options = { day: "numeric", month: "long", year: "numeric" };
    return new Intl.DateTimeFormat("id-ID", options).format(date);
}

/**
 * Membersihkan string dari karakter HTML untuk keamanan (mencegah XSS).
 * @param {string} unsafe String yang mungkin tidak aman.
 */
function escapeHtml(unsafe) {
    if (typeof unsafe !== "string") return "";
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// --- Logika Utama (dijalankan setelah halaman selesai dimuat) ---

document.addEventListener("DOMContentLoaded", () => {
    // --- Deklarasi Elemen Utama ---
    const commentsListContainer = document.querySelector(".comments-list");
    const searchInput = document.getElementById("globalSearchInput");
    const searchForm = document.getElementById("navSearchFormGlobal");
    const searchableContentElement = document.querySelector(
        ".news-article-wrapper"
    );
    const loadMoreBtn = document.getElementById("load-more-comments");
    const csrfToken = document.querySelector('meta[name="csrf-token"]')
        ? document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content")
        : "";

    // =======================================================
    // FUNGSI LIHAT/TUTUP BALASAN (MENGGUNAKAN EVENT DELEGATION)
    // =======================================================
    if (commentsListContainer) {
        // Listener untuk menampilkan balasan
        commentsListContainer.addEventListener(
            "show.bs.collapse",
            function (event) {
                const triggerButton = document.querySelector(
                    `[data-bs-target="#${event.target.id}"]`
                );
                if (
                    triggerButton &&
                    triggerButton.classList.contains("toggle-replies-btn")
                ) {
                    const buttonText = triggerButton.querySelector(".btn-text");
                    if (buttonText) buttonText.textContent = "Tutup Balasan";
                }
            }
        );

        // Listener untuk menyembunyikan balasan
        commentsListContainer.addEventListener(
            "hide.bs.collapse",
            function (event) {
                const triggerButton = document.querySelector(
                    `[data-bs-target="#${event.target.id}"]`
                );
                if (
                    triggerButton &&
                    triggerButton.classList.contains("toggle-replies-btn")
                ) {
                    const replyCount =
                        event.target.querySelectorAll(".comment-item").length;
                    const buttonText = triggerButton.querySelector(".btn-text");
                    if (buttonText)
                        buttonText.textContent = `Lihat Balasan (${replyCount})`;
                }
            }
        );
    }

    // ===================================
    // FUNGSI LOAD MORE KOMENTAR
    // ===================================
    if (loadMoreBtn && commentsListContainer) {
        let currentPage = parseInt(loadMoreBtn.dataset.page, 10);
        const articleId = loadMoreBtn.dataset.articleId;

        loadMoreBtn.addEventListener("click", async function () {
            this.disabled = true;
            this.textContent = "Loading...";

            try {
                const response = await fetch(
                    `/load-comments?article_id=${articleId}&page=${currentPage}`
                );
                const newData = await response.json();

                if (newData.data && newData.data.length > 0) {
                    newData.data.forEach((comment) => {
                        let repliesHtml = "";
                        if (comment.replies && comment.replies.length > 0) {
                            comment.replies.forEach((reply) => {
                                repliesHtml += `<div class="comment-item is-reply" id="reply-${
                                    reply.id
                                }"><div class="comment-content"><div class="comment-header"><span class="commenter-name">${escapeHtml(
                                    reply.name
                                )}</span><span class="comment-timestamp">${formatTimeAgo(
                                    reply.created_at
                                )}</span></div><p class="comment-text">${escapeHtml(
                                    reply.comment
                                )}</p></div></div>`;
                            });
                        }

                        let viewRepliesButtonHtml = "";
                        if (comment.replies && comment.replies.length > 0) {
                            viewRepliesButtonHtml = `<span class="mx-1 text-muted">·</span><button class="btn btn-link btn-sm toggle-replies-btn" type="button" data-bs-toggle="collapse" data-bs-target="#replies-for-comment-${comment.id}" aria-expanded="false"><i class="bi bi-chevron-down me-1"></i> <span class="btn-text">Lihat Balasan (${comment.replies.length})</span></button>`;
                        }

                        const commentHtml = `<div class="comment-item" id="comment-${
                            comment.id
                        }"><div class="comment-content"><div class="comment-header"><span class="commenter-name">${escapeHtml(
                            comment.name
                        )}</span><span class="comment-timestamp">${formatTimeAgo(
                            comment.created_at
                        )}</span></div><p class="comment-text">${escapeHtml(
                            comment.comment
                        )}</p><div class="comment-actions mt-2 d-flex align-items-center"><button class="btn btn-link btn-sm reply-button" type="button" data-bs-toggle="collapse" data-bs-target="#replyForm-${
                            comment.id
                        }"><i class="bi bi-reply-fill"></i> Reply</button>${viewRepliesButtonHtml}</div><div class="reply-form-container collapse mt-3" id="replyForm-${
                            comment.id
                        }"><form class="reply-form" action="/replies" method="POST"><input type="hidden" name="_token" value="${csrfToken}"><input type="hidden" name="news_comment_id" value="${
                            comment.id
                        }"><h5 class="reply-form-title mb-2">Write a reply to ${escapeHtml(
                            comment.name
                        )}</h5><div class="mb-2"><input type="text" class="form-control form-control-sm form-control-futuristic" name="name" placeholder="Your Name" required></div><div class="mb-2"><textarea class="form-control form-control-sm form-control-futuristic" name="comment" rows="3" placeholder="Your Reply..." required></textarea></div><button type="submit" class="btn btn-primary-themed btn-sm">Submit Reply</button><button type="button" class="btn btn-secondary-themed btn-sm ms-2" data-bs-toggle="collapse" data-bs-target="#replyForm-${
                            comment.id
                        }">Cancel</button></form></div></div><div class="replies-list ps-4 mt-3 collapse" id="replies-for-comment-${
                            comment.id
                        }">${repliesHtml}</div></div>`;
                        commentsListContainer.insertAdjacentHTML(
                            "beforeend",
                            commentHtml
                        );
                    });
                    currentPage++;
                    this.dataset.page = currentPage;
                }

                if (!newData.next_page_url) {
                    this.parentElement.style.display = "none";
                }
            } catch (error) {
                console.error("Gagal memuat komentar:", error);
                this.textContent = "Gagal Memuat. Coba Lagi.";
            } finally {
                if (
                    this.parentElement &&
                    this.parentElement.style.display !== "none"
                ) {
                    this.disabled = false;
                    this.textContent = "Load More Comments";
                }
            }
        });
    }

    // =======================================================
    // FUNGSI SOROT TEKS (HIGHLIGHT) - VERSI AMAN
    // =======================================================
    if (searchableContentElement && searchInput) {
        // Fungsi ini hanya akan menyorot teks tanpa merusak elemen lain
        function highlightText(element, searchTerm) {
            removeHighlights(); // Hapus dulu yang lama
            if (!element || !searchTerm) return;
            const escapedSearchTerm = searchTerm.replace(
                /[.*+?^${}()|[\]\\]/g,
                "\\$&"
            );
            const regex = new RegExp(escapedSearchTerm, "gi");

            function traverse(node) {
                if (node.nodeType === 3) {
                    const match = node.data.match(regex);
                    if (match) {
                        const span = document.createElement("span");
                        span.innerHTML = node.data.replace(
                            regex,
                            (match) =>
                                `<mark class="search-highlight">${match}</mark>`
                        );
                        node.parentNode.replaceChild(span, node);
                    }
                } else if (
                    node.nodeType === 1 &&
                    node.nodeName !== "SCRIPT" &&
                    node.nodeName !== "STYLE" &&
                    node.nodeName !== "MARK"
                ) {
                    Array.from(node.childNodes).forEach(traverse);
                }
            }
            traverse(element);
        }

        // Fungsi ini hanya akan menghapus sorotan
        function removeHighlights() {
            const marks = searchableContentElement.querySelectorAll(
                "mark.search-highlight"
            );
            marks.forEach((mark) => {
                const parent = mark.parentNode;
                if (parent) {
                    parent.replaceChild(
                        document.createTextNode(mark.textContent || ""),
                        mark
                    );
                    parent.normalize();
                }
            });
        }

        const performSearch = debounce(() => {
            const searchTerm = searchInput.value.trim();
            highlightText(searchableContentElement, searchTerm);
        }, 300);

        searchInput.addEventListener("input", performSearch);
        searchInput.addEventListener("search", () => {
            if (searchInput.value === "") removeHighlights();
        });
        if (searchForm) {
            searchForm.addEventListener("submit", (event) => {
                event.preventDefault();
                performSearch();
            });
        }
    }
});

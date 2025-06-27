// public/assets/js/detailLaunches.js (Versi Final Lengkap)

// --- Fungsi Helper ---
function debounce(func, delay) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

function formatTimeAgo(dateString) {
    if (!dateString) return "";
    const date = new Date(dateString);
    const options = {
        day: "numeric",
        month: "long",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    };
    return new Intl.DateTimeFormat("id-ID", options).format(date) + " WIB";
}

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
    const loadMoreBtn = document.getElementById("load-more-comments-launches");
    const csrfToken = document.querySelector('meta[name="csrf-token"]')
        ? document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content")
        : "";

    // Elemen untuk pencarian highlight
    const searchInput = document.getElementById("globalSearchInput");
    const searchForm = document.getElementById("navSearchFormGlobal");
    const searchableContentElement = document.querySelector(
        ".detail-launch-page-content"
    );

    // ===================================
    // FUNGSI LIHAT/TUTUP BALASAN
    // ===================================
    if (commentsListContainer) {
        commentsListContainer.addEventListener(
            "show.bs.collapse",
            function (event) {
                const triggerButton = document.querySelector(
                    `button[data-bs-target="#${event.target.id}"]`
                );
                if (
                    triggerButton &&
                    triggerButton.classList.contains("toggle-replies-btn")
                ) {
                    const buttonText = triggerButton.querySelector(".btn-text");
                    if (buttonText)
                        buttonText.textContent = buttonText.textContent.replace(
                            "Lihat",
                            "Sembunyikan"
                        );
                }
            }
        );

        commentsListContainer.addEventListener(
            "hide.bs.collapse",
            function (event) {
                const triggerButton = document.querySelector(
                    `button[data-bs-target="#${event.target.id}"]`
                );
                if (
                    triggerButton &&
                    triggerButton.classList.contains("toggle-replies-btn")
                ) {
                    const buttonText = triggerButton.querySelector(".btn-text");
                    if (buttonText)
                        buttonText.textContent = buttonText.textContent.replace(
                            "Sembunyikan",
                            "Lihat"
                        );
                }
            }
        );
    }

    // ===================================
    // FUNGSI LOAD MORE KOMENTAR
    // ===================================
    if (loadMoreBtn) {
        let currentPage = parseInt(loadMoreBtn.dataset.page, 10);
        const launchId = loadMoreBtn.dataset.launchId;

        loadMoreBtn.addEventListener("click", async function () {
            this.disabled = true;
            this.textContent = "Loading...";

            try {
                const response = await fetch(
                    `/api/launches/load-more-comments?launch_id=${launchId}&page=${currentPage}`
                );
                if (!response.ok)
                    throw new Error(`HTTP error! status: ${response.status}`);

                const newData = await response.json();

                if (newData.data && newData.data.length > 0) {
                    let allCommentsHtml = "";
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

                        const replyFormAction = "/launches/replies";

                        allCommentsHtml += `
                        <div class="comment-item" id="comment-${comment.id}">
                            <div class="comment-content">
                                <div class="comment-header"><span class="commenter-name">${escapeHtml(
                                    comment.name
                                )}</span><span class="comment-timestamp">${formatTimeAgo(
                            comment.created_at
                        )}</span></div>
                                <p class="comment-text">${escapeHtml(
                                    comment.comment
                                )}</p>
                                <div class="comment-actions mt-2 d-flex align-items-center">
                                    <button class="btn btn-link btn-sm reply-button" type="button" data-bs-toggle="collapse" data-bs-target="#replyForm-${
                                        comment.id
                                    }"><i class="bi bi-reply-fill"></i> Reply</button>
                                    ${viewRepliesButtonHtml}
                                </div>
                                <div class="reply-form-container collapse mt-3" id="replyForm-${
                                    comment.id
                                }">
                                    <form class="reply-form" action="${replyFormAction}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfToken}">
                                        <input type="hidden" name="launches_comment_id" value="${
                                            comment.id
                                        }">
                                        <h5 class="reply-form-title mb-2">Write a reply to ${escapeHtml(
                                            comment.name
                                        )}</h5>
                                        <div class="mb-2"><input type="text" class="form-control form-control-sm form-control-futuristic" name="name" placeholder="Your Name" required></div>
                                        <div class="mb-2"><textarea class="form-control form-control-sm form-control-futuristic" name="comment" rows="3" placeholder="Your Reply..." required></textarea></div>
                                        <button type="submit" class="btn btn-primary-themed btn-sm">Submit Reply</button>
                                        <button type="button" class="btn btn-secondary-themed btn-sm ms-2" data-bs-toggle="collapse" data-bs-target="#replyForm-${
                                            comment.id
                                        }">Cancel</button>
                                    </form>
                                </div>
                            </div>
                            <div class="replies-list ps-4 mt-3 collapse" id="replies-for-comment-${
                                comment.id
                            }">${repliesHtml}</div>
                        </div>`;
                    });
                    if (commentsListContainer) {
                        commentsListContainer.insertAdjacentHTML(
                            "beforeend",
                            allCommentsHtml
                        );
                    }
                    currentPage++;
                    this.dataset.page = currentPage;
                }

                if (!newData.next_page_url) {
                    const loadMoreContainer = this.parentElement;
                    if (loadMoreContainer)
                        loadMoreContainer.style.display = "none";
                }
            } catch (error) {
                console.error("Gagal memuat komentar:", error);
                this.textContent = "Gagal Memuat. Coba Lagi.";
            } finally {
                const loadMoreContainer = this.parentElement;
                if (
                    loadMoreContainer &&
                    loadMoreContainer.style.display !== "none"
                ) {
                    this.disabled = false;
                    this.textContent = "Load More Comments";
                }
            }
        });
    }

    // ===================================
    // FUNGSI PENCARIAN HIGHLIGHT
    // ===================================
    if (searchableContentElement && searchInput) {
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

        function highlightText(element, searchTerm) {
            removeHighlights();
            if (!element || !searchTerm) return;
            const escapedSearchTerm = searchTerm.replace(
                /[.*+?^${}()|[\]\\]/g,
                "\\$&"
            );
            const regex = new RegExp(escapedSearchTerm, "gi");

            function traverse(node) {
                if (node.nodeType === 3) {
                    // Text node
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
                event.preventDefault(); // Mencegah form mengirim ke server
                performSearch();
            });
        }
    }
});

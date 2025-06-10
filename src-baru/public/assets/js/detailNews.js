document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("globalSearchInput");
  const searchForm = document.getElementById("navSearchFormGlobal");

  // Tentukan area konten utama yang akan dicari.
  // Untuk detailNews.html, kita akan menggunakan '.news-article-wrapper'.
  // Jika Anda memiliki halaman detail lain (seperti launchesdetail), Anda mungkin perlu
  // menyesuaikan selector ini atau membuat logika untuk mendeteksi area konten yang tepat.
  const searchableContentElement = document.querySelector(
    ".news-article-wrapper"
  );

  let originalContentHTML = ""; // Untuk menyimpan HTML asli dari area yang bisa dicari

  if (searchableContentElement) {
    originalContentHTML = searchableContentElement.innerHTML;
  } else {
    console.warn(
      "Area konten yang dapat dicari (.news-article-wrapper) tidak ditemukan. Fungsi pencarian mungkin tidak bekerja."
    );
    return; // Keluar jika area konten tidak ditemukan
  }

  function removeHighlights() {
    if (searchableContentElement) {
      // Mengembalikan konten ke kondisi asli untuk menghapus semua <mark>
      // Ini adalah pendekatan sederhana. Untuk halaman yang sangat dinamis,
      // pendekatan yang lebih canggih mungkin diperlukan untuk mempertahankan state.
      searchableContentElement.innerHTML = originalContentHTML;
    }
  }

  function performSearch() {
    const searchTerm = searchInput.value.trim();

    // Hapus sorotan sebelumnya
    removeHighlights();

    if (searchTerm === "") {
      return; // Jika input kosong, tidak ada yang perlu dicari atau disorot
    }

    if (!searchableContentElement || !originalContentHTML) {
      return; // Pastikan elemen dan konten asli ada
    }

    try {
      // Escape karakter spesial Regex dari istilah pencarian untuk mencegah error
      const escapedSearchTerm = searchTerm.replace(
        /[.*+?^${}()|[\]\\]/g,
        "\\$&"
      );
      const regex = new RegExp(escapedSearchTerm, "gi"); // 'g' untuk global, 'i' untuk case-insensitive

      // Buat konten baru dengan kata yang cocok ditandai <mark>
      // Penting: Operasi .replace pada originalContentHTML dan kemudian mengatur innerHTML
      // akan membuat ulang DOM di dalam searchableContentElement.
      // Ini berarti event listener yang ditambahkan secara dinamis ke elemen di dalamnya mungkin hilang.
      // Untuk kasus penggunaan sederhana, ini biasanya cukup.
      let newHTML = originalContentHTML.replace(regex, (match) => {
        return `<mark class="search-highlight">${match}</mark>`;
      });
      searchableContentElement.innerHTML = newHTML;
    } catch (e) {
      console.error("Error saat melakukan pencarian dengan RegExp:", e);
      // Jika ada error (misalnya, Regex tidak valid), kembalikan ke konten asli
      removeHighlights();
    }
  }

  if (searchInput) {
    // Cari saat pengguna mengetik (dengan sedikit delay untuk performa jika diperlukan,
    // namun untuk implementasi ini kita langsung panggil)
    searchInput.addEventListener("input", performSearch);

    // Hapus sorotan jika input dikosongkan
    searchInput.addEventListener("search", () => {
      // Event 'search' dipicu saat ikon 'x' di input[type=search] diklik
      if (searchInput.value === "") {
        removeHighlights();
      }
    });
  }

  if (searchForm) {
    searchForm.addEventListener("submit", (event) => {
      event.preventDefault(); // Mencegah form submit dan reload halaman
      performSearch(); // Lakukan pencarian saat form disubmit (misalnya, tekan Enter)
    });
  }
});

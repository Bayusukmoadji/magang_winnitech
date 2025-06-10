document.addEventListener("DOMContentLoaded", function () {
  const cardsContainer = document.querySelector(".row.g-4"); // Kontainer yang membungkus semua kolom kartu
  if (!cardsContainer) {
    console.warn("Kontainer kartu berita (.row.g-4) tidak ditemukan.");
    return;
  }

  // Mengambil semua elemen anak langsung dari cardsContainer yang merupakan kolom kartu
  const allCardCols = Array.from(cardsContainer.children).filter((child) =>
    child.classList.contains("col")
  );
  const loadMoreButton = document.getElementById("loadMoreButton");

  if (!loadMoreButton) {
    console.warn('Tombol "Load More" (ID: loadMoreButton) tidak ditemukan.');
    // Jika tidak ada tombol, tampilkan saja semua kartu yang ada (jika ada)
    allCardCols.forEach((cardCol) => {
      cardCol.style.display = ""; // Menghapus style display none
    });
    return;
  }

  const itemsPerLoad = 8; // Jumlah kartu yang ditampilkan per klik
  let currentlyVisibleItems = 0;

  function updateButtonVisibility() {
    if (currentlyVisibleItems >= allCardCols.length) {
      loadMoreButton.style.display = "none"; // Sembunyikan tombol jika semua kartu sudah tampil
    } else {
      // Tampilkan tombol jika masih ada kartu untuk dimuat
      // Menggunakan 'inline-block' agar sesuai dengan perilaku default tombol dan ikon di sampingnya
      loadMoreButton.style.display = "inline-block";
    }
  }

  function showNextItems() {
    const itemsToReveal = []; // Array untuk menyimpan kartu yang akan ditampilkan
    for (let i = 0; i < itemsPerLoad; i++) {
      const itemIndex = currentlyVisibleItems + i;
      if (itemIndex < allCardCols.length) {
        if (allCardCols[itemIndex]) {
          // Pastikan elemen ada
          itemsToReveal.push(allCardCols[itemIndex]);
        }
      } else {
        break; // Tidak ada lagi item untuk ditampilkan
      }
    }

    itemsToReveal.forEach((item) => {
      // Mengatur display ke '' akan mengembalikan ke nilai default CSS untuk elemen tersebut
      // (biasanya 'block' atau 'flex' untuk kolom Bootstrap)
      item.style.display = "";
    });

    currentlyVisibleItems += itemsToReveal.length;
    updateButtonVisibility(); // Perbarui visibilitas tombol setelah menampilkan item
  }

  // Pengaturan Awal
  if (allCardCols.length > 0) {
    // Sembunyikan semua kartu terlebih dahulu
    allCardCols.forEach((cardCol) => {
      cardCol.style.display = "none";
    });

    showNextItems(); // Tampilkan batch pertama (misalnya, 8 kartu)
  } else {
    // Jika tidak ada kartu sama sekali, sembunyikan tombol
    loadMoreButton.style.display = "none";
  }

  // Event Listener untuk tombol "Load More"
  loadMoreButton.addEventListener("click", function () {
    // Opsional: Tambahkan indikator loading di sini jika diinginkan
    // loadMoreButton.disabled = true; // Nonaktifkan tombol selama proses
    // const loadingIndicator = document.getElementById('loadingIndicator'); // Jika Anda menambahkannya
    // if(loadingIndicator) loadingIndicator.style.display = 'block';

    // Panggil fungsi untuk menampilkan item berikutnya
    showNextItems();

    // Opsional: Hapus indikator loading dan aktifkan kembali tombol
    // setTimeout(() => { // Contoh dengan delay, bisa juga tanpa jika proses cepat
    //    loadMoreButton.disabled = false;
    //    if(loadingIndicator) loadingIndicator.style.display = 'none';
    // }, 300); // Sesuaikan delay jika perlu
  });
});

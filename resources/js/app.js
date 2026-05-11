import './bootstrap';
//DROPDOWN
function toggleDropdown() {
  const dropdown = document.getElementById("dropdown");
  if (dropdown) {
    dropdown.classList.toggle("hidden");
  }
}

// klik luar dropdown (auto close)
window.addEventListener("click", function (e) {
  if (!e.target.closest(".relative")) {
    const dropdown = document.getElementById("dropdown");
    if (dropdown) dropdown.classList.add("hidden");
  }
});


//MODAL
function lihatDetail(id, perusahaan, judul, deskripsi, kategori, lokasi, tanggal, target, status) {

  // HALAMAN RIWAYAT
  if (document.getElementById("dPerusahaan")) {
    document.getElementById("dPerusahaan").innerText = perusahaan;
    document.getElementById("dJudul").innerText = judul;
    document.getElementById("dDeskripsi").innerText = deskripsi;
    document.getElementById("dKategori").innerText = kategori;
    document.getElementById("dLokasi").innerText = lokasi;
    document.getElementById("dTanggal").innerText = tanggal;
    document.getElementById("dTarget").innerText = target;

    let mouHTML = "";

    if (status.trim().toLowerCase() === "selesai") {
      mouHTML = `
        <a href="../pdf/generate-mou.php?id=${id}"
           target="_blank"
           class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded-lg">
           📄 Download MOU
        </a>
      `;
    }

    document.getElementById("mouArea").innerHTML = mouHTML;

    const modal = document.getElementById("modalDetail");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
  }

  // HALAMAN PERUSAHAAN
  if (document.getElementById("dEmail")) {
    document.getElementById("dEmail").innerText = perusahaan;
    document.getElementById("dJudul").innerText = judul;
    document.getElementById("dDeskripsi").innerText = deskripsi;
    document.getElementById("dKategori").innerText = kategori;
    document.getElementById("dLokasi").innerText = lokasi;
    document.getElementById("dTanggal").innerText = tanggal;
    document.getElementById("dTarget").innerText = target;

    let actionHTML = "";

    status = status.toLowerCase().trim();

    if (status === "terkirim") {
      actionHTML = `
        <div class="flex gap-2">
          <a href="update-status.php?id=${id}&status=pendanaan"
             class="bg-green-500 text-white px-3 py-1 rounded">
             Terima
          </a>

          <a href="hapus-proposal.php?id=${id}"
             class="bg-red-600 text-white px-3 py-1 rounded"
             onclick="return confirm('Yakin ingin menolak & menghapus proposal?')">
             Tolak
          </a>
        </div>
      `;
    }
    else if (status === "pendanaan") {
      actionHTML = `
        <a href="form-pendanaan.php?id=${id}"
           class="bg-blue-600 text-white px-3 py-1 rounded">
           💰 Isi Pendanaan
        </a>
      `;
    }
    else if (status === "selesai") {
      actionHTML = `
        <a href="../pdf/generate-mou.php?id=${id}"
           class="bg-purple-600 text-white px-3 py-1 rounded">
           📄 Generate MOU
        </a>
      `;
    }
    else {
      actionHTML = `<span class="text-gray-500">Tidak ada aksi</span>`;
    }

    document.getElementById("actionArea").innerHTML = actionHTML;

    const modal = document.getElementById("modal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
  }
}

function lihatPDF(file) {
    const modal = document.getElementById("modalPDF");
    const frame = document.getElementById("pdfFrame");

    // 👇 INI YANG KAMU TAMBAH
    frame.src = "../uploads/" + file + "#toolbar=1";

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closePDF() {
    const modal = document.getElementById("modalPDF");
    const frame = document.getElementById("pdfFrame");

    frame.src = "";
    modal.classList.add("hidden");
}

//CLOSE MODAL
function closeModal() {
  const modal1 = document.getElementById("modalDetail");
  if (modal1) {
    modal1.classList.add("hidden");
    modal1.classList.remove("flex");
  }

  const modal2 = document.getElementById("modal");
  if (modal2) {
    modal2.classList.add("hidden");
    modal2.classList.remove("flex");
  }
}

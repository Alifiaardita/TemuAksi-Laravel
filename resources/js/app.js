import './bootstrap';

// DROPDOWN
window.toggleDropdown = function () {
  const dropdown = document.getElementById("dropdown");
  if (dropdown) dropdown.classList.toggle("hidden");
};

window.addEventListener("click", function (e) {
  if (!e.target.closest(".relative")) {
    const dropdown = document.getElementById("dropdown");
    if (dropdown) dropdown.classList.add("hidden");
  }
});

// MODAL DETAIL
window.lihatDetail = function (
  id, perusahaan, judul, deskripsi, kategori, lokasi, tanggal, target, status
) {
  const modal = document.getElementById("modalDetail");

  if (!modal) return;

  document.getElementById("dPerusahaan").innerText = perusahaan;
  document.getElementById("dJudul").innerText = judul;
  document.getElementById("dDeskripsi").innerText = deskripsi;
  document.getElementById("dKategori").innerText = kategori;
  document.getElementById("dLokasi").innerText = lokasi;
  document.getElementById("dTanggal").innerText = tanggal;
  document.getElementById("dTarget").innerText = target;

  let mouHTML = "";

  if (status?.trim().toLowerCase() === "pendanaan") {
      mouHTML = `
          <div class="border-t border-gray-100 pt-4">
              <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2">Dokumen MOU</p>
              <a href="/proposal/${id}/mou"
                target="_blank"
                class="flex items-center gap-2 bg-[#0f1e45] text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-[#1a3a6e] transition w-fit">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                  Download MOU
             </a>
          </div>
      `;
  }

  document.getElementById("mouArea").innerHTML = mouHTML;

  modal.classList.remove("hidden");
  modal.classList.add("flex");
};

// PDF MODAL
window.lihatPDF = function (file) {
  const modal = document.getElementById("modalPDF");
  const frame = document.getElementById("pdfFrame");

  if (!modal || !frame) return;

  frame.src = "/storage/proposals/" + file + "#toolbar=1";

  modal.classList.remove("hidden");
  modal.classList.add("flex");
};

window.closePDF = function () {
  const modal = document.getElementById("modalPDF");
  const frame = document.getElementById("pdfFrame");

  if (frame) frame.src = "";
  if (modal) {
    modal.classList.add("hidden");
    modal.classList.remove("flex");
  }
};

window.closeModal = function () {
  const modal1 = document.getElementById("modalDetail");
  const modal2 = document.getElementById("modal");

  if (modal1) {
    modal1.classList.add("hidden");
    modal1.classList.remove("flex");
  }

  if (modal2) {
    modal2.classList.add("hidden");
    modal2.classList.remove("flex");
  }
};

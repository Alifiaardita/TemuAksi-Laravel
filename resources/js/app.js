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

  if (status?.trim().toLowerCase() === "selesai") {
    mouHTML = `
      <a href="/pdf/generate-mou/${id}"
         target="_blank"
         class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded-lg">
         📄 Download MOU
      </a>
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

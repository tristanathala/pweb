const tabel = document.getElementById("tabelAnggota");
const daftar = getAnggota();

for (let i = 0; i < daftar.length; i++) {
  const a = daftar[i];
  const baris = document.createElement("tr");
  baris.innerHTML = `
    <td>${i + 1}</td>
    <td>${a.nama}</td>
    <td>${a.nim}</td>
    <td>${a.prodi}</td>
    <td>${a.jenis}</td>
  `;
  tabel.appendChild(baris);
}

if (daftar.length === 0) {
  tabel.innerHTML = `<tr><td colspan="5" class="text-center">Belum ada data anggota.</td></tr>`;
}

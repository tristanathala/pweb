if (sessionStorage.getItem("login") !== "true") {
  alert("Silakan login sebagai petugas terlebih dahulu.");
  window.location.href = "login.html";
}

const tabel = document.getElementById("tabelAnggota");
const inputCari = document.getElementById("cari");
const boxDetail = document.getElementById("boxDetail");
const boxEdit = document.getElementById("boxEdit");
const formEdit = document.getElementById("formEdit");

let indexEdit = -1;

function tampilkanTabel() {
  const daftar = getAnggota();
  const kataKunci = inputCari.value.toLowerCase();

  tabel.innerHTML = "";
  let nomor = 1;

  for (let i = 0; i < daftar.length; i++) {
    const a = daftar[i];

    const cocok = a.nama.toLowerCase().includes(kataKunci) || a.nim.includes(kataKunci);
    if (!cocok) continue;

    const baris = document.createElement("tr");
    baris.innerHTML = `
      <td>${nomor}</td>
      <td>${a.nama}</td>
      <td>${a.nim}</td>
      <td>${a.jenis}</td>
      <td>
        <button class="btn btn-info btn-sm" onclick="lihatDetail(${i})">Detail</button>
        <button class="btn btn-warning btn-sm" onclick="bukaEdit(${i})">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="hapusAnggota(${i})">Hapus</button>
      </td>
    `;
    tabel.appendChild(baris);
    nomor++;
  }

  if (nomor === 1) {
    tabel.innerHTML = `<tr><td colspan="5" class="text-center">Belum ada data anggota.</td></tr>`;
  }
}

function lihatDetail(i) {
  const a = getAnggota()[i];
  document.getElementById("isiDetail").innerHTML = `
    <p><strong>Nama:</strong> ${a.nama}</p>
    <p><strong>NIM/NIP:</strong> ${a.nim}</p>
    <p><strong>Program Studi:</strong> ${a.prodi}</p>
    <p><strong>Alamat:</strong> ${a.alamat}</p>
    <p><strong>Telepon:</strong> ${a.telepon}</p>
    <p><strong>Email:</strong> ${a.email}</p>
    <p><strong>Jenis:</strong> ${a.jenis}</p>
  `;
  boxEdit.style.display = "none";
  boxDetail.style.display = "block";
}

function bukaEdit(i) {
  const a = getAnggota()[i];
  indexEdit = i;

  document.getElementById("editNama").value = a.nama;
  document.getElementById("editNim").value = a.nim;
  document.getElementById("editProdi").value = a.prodi;
  document.getElementById("editAlamat").value = a.alamat;
  document.getElementById("editTelepon").value = a.telepon;
  document.getElementById("editEmail").value = a.email;
  document.getElementById("editJenis").value = a.jenis;
  document.getElementById("editError").innerHTML = "";

  boxDetail.style.display = "none";
  boxEdit.style.display = "block";
}

function hapusAnggota(i) {
  const daftar = getAnggota();
  const yakin = confirm("Yakin ingin menghapus " + daftar[i].nama + "?");
  if (!yakin) return;

  daftar.splice(i, 1);
  simpanAnggota(daftar);

  boxDetail.style.display = "none";
  boxEdit.style.display = "none";
  tampilkanTabel();
  tampilkanNotif("Data anggota berhasil dihapus.", "sukses");
}

formEdit.addEventListener("submit", function (event) {
  event.preventDefault();

  const daftar = getAnggota();
  const nimLama = daftar[indexEdit].nim;

  const anggota = {
    nama: document.getElementById("editNama").value.trim(),
    nim: document.getElementById("editNim").value.trim(),
    prodi: document.getElementById("editProdi").value.trim(),
    alamat: document.getElementById("editAlamat").value.trim(),
    telepon: document.getElementById("editTelepon").value.trim(),
    email: document.getElementById("editEmail").value.trim(),
    jenis: document.getElementById("editJenis").value,
  };

  const errors = validasiAnggota(anggota, nimLama);
  const editError = document.getElementById("editError");
  editError.innerHTML = "";

  if (errors.length > 0) {
    for (let i = 0; i < errors.length; i++) {
      const li = document.createElement("li");
      li.textContent = errors[i];
      editError.appendChild(li);
    }
    return;
  }

  daftar[indexEdit] = anggota;
  simpanAnggota(daftar);

  boxEdit.style.display = "none";
  tampilkanTabel();
  tampilkanNotif("Data anggota berhasil diperbarui.", "sukses");
});

document.getElementById("tutupDetail").addEventListener("click", function () {
  boxDetail.style.display = "none";
});

document.getElementById("batalEdit").addEventListener("click", function () {
  boxEdit.style.display = "none";
});

document.getElementById("tombolKeluar").addEventListener("click", function () {
  sessionStorage.removeItem("login");
  window.location.href = "login.html";
});

inputCari.addEventListener("input", tampilkanTabel);

tampilkanTabel();

const form = document.getElementById("formDaftar");
const errorList = document.getElementById("errorList");

form.addEventListener("submit", function (event) {
  event.preventDefault();

  const anggota = {
    nama: document.getElementById("nama").value.trim(),
    nim: document.getElementById("nim").value.trim(),
    prodi: document.getElementById("prodi").value.trim(),
    alamat: document.getElementById("alamat").value.trim(),
    telepon: document.getElementById("telepon").value.trim(),
    email: document.getElementById("email").value.trim(),
    jenis: document.getElementById("jenis").value,
  };

  errorList.innerHTML = "";

  const errors = validasiAnggota(anggota, "");

  if (errors.length > 0) {
    for (let i = 0; i < errors.length; i++) {
      const li = document.createElement("li");
      li.textContent = errors[i];
      errorList.appendChild(li);
    }
    tampilkanNotif("Pendaftaran gagal, periksa kembali data Anda.", "gagal");
    return;
  }

  const daftar = getAnggota();
  daftar.push(anggota);
  simpanAnggota(daftar);

  tampilkanNotif("Pendaftaran berhasil! Data " + anggota.nama + " sudah disimpan.", "sukses");
  form.reset();
});

const dataAwal = [
  {
    nama: "Andi Saputra",
    nim: "5025231001",
    prodi: "Teknik Informatika",
    alamat: "Jl. Keputih Tegal No. 12, Surabaya",
    telepon: "081234567801",
    email: "andi.saputra@student.ac.id",
    jenis: "Mahasiswa",
  },
  {
    nama: "Siti Nurhaliza",
    nim: "5026231045",
    prodi: "Sistem Informasi",
    alamat: "Jl. Mulyosari No. 7, Surabaya",
    telepon: "081298765432",
    email: "siti.nurhaliza@student.ac.id",
    jenis: "Mahasiswa",
  },
  {
    nama: "Rizky Pratama",
    nim: "5022221088",
    prodi: "Teknik Elektro",
    alamat: "Jl. Gebang Lor No. 30, Surabaya",
    telepon: "085711223344",
    email: "rizky.pratama@student.ac.id",
    jenis: "Mahasiswa",
  },
  {
    nama: "Dewi Lestari",
    nim: "197805122005012001",
    prodi: "Teknik Informatika",
    alamat: "Perum Pakuwon City Blok C-5, Surabaya",
    telepon: "081355667788",
    email: "dewi.lestari@kampus.ac.id",
    jenis: "Dosen",
  },
  {
    nama: "Budi Santoso",
    nim: "198203152010121002",
    prodi: "Matematika",
    alamat: "Jl. Klampis Jaya No. 21, Surabaya",
    telepon: "082144556677",
    email: "budi.santoso@kampus.ac.id",
    jenis: "Dosen",
  },
  {
    nama: "Rina Wulandari",
    nim: "199011032015042003",
    prodi: "Bagian Akademik",
    alamat: "Jl. Arief Rahman Hakim No. 45, Surabaya",
    telepon: "087899001122",
    email: "rina.wulandari@kampus.ac.id",
    jenis: "Tenaga Kependidikan",
  },
];

function getAnggota() {
  const data = localStorage.getItem("anggota");
  if (data === null) {
    return dataAwal;
  }
  return JSON.parse(data);
}

function simpanAnggota(daftar) {
  localStorage.setItem("anggota", JSON.stringify(daftar));
}

function validasiAnggota(anggota, nimLama) {
  const errors = [];

  if (anggota.nama === "") errors.push("Nama wajib diisi.");
  if (anggota.nim === "") errors.push("NIM/NIP wajib diisi.");
  if (anggota.prodi === "") errors.push("Program studi wajib diisi.");
  if (anggota.alamat === "") errors.push("Alamat wajib diisi.");
  if (anggota.telepon === "") errors.push("Nomor telepon wajib diisi.");
  if (anggota.email === "") errors.push("Email wajib diisi.");
  if (anggota.jenis === "") errors.push("Jenis keanggotaan wajib dipilih.");

  const polaEmail = /^\S+@\S+\.\S+$/;
  if (anggota.email !== "" && !polaEmail.test(anggota.email)) {
    errors.push("Format email tidak valid.");
  }

  const daftar = getAnggota();
  for (let i = 0; i < daftar.length; i++) {
    if (daftar[i].nim === anggota.nim && daftar[i].nim !== nimLama) {
      errors.push("NIM/NIP sudah terdaftar.");
      break;
    }
  }

  return errors;
}

function tampilkanNotif(pesan, jenis) {
  const notif = document.getElementById("notif");
  notif.textContent = pesan;
  notif.className = "notif " + jenis;

  setTimeout(function () {
    notif.className = "notif";
  }, 3000);
}

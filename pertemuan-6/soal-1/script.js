var dosenArr = [
  "Ahmad Saikhu", "Anny Yuniarti", "Ary Mazharuddin Shiddiqi", "Chastine Fatichah",
  "Daniel Oranova Siahaan", "Dwi Sunaryono", "Fajar Baskoro", "Hadziq Fabroyir",
  "Rully Soelaiman", "Royyana Muslim Ijtihadie", "Siti Rochimah", "Tohari Ahmad",
  "Waskitho Wibisono"
];

var dosenInput = document.getElementById("dosen");
var suggestionList = document.getElementById("suggestions");

dosenInput.addEventListener("input", function () {
  var text = dosenInput.value.toLowerCase();
  suggestionList.innerHTML = "";
  if (text === "") return;

  dosenArr.forEach(function (name) {
    if (name.toLowerCase().indexOf(text) === 0) {
      var item = document.createElement("li");
      item.textContent = name;
      item.onclick = function () {
        dosenInput.value = name;
        suggestionList.innerHTML = "";
      };
      suggestionList.appendChild(item);
    }
  });
});

document.addEventListener("click", function (e) {
  if (e.target !== dosenInput) suggestionList.innerHTML = "";
});

function validate() {
  var nama = document.getElementById("nama").value.trim();
  var nim = document.getElementById("nim").value.trim();
  var matkul = document.getElementById("matkul").value;
  var dosen = dosenInput.value.trim();

  if (nama === "") { alert("Nama Tidak Boleh Kosong"); return false; }
  if (nim === "") { alert("NIM Tidak Boleh Kosong"); return false; }
  if (isNaN(nim)) { alert("NIM Harus Berupa Angka"); return false; }
  if (matkul === "") { alert("Mata Kuliah Harus Dipilih"); return false; }
  if (dosen === "") { alert("Dosen Tidak Boleh Kosong"); return false; }

  alert("Registrasi Berhasil\n\nNama " + nama + "\nNIM " + nim +
        "\nMata Kuliah " + matkul + "\nDosen " + dosen);
  return false;
}

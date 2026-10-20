var postalData = {
  "Jawa Timur": {
    "Surabaya": {
      "Sukolilo": { "Keputih": "60111", "Gebang Putih": "60117", "Klampis Ngasem": "60117",
                    "Menur Pumpungan": "60118", "Nginden Jangkungan": "60118", "Semolowaru": "60119",
                    "Medokan Semampir": "60119" },
      "Gubeng": { "Gubeng": "60281", "Mojo": "60285", "Airlangga": "60286" },
      "Genteng": { "Embong Kaliasin": "60271", "Ketabang": "60272", "Genteng": "60275" },
      "Wonokromo": { "Darmo": "60241", "Wonokromo": "60243", "Ngagel": "60246" },
      "Tegalsari": { "Tegalsari": "60262", "Dr. Soetomo": "60264" }
    },
    "Malang": {
      "Klojen": { "Klojen": "65111", "Oro-oro Dowo": "65119" },
      "Lowokwaru": { "Lowokwaru": "65141", "Dinoyo": "65144", "Ketawanggede": "65145" }
    }
  },
  "Jawa Barat": {
    "Bandung": {
      "Sumur Bandung": { "Braga": "40111", "Merdeka": "40113" },
      "Coblong": { "Lebak Siliwangi": "40132", "Sekeloa": "40134", "Dago": "40135" }
    }
  },
  "DKI Jakarta": {
    "Jakarta Pusat": {
      "Gambir": { "Gambir": "10110" },
      "Menteng": { "Menteng": "10310", "Cikini": "10330", "Kebon Sirih": "10340", "Gondangdia": "10350" }
    },
    "Jakarta Selatan": {
      "Kebayoran Baru": { "Gunung": "12120", "Melawai": "12160", "Senayan": "12190" }
    }
  }
};

var provSelect = document.getElementById("provinsi");
var kotaSelect = document.getElementById("kota");

function fillSelect(select, items) {
  select.innerHTML = "";
  items.forEach(function (item) { select.add(new Option(item, item)); });
}

function fillKota() {
  fillSelect(kotaSelect, Object.keys(postalData[provSelect.value]));
}

function search() {
  var prov = provSelect.value;
  var kota = kotaSelect.value;
  var rawKeyword = document.getElementById("keyword").value.trim();
  var keyword = rawKeyword.toLowerCase();
  var results = [];

  var kecList = postalData[prov][kota];
  for (var kec in kecList) {
    for (var kel in kecList[kec]) {
      var code = kecList[kec][kel];
      if (keyword === "" || kel.toLowerCase().indexOf(keyword) !== -1 ||
          kec.toLowerCase().indexOf(keyword) !== -1 || code.indexOf(keyword) !== -1) {
        results.push({ kel: kel, kec: kec, code: code });
      }
    }
  }

  var html = "<h2>Hasil Pencarian</h2>";
  html += '<p class="info">Hasil pencarian kode pos dengan menggunakan kata kunci <b>"' +
          rawKeyword + '"</b> telah ditemukan sebanyak ' + results.length + " buah.</p>";

  results.forEach(function (r) {
    html += '<div class="result"><div class="result-title">' + r.kel + '</div>' +
            '<div class="result-body">Kode pos <b>' + r.code + '</b> untuk daerah Kelurahan ' + r.kel +
            ', Kecamatan ' + r.kec + '.</div></div>';
  });

  document.getElementById("output").innerHTML = html;
}

document.getElementById("keyword").addEventListener("keydown", function (e) {
  if (e.key === "Enter") search();
});

fillSelect(provSelect, Object.keys(postalData));
fillKota();

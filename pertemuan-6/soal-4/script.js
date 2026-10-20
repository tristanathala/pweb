var brandArr = {
  "Desktop": ["Dell", "HP", "Lenovo", "Acer"],
  "Laptop": ["Asus", "Acer", "Lenovo", "Apple", "MSI"],
  "Smartphone": ["Samsung", "Xiaomi", "Oppo", "Apple", "Vivo"]
};

function changeBrand() {
  var type = document.getElementById("jenis").value;
  var brandSelect = document.getElementById("merk");

  brandSelect.innerHTML = '<option value="">Pilih Merk</option>';

  if (type !== "") {
    brandArr[type].forEach(function (brand) {
      var option = document.createElement("option");
      option.value = brand;
      option.textContent = brand;
      brandSelect.appendChild(option);
    });
  }
}

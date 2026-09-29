const form = document.querySelector("#form-kontak");
const hasil = document.querySelector("#hasil");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    const nama = document.querySelector("#nama").value.trim();
    const email = document.querySelector("#email").value.trim();
    const pesan = document.querySelector("#pesan").value.trim();
    if (nama === "" || pesan === "") {
        hasil.textContent = "Nama dan pesan tidak boleh hanya berisi spasi.";
        return;
    }
    hasil.textContent = "Terima kasih, " + nama + ". Formulir dengan email " + email + " berhasil divalidasi. Ini hanya simulasi; pesan tidak dikirim.";
    form.reset();
});

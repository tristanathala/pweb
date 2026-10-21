const formLogin = document.getElementById("formLogin");

formLogin.addEventListener("submit", function (event) {
  event.preventDefault();

  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  if (username === "admin" && password === "admin") {
    sessionStorage.setItem("login", "true");
    tampilkanNotif("Login berhasil! Mengalihkan ke halaman kelola anggota...", "sukses");

    setTimeout(function () {
      window.location.href = "kelola.html";
    }, 1000);
  } else {
    tampilkanNotif("Username atau password salah.", "gagal");
  }
});

<?php
$base = '../';
require '../config/database.php';
require '../includes/auth.php';

if (is_logged_in()) {
    header('Location: ' . dashboard_url($base));
    exit;
}

$nama = '';
$email = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $konfirmasi = $_POST['konfirmasi_password'] ?? '';

    if ($nama === '') {
        $errors['nama'] = 'Isi nama lengkap.';
    } elseif (strlen($nama) > 100) {
        $errors['nama'] = 'Nama lengkap maksimal 100 karakter.';
    }

    if ($email === '') {
        $errors['email'] = 'Isi email.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid.';
    } else {
        $stmt = mysqli_prepare($conn, 'SELECT id_user FROM users WHERE email = ?');
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors['email'] = 'Email ini sudah terdaftar. Gunakan email lain atau masuk dengan email ini.';
        }
        mysqli_stmt_close($stmt);
    }

    if (strlen($password) < 8) {
        $errors['password'] = 'Password minimal 8 karakter.';
    }

    if ($konfirmasi !== $password) {
        $errors['konfirmasi_password'] = 'Password yang diulang tidak sama.';
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $role = 'siswa';

        $stmt = mysqli_prepare($conn, 'INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'ssss', $nama, $email, $hash, $role);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        set_flash('success', 'Akun berhasil dibuat. Masuk dengan email dan password yang baru kamu buat.');
        header('Location: login.php');
        exit;
    }
}

function invalid($errors, $field)
{
    return isset($errors[$field]) ? 'is-invalid' : '';
}

$page_title = 'Registrasi Siswa';
$active = '';
require '../includes/header.php';
?>

<main class="d-flex">
    <div class="container-fluid p-0 d-flex flex-column flex-lg-row flex-grow-1">
        <section class="auth-side col-lg-5 p-4 p-lg-5 d-flex flex-column justify-content-center">
            <h1 class="mb-3">Buat Akun Pendaftaran</h1>
            <p>Akun ini dipakai untuk mengisi biodata, memilih jurusan, mengunggah berkas dan melihat hasil seleksi.</p>
            <p class="mb-0">Setelah akun dibuat, masuk lalu lengkapi biodata di dashboard siswa.</p>
        </section>

        <section class="col-lg-7 p-4 p-lg-5 d-flex align-items-center justify-content-center">
            <div class="form-wrap">
                <h2 class="h4 mb-4">Data akun</h2>
                <form method="post" action="register.php" novalidate>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama lengkap</label>
                        <input type="text" class="form-control <?= invalid($errors, 'nama') ?>" id="nama" name="nama"
                               value="<?= e($nama) ?>" maxlength="100" autocomplete="name">
                        <div class="invalid-feedback"><?= $errors['nama'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?= invalid($errors, 'email') ?>" id="email" name="email"
                               value="<?= e($email) ?>" autocomplete="email">
                        <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= invalid($errors, 'password') ?>" id="password" name="password"
                               autocomplete="new-password" aria-describedby="password-help">
                        <div id="password-help" class="form-text">Minimal 8 karakter.</div>
                        <div class="invalid-feedback"><?= $errors['password'] ?? '' ?></div>
                    </div>
                    <div class="mb-4">
                        <label for="konfirmasi_password" class="form-label">Ulangi password</label>
                        <input type="password" class="form-control <?= invalid($errors, 'konfirmasi_password') ?>" id="konfirmasi_password"
                               name="konfirmasi_password" autocomplete="new-password">
                        <div class="invalid-feedback"><?= $errors['konfirmasi_password'] ?? '' ?></div>
                    </div>
                    <button type="submit" class="btn btn-papan w-100">Buat akun</button>
                </form>
                <p class="mt-4 mb-0">Sudah punya akun? <a href="login.php" class="fw-semibold">Masuk</a></p>
            </div>
        </section>
    </div>
</main>

<?php require '../includes/footer.php'; ?>

<?php
$base = '../';
require '../config/database.php';
require '../includes/auth.php';

if (is_logged_in()) {
    header('Location: ' . dashboard_url($base));
    exit;
}

$email = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Isi email dan password.';
    } else {
        $stmt = mysqli_prepare($conn, 'SELECT id_user, nama, password, role FROM users WHERE email = ?');
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];

            header('Location: ' . dashboard_url($base));
            exit;
        }

        $error = 'Email atau password salah.';
    }
}

$page_title = 'Masuk';
$active = '';
require '../includes/header.php';
?>

<main class="d-flex">
    <div class="container-fluid p-0 d-flex flex-column flex-lg-row flex-grow-1">
        <section class="auth-side col-lg-5 p-4 p-lg-5 d-flex flex-column justify-content-center">
            <h1 class="mb-3">Masuk ke Akun PPDB</h1>
            <p class="mb-0">Calon siswa dan panitia masuk dari halaman yang sama. Setelah masuk, kamu langsung diarahkan ke dashboard sesuai akunmu.</p>
        </section>

        <section class="col-lg-7 p-4 p-lg-5 d-flex align-items-center justify-content-center">
            <div class="form-wrap">
                <?php show_flash(); ?>
                <?php if ($error !== ''): ?>
                    <div class="alert alert-danger"><?= e($error) ?></div>
                <?php endif; ?>

                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= e($email) ?>"
                               autocomplete="username" required>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               autocomplete="current-password" required>
                    </div>
                    <p class="small mb-4"><a href="../kontak.php">Lupa password? Hubungi panitia</a></p>
                    <button type="submit" class="btn btn-papan w-100">Masuk</button>
                </form>
                <p class="mt-4 mb-0">Belum punya akun? <a href="register.php" class="fw-semibold">Buat akun</a></p>
            </div>
        </section>
    </div>
</main>

<?php require '../includes/footer.php'; ?>

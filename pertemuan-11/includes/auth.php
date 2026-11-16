<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in()
{
    return isset($_SESSION['id_user']);
}

function dashboard_url($base)
{
    if ($_SESSION['role'] === 'admin') {
        return $base . 'admin/dashboard.php';
    }
    return $base . 'siswa/dashboard.php';
}

function require_role($role, $base)
{
    if (!is_logged_in()) {
        set_flash('warning', 'Masuk dulu untuk membuka halaman itu.');
        header('Location: ' . $base . 'auth/login.php');
        exit;
    }

    if ($_SESSION['role'] !== $role) {
        header('Location: ' . dashboard_url($base));
        exit;
    }
}

function set_flash($type, $message)
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function show_flash()
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        echo '<div class="alert alert-' . $flash['type'] . '">' . e($flash['message']) . '</div>';
    }
}

function e($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

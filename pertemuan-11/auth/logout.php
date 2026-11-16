<?php
require '../includes/auth.php';

$_SESSION = [];
session_destroy();

session_start();
set_flash('success', 'Kamu sudah keluar dari akun.');

header('Location: login.php');
exit;

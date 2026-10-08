<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/koneksi.php';

// Ambil input dari form
$judul     = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun     = $_POST['tahun'] ?? null;
$isbn      = trim($_POST['isbn'] ?? '');
$stok      = $_POST['stok'] ?? 0;
$kategori  = trim($_POST['kategori'] ?? '');

// Validasi input sederhana
if (empty($judul) || empty($tahun)) {
    $_SESSION['flash_message'] = [
        'type' => 'danger',
        'text' => 'Judul dan Tahun wajib diisi!'
    ];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) 
         VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)"
    );

    $stmt->execute([
        ':judul'     => $judul,
        ':pengarang' => $pengarang,
        ':tahun'     => (int)$tahun,
        ':isbn'      => $isbn,
        ':stok'      => (int)$stok,
        ':kategori'  => $kategori
    ]);

    $_SESSION['flash_message'] = [
        'type' => 'success',
        'text' => 'Buku berhasil ditambahkan.'
    ];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash_message'] = [
        'type' => 'danger',
        'text' => 'Gagal menyimpan buku: ' . $e->getMessage()
    ];
    header('Location: tambah.php');
    exit;
}
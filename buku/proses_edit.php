<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/koneksi.php';

$id        = $_POST['id'] ?? null;
$judul     = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun     = $_POST['tahun'] ?? null;
$isbn      = trim($_POST['isbn'] ?? '');
$stok      = $_POST['stok'] ?? 0;
$kategori  = trim($_POST['kategori'] ?? '');

if (!$id || empty($judul) || empty($tahun)) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'text' => 'Data tidak lengkap!'];
    header('Location: list.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE buku 
         SET judul = :judul, pengarang = :pengarang, tahun = :tahun, 
             isbn = :isbn, stok = :stok, kategori = :kategori 
         WHERE id = :id"
    );

    $stmt->execute([
        ':id'        => (int)$id,
        ':judul'     => $judul,
        ':pengarang' => $pengarang,
        ':tahun'     => (int)$tahun,
        ':isbn'      => $isbn,
        ':stok'      => (int)$stok,
        ':kategori'  => $kategori
    ]);

    $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Buku berhasil diperbarui.'];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'text' => 'Gagal memperbarui buku: ' . $e->getMessage()];
    header('Location: list.php');
    exit;
}
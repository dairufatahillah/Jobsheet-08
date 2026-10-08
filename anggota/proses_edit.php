<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/koneksi.php';

$id         = $_POST['id'] ?? null;
$nama       = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$no_hp      = trim($_POST['no_hp'] ?? '');
$alamat     = trim($_POST['alamat'] ?? '');

if (!$id || empty($nama)) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'text' => 'Nama wajib diisi!'];
    header('Location: list.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE anggota 
         SET nama = :nama, no_anggota = :no_anggota, no_hp = :no_hp, alamat = :alamat 
         WHERE id = :id"
    );

    $stmt->execute([
        ':id'         => (int)$id,
        ':nama'       => $nama,
        ':no_anggota' => $no_anggota,
        ':no_hp'      => $no_hp,
        ':alamat'     => $alamat
    ]);

    $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Data anggota berhasil diperbarui.'];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'text' => 'Gagal memperbarui anggota: ' . $e->getMessage()];
    header('Location: list.php');
    exit;
}
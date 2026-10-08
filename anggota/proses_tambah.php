<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/koneksi.php';

// Ambil input dari form anggota
$nama       = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? $_POST['email'] ?? '');
$no_hp      = trim($_POST['no_hp'] ?? $_POST['telepon'] ?? '');
$alamat     = trim($_POST['alamat'] ?? '');

if (empty($nama)) {
    $_SESSION['flash_message'] = [
        'type' => 'danger',
        'text' => 'Nama anggota wajib diisi!'
    ];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO anggota (nama, no_anggota, no_hp, alamat) 
         VALUES (:nama, :no_anggota, :no_hp, :alamat)"
    );

    $stmt->execute([
        ':nama'       => $nama,
        ':no_anggota' => $no_anggota,
        ':no_hp'      => $no_hp,
        ':alamat'     => $alamat
    ]);

    $_SESSION['flash_message'] = [
        'type' => 'success',
        'text' => 'Data anggota berhasil ditambahkan.'
    ];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash_message'] = [
        'type' => 'danger',
        'text' => 'Gagal menyimpan anggota: ' . $e->getMessage()
    ];
    header('Location: tambah.php');
    exit;
}
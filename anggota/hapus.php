<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
        $stmt->execute([':id' => (int)$id]);

        $_SESSION['flash_message'] = [
            'type' => 'success',
            'text' => 'Data anggota berhasil dihapus.'
        ];
    } catch (PDOException $e) {
        $_SESSION['flash_message'] = [
            'type' => 'danger',
            'text' => 'Gagal menghapus anggota: ' . $e->getMessage()
        ];
    }
}

header('Location: list.php');
exit;
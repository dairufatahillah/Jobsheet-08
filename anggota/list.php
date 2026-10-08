<?php
$page_title = 'Daftar Anggota';

// Memuat koneksi database PostgreSQL
require_once __DIR__ . '/../includes/koneksi.php';

// Ambil data anggota dari database
try {
    $stmt = $pdo->query("SELECT * FROM anggota ORDER BY id DESC");
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal mengambil data anggota: " . $e->getMessage());
}

include '../includes/header.php';
?>

<section>
    <h2>Daftar Anggota Perpustakaan</h2>
    
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash flash-<?php echo $_SESSION['flash_message']['type']; ?>">
            <?php 
                echo $_SESSION['flash_message']['text']; 
                unset($_SESSION['flash_message']); 
            ?>
        </div>
    <?php endif; ?>

    <p style="margin-bottom: 15px;">
        <a href="tambah.php" class="btn">+ Tambah Anggota Baru</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email / No. Anggota</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($members)): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada data anggota.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($members as $index => $anggota): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($anggota['nama'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($anggota['email'] ?? $anggota['no_anggota'] ?? $anggota['surel'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($anggota['no_hp'] ?? $anggota['telepon'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($anggota['alamat'] ?? '-'); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $anggota['id']; ?>">Edit</a> | 
                            <a href="hapus.php?id=<?php echo $anggota['id']; ?>" onclick="return confirm('Yakin ingin menghapus anggota ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php include '../includes/footer.php'; ?>
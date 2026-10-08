<?php
$page_title = 'Daftar Buku';

require_once __DIR__ . '/../includes/koneksi.php';

try {
    $stmt = $pdo->query("SELECT * FROM buku ORDER BY id DESC");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal mengambil data buku: " . $e->getMessage());
}

include '../includes/header.php';
?>

<section>
    <h2>Daftar Buku</h2>
    
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash flash-<?php echo $_SESSION['flash_message']['type']; ?>">
            <?php 
                echo $_SESSION['flash_message']['text']; 
                unset($_SESSION['flash_message']); 
            ?>
        </div>
    <?php endif; ?>

    <p style="margin-bottom: 15px;">
        <a href="tambah.php" class="btn">+ Tambah Buku Baru</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Tahun</th>
                <th>ISBN</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
        </thead>
        <tbody>
            <?php if (empty($books)): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data buku.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($books as $index => $buku): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($buku['judul'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($buku['pengarang'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($buku['tahun'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($buku['isbn'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($buku['stok'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($buku['kategori'] ?? '-'); ?></td>
                        <td>    
                            <a href="edit.php?id=<?php echo $buku['id']; ?>">Edit</a> | 
                            <a href="hapus.php?id=<?php echo $buku['id']; ?>" onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php include '../includes/footer.php'; ?>
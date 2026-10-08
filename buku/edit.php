<?php
$page_title = 'Edit Buku';
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute([':id' => (int)$id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}

include '../includes/header.php';
?>

<section>
    <h2>Edit Buku</h2>
    <form action="proses_edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">

        <p>
            <label>Judul Buku:</label><br>
            <input type="text" name="judul" value="<?php echo htmlspecialchars($buku['judul']); ?>" required>
        </p>
        <p>
            <label>Pengarang:</label><br>
            <input type="text" name="pengarang" value="<?php echo htmlspecialchars($buku['pengarang'] ?? ''); ?>">
        </p>
        <p>
            <label>Tahun:</label><br>
            <input type="number" name="tahun" value="<?php echo htmlspecialchars($buku['tahun']); ?>" required>
        </p>
        <p>
            <label>ISBN:</label><br>
            <input type="text" name="isbn" value="<?php echo htmlspecialchars($buku['isbn'] ?? ''); ?>">
        </p>
        <p>
            <label>Stok:</label><br>
            <input type="number" name="stok" value="<?php echo htmlspecialchars($buku['stok'] ?? 0); ?>">
        </p>
        <p>
            <label>Kategori:</label><br>
            <input type="text" name="kategori" value="<?php echo htmlspecialchars($buku['kategori'] ?? ''); ?>">
        </p>
        <p>
            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="list.php">Batal</a>
        </p>
    </form>
</section>

<?php include '../includes/footer.php'; ?>
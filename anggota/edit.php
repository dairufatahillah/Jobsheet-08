<?php
$page_title = 'Edit Anggota';
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute([':id' => (int)$id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {
    header('Location: list.php');
    exit;
}

include '../includes/header.php';
?>

<section>
    <h2>Edit Anggota</h2>
    <form action="proses_edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $anggota['id']; ?>">

        <p>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($anggota['nama']); ?>" required>
        </p>
        <p>
            <label>No. Anggota / Email:</label><br>
            <input type="text" name="no_anggota" value="<?php echo htmlspecialchars($anggota['no_anggota'] ?? ''); ?>">
        </p>
        <p>
            <label>No. HP / Telepon:</label><br>
            <input type="text" name="no_hp" value="<?php echo htmlspecialchars($anggota['no_hp'] ?? ''); ?>">
        </p>
        <p>
            <label>Alamat:</label><br>
            <textarea name="alamat"><?php echo htmlspecialchars($anggota['alamat'] ?? ''); ?></textarea>
        </p>
        <p>
            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="list.php">Batal</a>
        </p>
    </form>
</section>

<?php include '../includes/footer.php'; ?>
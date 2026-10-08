<?php
$page_title = 'Tambah Buku';
include '../includes/header.php';
?>

<h2>Tambah Data Buku</h2>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="flash flash-<?php echo $_SESSION['flash_message']['type']; ?>">
        <?php 
            echo $_SESSION['flash_message']['text']; 
            unset($_SESSION['flash_message']); 
        ?>
    </div>
<?php endif; ?>

<form id="form-tambah" action="proses_tambah.php" method="POST">
    <p>
        <label for="judul">Judul</label><br>
        <input type="text" id="judul" name="judul" required>
    </p>
    <p>
        <label for="pengarang">Pengarang</label><br>
        <input type="text" id="pengarang" name="pengarang" required>
    </p>
    <p>
        <label for="tahun">Tahun Terbit</label><br>
        <input type="number" id="tahun" name="tahun" min="1900" max="2026" required>
    </p>
    <p>
        <label for="isbn">ISBN</label><br>
        <input type="text" id="isbn" name="isbn">
    </p>
    <p>
        <label for="stok">Stok</label><br>
        <input type="number" id="stok" name="stok" min="0" required>
    </p>
    <p>
        <label for="kategori">Kategori</label><br>
        <select id="kategori" name="kategori">
            <option value="Fiksi">Fiksi</option>
            <option value="Non-Fiksi">Non-Fiksi</option>
            <option value="Referensi">Referensi</option>
        </select>
    </p>
    <p>
        <button type="submit">Simpan</button>
        <a href="list.php">Batal</a>
    </p>
</form>

<?php include '../includes/footer.php'; ?>
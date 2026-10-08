<?php
$page_title = 'Tambah Anggota';
include '../includes/header.php';
?>

<h2>Tambah Data Anggota</h2>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="flash flash-<?php echo $_SESSION['flash_message']['type']; ?>">
        <?php 
            echo $_SESSION['flash_message']['text']; 
            unset($_SESSION['flash_message']); 
        ?>
    </div>
<?php endif; ?>

<form id="form-tambah-anggota" action="proses_tambah.php" method="POST">
    <p>
        <label for="nama">Nama Lengkap</label><br>
        <input type="text" id="nama" name="nama" required>
    </p>
    <p>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required>
    </p>
    <p>
        <label for="telepon">No. Telepon / WA</label><br>
        <input type="text" id="telepon" name="telepon">
    </p>
    <p>
        <label for="alamat">Alamat</label><br>
        <textarea id="alamat" name="alamat" rows="3" style="width: 100%; box-sizing: border-box;"></textarea>
    </p>
    <p>
        <button type="submit">Simpan</button>
        <a href="list.php">Batal</a>
    </p>
</form>

<?php include '../includes/footer.php'; ?>
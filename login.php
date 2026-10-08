<!DOCTYPE html>
<html lang+"id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini | Beranda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <label for="nav-toggle" class="nav-toggle-label">&#9776;</label>
        <nav>
            <ul>
                <li><a href="index.html">Beranda</a></li>
                <li><a href="buku/list.html">Daftar Buku</a></li>
                <li><a href="buku/tambah.html">Tambah Buku</a></li>
                <li><a href="anggota/list.html">Daftar anggota</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Login Petugas</h2>
            <form action="" method="POST">
            <p>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </p>
            <button type="submit">Masuk</button>
            </form>
            <p style="margin-top: 1rem; text-align: center;">
            Belum punya akun? <a href="#">Daftar di sini</a>
            </p>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SIMPUS-Mini &mdash; Jobsheet 1</p>
    </footer>
    <script src="assets/js/app.js"></script>
</body>
</html>
<?php // Navigasi halaman setelah login. File ini membutuhkan $pengguna dari wajib-login.php. ?>
<nav class="d-flex flex-wrap align-items-center gap-3 border-bottom pb-2 mb-3">
    <a href="form.php">Data mahasiswa</a>
    <span class="ms-auto text-secondary small">Masuk sebagai <?php echo htmlspecialchars($pengguna['nama'], ENT_QUOTES, 'UTF-8'); ?></span>
    <form action="logout.php" method="post" class="m-0">
        <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
        <button class="btn btn-sm btn-outline-secondary" type="submit">Keluar</button>
    </form>
</nav>

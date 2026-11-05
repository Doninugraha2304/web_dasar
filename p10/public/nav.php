<?php // Navigasi halaman setelah login. File ini membutuhkan $pengguna dari wajib-login.php. ?>
<nav class="d-flex flex-wrap align-items-center gap-2 mb-3 pb-2" style="border-bottom:1px solid var(--mui-divider,#e0e0e0);">
    <a href="form.php" class="btn btn-mui btn-mui-text">Data mahasiswa</a>
    <span class="ms-auto text-secondary-mui">Masuk sebagai <strong><?php echo htmlspecialchars($pengguna['nama'], ENT_QUOTES, 'UTF-8'); ?></strong></span>
    <form action="logout.php" method="post" class="m-0">
        <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8'); ?>">
        <button class="btn btn-mui btn-mui-secondary btn-sm" type="submit">Keluar</button>
    </form>
</nav>

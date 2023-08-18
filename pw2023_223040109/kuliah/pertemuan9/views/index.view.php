<?php require ('partials/header.php') ?>
<?php require ('partials/nav.php') ?>


<!-- home -->
    <div class="container">
        <h1>Halaman Home</h1>

        <h3>Daftar Mahasiswa</h3>

        <?php foreach( $students as $student) : ?>
            <ul>
                <li>Nama : <?= $student["nama"]; ?></li>
                <li>NPM : <?= $student["npm"]; ?></li>
                <li>Email : <?= $student["email"]; ?></li>
            </ul>
        <?php endforeach; ?>
    </div>

<?php require ('partials/footer.php'); ?>
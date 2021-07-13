<?php

$title = 'Daftar';

require_once "template/theHeader.php";

midGuest();

if (isset($_POST['register'])) {
    $sql = sprintf("INSERT INTO users(nama, username, password) VALUES ('%s', '%s', '%s')", $_POST['nama'], $_POST['username'], password_hash($_POST['password'], PASSWORD_ARGON2I));

    $query = $conn->prepare($sql);

    if ($query->execute()) {
        $_SESSION['auth_name'] = $_POST['nama'];
        $_SESSION['auth_user'] = $_POST['username'];

        return header('Location:index.php');
    }

    hasMessage('Maaf!, Anda tidak dapat mendaftarkan akun baru.');
}

?>

<div class="columns is-centered">
    <div class="column is-5">
        <div class="card">
            <div class="card-content">
                <h1 class="title">Daftar</h1>
                <form action="" method="post">
                    <div class="field">
                        <label for="nama" class="label">Nama Lengkap</label>
                        <div class="control">
                            <input type="text" name="nama" id="nama" class="input" value="<?= old('nama') ?>" required>
                        </div>
                    </div>
                    <div class="field">
                        <label for="username" class="label">Nama Pengguna</label>
                        <div class="control">
                            <input type="text" name="username" id="username" class="input" value="<?= old('username') ?>" required>
                        </div>
                    </div>
                    <div class="field">
                        <label for="password" class="label">Kata Sandi</label>
                        <div class="control">
                            <input type="password" name="password" id="password" class="input" required>
                        </div>
                    </div>
                    <div class="field">
                        <button name="register" class="button is-success">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

require_once "template/theFooter.php"

?>
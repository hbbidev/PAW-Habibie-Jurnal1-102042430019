<?php
function validasiInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// **********************  1  **************************  
// Inisialisasi variabel untuk menyimpan nilai input dan error
$namaErr = "";
$emailErr = "";
$nimErr = "";
$jurusanErr = "";
$fakultasErr = "";

$nama = "";
$email = "";
$nim = "";
$jurusan = "";
$fakultas = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // **********************  2  **************************  
    // - Tangkap nilai nama yang ada pada form HTML (Lihat Task 7)
    // - Validasi agar nama tidak boleh kosong
    // - Validasi agar nama hanya berupa abjad (Hint : gunakan fungsi preg_match (atau fungsi lainnya))
    // silakan taruh kode kalian di bawah
    if (empty($_POST["nama"])) {
        $namaErr = "Nama tidak boleh kosong!";
    } else {
        $nama = validasiInput($_POST["nama"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
            $namaErr = "Nama hanya berupa huruf dan spasi!";
        }
    }


    // **********************  3  **************************  
    // - Tangkap nilai email yang ada pada form HTML (Lihat Task 7)
    // - Memeriksa apakah email kosong
    // - Memeriksa apakah format email valid (Hint : gunakan fungsi filter_var)
    // silakan taruh kode kalian di bawah
    if (empty($_POST["email"])) {
        $emailErr = "Email tidak boleh kosong";
    } else {
        $email = validasiInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
        }
    }
 

    // **********************  4  **************************  
    // - Tangkap nilai NIM yang ada pada form HTML (Lihat Task 7)
    // - Pastikan NIM terisi dan berformat angka
    // - silakan taruh kode kalian di bawah
   if (empty($_POST["nim"])) {
        $nimErr = "NIM tidak boleh kosong";
    } else {
        $nim = validasiInput($_POST["nim"]);
        if (!is_numeric($nim)) {
            $nimErr = "NIM harus berupa angka";
        }
    }

    // **********************  5  **************************  
    // - Tangkap nilai jurusan yang ada pada form HTML (Lihat Task 7)
    // - Validasi agar jurusan tidak boleh kosong
    // - Validasi agar jurusan hanya berupa abjad (Hint : gunakan fungsi preg_match (atau fungsi lainnya))
    // silakan taruh kode kalian di bawah
    if (empty($_POST["jurusan"])) {
        $jurusanErr = "Jurusan tidak boleh kosong!";
    } else {
        $jurusan = validasiInput($_POST["jurusan"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $jurusan)) {
            $jurusanErr = "Jurusan hanya berupa huruf dan spasi!";
        }
    }
 

    // **********************  6  **************************  
    // - Tangkap nilai fakultas yang ada pada form HTML (Lihat Task 7)
    // - Validasi agar fakultas tidak boleh kosong
    // - Validasi agar fakultas hanya berupa abjad (Hint : gunakan fungsi preg_match (atau fungsi lainnya))
    // silakan taruh kode kalian di bawah
    if (empty($_POST["fakultas"])) {
        $fakultasErr = "Fakultas tidak boleh kosong!";
    } else {
        $fakultas = validasiInput($_POST["fakultas"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $fakultas)) {
            $fakultasErr = "Fakultas hanya berupa huruf dan spasi!";
        }
    }
   
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa Baru</title>
    <link rel="stylesheet" href="styles.css">  
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Formulir Pendaftaran Mahasiswa Baru</h2>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <?php if (!empty($namaErr) || !empty($emailErr) || !empty($nimErr) || !empty($jurusanErr) || !empty($fakultasErr)) { ?>
            <div class="alert alert-danger">
                <strong>Kesalahan!</strong> Harap perbaiki data yang salah.
            </div>
            <?php } else { ?>
            <div class="alert alert-success">
                <strong>Berhasil!</strong> Data pendaftaran telah diterima.
            </div>
            <?php } ?>
        <?php } ?>

        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <!-- **********************  7  ************************** -->
            <!-- Tambahkan value di tiap form-group/kolom untuk menampilkan kembali data di form setelah submit (retaining input) -->
            <!-- Hint : value pada input form harus berisi variabel yang menyimpan data input -->
            <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" >
            <span class="error"><?php echo $namaErr ? "* $namaErr" : ""; ?></span>
            </div>

            <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>" >
            <span class="error"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>
            </div>

            <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim" value="<?php echo $nim; ?>" >
            <span class="error"><?php echo $nimErr ? "* $nimErr" : ""; ?></span>
            </div>

            <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <input type="text" id="jurusan" name="jurusan" value="<?php echo $jurusan; ?>" >
            <span class="error"><?php echo $jurusanErr ? "* $jurusanErr" : ""; ?></span>
            </div>

            <div class="form-group">
            <label for="fakultas">Fakultas</label>
            <input type="text" id="fakultas" name="fakultas" value="<?php echo $fakultas; ?>" >
            <span class="error"><?php echo $fakultasErr ? "* $fakultasErr" : ""; ?></span>
            </div>

            <div class="button-container">
            <button type="submit">Daftar</button>
            </div>
        </form>
    </div>

    <!-- **********************  8  ************************** -->
    <!-- Panggil variabel yang berisi pesan error (Hint : gunakan if dan metode post) -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($namaErr) && empty($emailErr) && empty($nimErr) && empty($jurusanErr) && empty($fakultasErr)) { ?>

    <div class="container">
        <h3>Data Pendaftaran</h3>
        <div class="table-container">
    <!-- **********************  9  ************************** -->
    <!-- Tampilkan data pendaftaran dalam bentuk tabel yang baru saja diinput -->
     <table style="width:100%; border-collapse: collapse;">
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 8px; width: 30%;"><strong>Nama</strong></td>
                <td style="padding: 8px;"> <?php echo $nama; ?></td>
            </tr>
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 8px;"><strong>Email</strong></td>
                <td style="padding: 8px;"> <?php echo $email; ?></td>
            </tr>
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 8px;"><strong>NIM</strong></td>
                <td style="padding: 8px;"> <?php echo $nim; ?></td>
            </tr>
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 8px;"><strong>Jurusan</strong></td>
                <td style="padding: 8px;"> <?php echo $jurusan; ?></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Fakultas</strong></td>
                <td style="padding: 8px;"> <?php echo $fakultas; ?></td>
            </tr>
        </table>
        </div>
    </div>
    <?php } ?>
</body>
</html>



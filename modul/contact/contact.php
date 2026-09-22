<?php
if (!defined('cms-KONTEN')) {
    Header("Location: ../index.php");
    exit;
}

global $koneksi_db, $email_master, $judul_situs, $_META;

$pilih = cleartext(isset($_GET['pilih']) ? $_GET['pilih'] : 'contact');

$seo1 = $koneksi_db->sql_query("SELECT * FROM mod_data_meta WHERE nama='$pilih'");
if ($seo1 && ($pr1xypd = $koneksi_db->sql_fetchrow($seo1))) {
    $judulseo1 = $pr1xypd['judul'];
    $desseo1 = $pr1xypd['meta'];
    $keyseo1 = $pr1xypd['tags'];
} else {
    $judulseo1 = "Hubungi Kami";
    $desseo1 = "Hubungi Panitia Penerimaan Mahasiswa Baru IAI PERSIS Bandung";
    $keyseo1 = "kontak, hubungi kami, pmb, iai persis bandung";
}

$judul_situs = $judulseo1;
$_META['description'] = $desseo1;
$_META['keywords'] = $keyseo1;

// Ambil info kontak profil kampus
$data_profil = null;
$hasil_profil = $koneksi_db->sql_query("SELECT * FROM mod_data_profil WHERE id='1'");
if ($hasil_profil && ($row_profil = $koneksi_db->sql_fetchrow($hasil_profil))) {
    $data_profil = $row_profil;
}

$alert_msg = '';

// Pemrosesan POST Form Kontak (Backend Logic Terjaga Penuh)
if (isset($_POST['submit'])) {
    $nama = text_filter(isset($_POST['nama']) ? $_POST['nama'] : '');
    $email = text_filter(isset($_POST['email']) ? $_POST['email'] : '');
    $pesan = nl2br(text_filter(isset($_POST['pesan']) ? $_POST['pesan'] : '', 2));
    $error = '';

    if (!is_valid_email($email)) {
        $error .= "Format alamat email tidak valid!<br />";
    }
    $gfx_check = isset($_POST['gfx_check']) ? $_POST['gfx_check'] : '';
    if (!$nama) {
        $error .= "Silakan isi nama lengkap Anda!<br />";
    }
    if (!$pesan) {
        $error .= "Silakan tuliskan isi pesan Anda!<br />";
    }

    if (isset($_SESSION['Var_session']) && $gfx_check != $_SESSION['Var_session']) {
        $error .= "Kode keamanan (captcha) tidak sesuai!<br />";
    }
    if (cek_posted('contact')) {
        $error .= "Anda baru saja mengirim pesan. Mohon tunggu beberapa saat sebelum mengirim kembali.<br />";
    }

    if ($error) {
        $alert_msg = '<div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 18px; margin-bottom: 24px; font-size: 13.5px; line-height: 1.5;">' . $error . '</div>';
    } else {
        $subject = "$judul_situs - Contact Form";
        $msg = "$judul_situs - Contact Form<br /><br />Nama Pengirim: $nama<br />Email Pengirim: $email<br />Pesan:<br />$pesan";
        mail_send($email_master, $email, $subject, $msg, 1, 1);
        Posted('contact');

        $alert_msg = '<div style="background: #f0fdf4; border-left: 4px solid #16a34a; padding: 14px 18px; margin-bottom: 24px; font-size: 13.5px; color: #166534; line-height: 1.5;"><strong>Alhamdulillah!</strong> Pesan Anda telah berhasil dikirim ke sekretariat PMB kami. Tim kami akan segera menanggapi melalui email.</div>';

        unset($nama);
        unset($email);
        unset($pesan);
    }
}

$nama_val = htmlspecialchars(isset($nama) ? $nama : '');
$email_val = htmlspecialchars(isset($email) ? $email : '');
$pesan_val = htmlspecialchars(isset($pesan) ? $pesan : '');
?>

<div class="pmb-contact-wrapper" style="margin: 15px auto 40px auto; background: #ffffff; border: 1px solid #e2e8f0; padding: 32px 36px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); font-family: inherit;">
    <!-- Header Section -->
    <div style="border-bottom: 2px solid #0b4d3c; padding-bottom: 14px; margin-bottom: 24px;">
        <div style="display: inline-block; background: #ecfdf5; color: #0b4d3c; font-size: 11px; font-weight: 800; padding: 3px 8px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; border: 1px solid #d1fae5;">
            Layanan Informasi &amp; Helpdesk
        </div>
        <h2 style="margin: 0 0 6px 0; color: #0b4d3c; font-size: 22px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
            Hubungi Panitia PMB
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 13.5px; line-height: 1.5;">
            Punya pertanyaan seputar pendaftaran, program studi, biaya kuliah, atau beasiswa? Silakan hubungi kami melalui formulir di bawah ini atau saluran kontak resmi kami.
        </p>
    </div>

    <?= $alert_msg; ?>

    <div style="display: flex; gap: 32px; flex-wrap: wrap;">
        <!-- Kolom Kiri: Form Kontak -->
        <div style="flex: 1 1 480px; min-width: 300px;">
            <form method="post" action="" style="margin: 0;">
                <div style="margin-bottom: 18px;">
                    <label for="contact_nama" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Nama Lengkap <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" id="contact_nama" name="nama" required value="<?= $nama_val; ?>" placeholder="Masukkan nama lengkap Anda" style="width: 100%; box-sizing: border-box; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 0; font-size: 14px; color: #1e293b; background: #ffffff; outline: none;" onfocus="this.style.borderColor='#0b4d3c'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <div style="margin-bottom: 18px;">
                    <label for="contact_email" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Alamat Email <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="email" id="contact_email" name="email" required value="<?= $email_val; ?>" placeholder="Contoh: namaanda@gmail.com" style="width: 100%; box-sizing: border-box; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 0; font-size: 14px; color: #1e293b; background: #ffffff; outline: none;" onfocus="this.style.borderColor='#0b4d3c'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <div style="margin-bottom: 18px;">
                    <label for="contact_pesan" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Pesan / Pertanyaan <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea id="contact_pesan" name="pesan" required rows="5" placeholder="Tuliskan pertanyaan atau informasi yang Anda butuhkan secara jelas..." style="width: 100%; box-sizing: border-box; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 0; font-size: 14px; color: #1e293b; background: #ffffff; outline: none; font-family: inherit; line-height: 1.5;" onfocus="this.style.borderColor='#0b4d3c'" onblur="this.style.borderColor='#cbd5e1'"><?= $pesan_val; ?></textarea>
                </div>

                <?php if (extension_loaded("gd")): ?>
                <div style="margin-bottom: 22px; background: #f8fafc; border: 1px solid #e2e8f0; padding: 14px 16px;">
                    <label for="contact_captcha" style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Kode Keamanan (Captcha) <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                        <img src="ikutan/code_image.php" alt="Security Code" style="border: 1px solid #cbd5e1; vertical-align: middle; display: block; height: 38px;">
                        <input type="text" id="contact_captcha" name="gfx_check" required size="10" maxlength="6" placeholder="Ketik kode" style="width: 130px; box-sizing: border-box; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; font-size: 14px; font-weight: 700; color: #1e293b; outline: none;" onfocus="this.style.borderColor='#0b4d3c'" onblur="this.style.borderColor='#cbd5e1'">
                    </div>
                </div>
                <?php endif; ?>

                <div>
                    <button type="submit" name="submit" value="Submit" style="background: #0b4d3c; color: #ffffff; border: none; border-radius: 0; padding: 14px 30px; font-size: 13.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#083a2d'" onmouseout="this.style.backgroundColor='#0b4d3c'">
                        Kirim Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>

        <!-- Kolom Kanan: Info Helpdesk & Jam Layanan -->
        <div style="flex: 1 1 280px; max-width: 360px;">
            <div style="background: #073529; color: #ffffff; padding: 24px; border: 1px solid #0b4d3c;">
                <span style="background: #c89a3b; color: #073529; font-size: 10.5px; font-weight: 800; padding: 3px 8px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; margin-bottom: 12px;">
                    Sekretariat PMB
                </span>
                <h4 style="margin: 0 0 10px 0; color: #ffffff; font-size: 16px; font-weight: 700; text-transform: uppercase;">
                    Institut Agama Islam PERSIS Bandung
                </h4>
                <p style="margin: 0 0 18px 0; font-size: 13px; color: #cbd5e1; line-height: 1.5;">
                    Layanan pendaftaran dan verifikasi berkas dilayani setiap hari kerja.
                </p>

                <div style="font-size: 13px; line-height: 2; color: #ecfdf5; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 14px;">
                    <div style="margin-bottom: 8px;">
                        <i class="fa fa-map-marker" style="color: #c89a3b; width: 18px;"></i>
                        <?= htmlspecialchars(isset($data_profil['alamat']) ? $data_profil['alamat'] : 'Jl. Ciganitri No 2 Cipagalo Bojongsoang, Bandung'); ?>
                    </div>
                    <div style="margin-bottom: 8px;">
                        <i class="fa fa-phone" style="color: #c89a3b; width: 18px;"></i>
                        <?= htmlspecialchars(isset($data_profil['telp']) ? $data_profil['telp'] : '08119081122'); ?>
                    </div>
                    <div style="margin-bottom: 8px;">
                        <i class="fa fa-envelope-o" style="color: #c89a3b; width: 18px;"></i>
                        <?= htmlspecialchars(isset($data_profil['email']) ? $data_profil['email'] : 'info@iaipibandung.ac.id'); ?>
                    </div>
                    <div style="margin-bottom: 8px;">
                        <i class="fa fa-clock-o" style="color: #c89a3b; width: 18px;"></i>
                        Senin - Jumat: 08.00 - 16.00 WIB
                    </div>
                </div>

                <div style="margin-top: 18px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 16px;">
                    <a href="https://api.whatsapp.com/send?phone=+628119081122&text=Assalamu%27alaikum%20Panitia%20PMB%20IAI%20Persis%20Bandung..." target="_blank" rel="noopener" style="background: #25D366; color: #ffffff; padding: 11px 16px; font-weight: 700; font-size: 12.5px; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fa fa-whatsapp" style="font-size: 16px;"></i>
                        <span>Chat WhatsApp Helpdesk</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

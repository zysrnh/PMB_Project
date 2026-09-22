<?php
if (file_exists("classes/class.phpmailer.php")) {
    include_once "classes/class.phpmailer.php";
}
if (file_exists("modul/functions.php")) {
    include_once "modul/functions.php";
}

global $koneksi_db;

// 1. Cek status periode pendaftaran aktif
$mulai = $akhir = $mulai2 = $akhir2 = $mulai3 = $akhir3 = '';
$propinsi12xx2x = $koneksi_db->sql_query("SELECT * FROM mod_data_periode WHERE id='1'");
if ($propinsi12xx2x && ($p11xx2x = $koneksi_db->sql_fetchrow($propinsi12xx2x))) {
    $mulai = isset($p11xx2x['mulai']) ? $p11xx2x['mulai'] : '';
    $akhir = isset($p11xx2x['akhir']) ? $p11xx2x['akhir'] : '';
    $mulai2 = isset($p11xx2x['mulai2']) ? $p11xx2x['mulai2'] : '';
    $akhir2 = isset($p11xx2x['akhir2']) ? $p11xx2x['akhir2'] : '';
    $mulai3 = isset($p11xx2x['mulai3']) ? $p11xx2x['mulai3'] : '';
    $akhir3 = isset($p11xx2x['akhir3']) ? $p11xx2x['akhir3'] : '';
}

$queryc = $koneksi_db->sql_query("SELECT * FROM mod_data_periode WHERE mulai <= CURDATE() AND akhir >= CURDATE()");
$total = $queryc ? $koneksi_db->sql_numrows($queryc) : 0;

$query2 = $koneksi_db->sql_query("SELECT * FROM mod_data_periode WHERE mulai2 <= CURDATE() AND akhir2 >= CURDATE()");
$total2 = $query2 ? $koneksi_db->sql_numrows($query2) : 0;

$query3 = $koneksi_db->sql_query("SELECT * FROM mod_data_periode WHERE mulai3 <= CURDATE() AND akhir3 >= CURDATE()");
$total3 = $query3 ? $koneksi_db->sql_numrows($query3) : 0;

$xt1 = ($total > 0) ? 1 : 0;
$xt2 = ($total2 > 0) ? 1 : 0;
$xt3 = ($total3 > 0) ? 1 : 0;

$gel_aktif = 1;
if ($xt1 == 1) {
    $gel_aktif = 1;
} elseif ($xt2 == 1) {
    $gel_aktif = 2;
} elseif ($xt3 == 1) {
    $gel_aktif = 3;
}

$content = '';
$datawajibdiisi = array('nama', 'prodi', 'nik', 'kelamin', 'tempat', 'lahir', 'telp', 'email');

// 2. Pemrosesan Data Form POST (Backend Logic)
if (isset($_POST['submit'])) {
    $error = '';

    foreach ($datawajibdiisi as $v) {
        if (empty($_POST[$v])) {
            $error .= 'Bidang wajib diisi: <strong>' . htmlspecialchars($v) . '</strong><br />';
        }
    }

    $gel = cleantext(isset($_POST['gel']) ? $_POST['gel'] : $gel_aktif);
    $prodi = cleantext(isset($_POST['prodi']) ? $_POST['prodi'] : '');
    $sumber = cleantext(isset($_POST['sumber']) ? $_POST['sumber'] : 'Class Online');
    $sumber2 = cleantext(isset($_POST['sumber2']) ? $_POST['sumber2'] : '');
    $oleh = cleantext(isset($_POST['oleh']) ? $_POST['oleh'] : '');
    $oleh2 = cleantext(isset($_POST['oleh2']) ? $_POST['oleh2'] : '');
    $nama = clean_emoji(isset($_POST['nama']) ? $_POST['nama'] : '');
    $tempat = clean_emoji(isset($_POST['tempat']) ? $_POST['tempat'] : '');
    $lahir = cleantext(isset($_POST['lahir']) ? $_POST['lahir'] : '');
    $kelamin = cleantext(isset($_POST['kelamin']) ? $_POST['kelamin'] : '');
    $nik = cleantext(isset($_POST['nik']) ? $_POST['nik'] : '');
    $agama = cleantext(isset($_POST['agama']) ? $_POST['agama'] : '');
    $telp = cleantext(isset($_POST['telp']) ? $_POST['telp'] : '');
    $email = cleantext(isset($_POST['email']) ? $_POST['email'] : '');
    $kwn = cleantext(isset($_POST['kwn']) ? $_POST['kwn'] : 'ID');
    $jenis = cleantext(isset($_POST['jenis']) ? $_POST['jenis'] : '1');
    $tanggal = date('Y-m-d');
    $prov = cleantext(isset($_POST['prov']) ? $_POST['prov'] : '');
    $kab = cleantext(isset($_POST['kab']) ? $_POST['kab'] : '');
    $kec = cleantext(isset($_POST['kec']) ? $_POST['kec'] : '');
    $kel = cleantext(isset($_POST['kel']) ? $_POST['kel'] : '');
    $alamat = clean_emoji(isset($_POST['alamat']) ? $_POST['alamat'] : '');
    $kps = cleantext(isset($_POST['kps']) ? $_POST['kps'] : '');
    $nokps = cleantext(isset($_POST['nokps']) ? $_POST['nokps'] : '');
    $ibu = clean_emoji(isset($_POST['ibu']) ? $_POST['ibu'] : '');
    $nisn = cleantext(isset($_POST['nisn']) ? $_POST['nisn'] : '');
    $rt = cleantext(isset($_POST['rt']) ? $_POST['rt'] : '');
    $rw = cleantext(isset($_POST['rw']) ? $_POST['rw'] : '');
    $sekolah = clean_emoji(isset($_POST['sekolah']) ? $_POST['sekolah'] : '');
    $lahir2 = str_replace("-", "", $lahir);

    $prop1xys = $koneksi_db->sql_query("SELECT id FROM mod_data_jumlah ORDER BY id DESC LIMIT 1");
    $idkats = 1;
    if ($prop1xys && ($pr1xys = $koneksi_db->sql_fetchrow($prop1xys))) {
        $idkats = $pr1xys['id'] + 1;
    }

    $prop1xysx = $koneksi_db->sql_query("SELECT tahun, biaya FROM mod_data_periode ORDER BY id DESC LIMIT 1");
    $idkatsx = date('Y');
    $biaya = '250000';
    if ($prop1xysx && ($pr1xysx = $koneksi_db->sql_fetchrow($prop1xysx))) {
        $idkatsx = isset($pr1xysx['tahun']) ? $pr1xysx['tahun'] : date('Y');
        $biaya = isset($pr1xysx['biaya']) ? $pr1xysx['biaya'] : '250000';
    }

    $tahun = $idkatsx;
    $nomor = '' . $tahun . '' . str_pad($idkats, 4, '0', STR_PAD_LEFT);
    $user = $nomor;
    $password = md5($lahir2);

    $kodepos = '';
    if (!empty($kel)) {
        $prop23 = $koneksi_db->sql_query("SELECT no_kodepos FROM kodepos WHERE kelurahan_id='$kel' LIMIT 1");
        if ($prop23 && ($pr23 = $koneksi_db->sql_fetchrow($prop23))) {
            $kodepos = $pr23['no_kodepos'];
        }
    }

    $check_nik = $koneksi_db->sql_query("SELECT nik FROM mod_data_pmb WHERE nik='$nik'");
    if ($check_nik && $koneksi_db->sql_numrows($check_nik) > 0) {
        $error .= "NIK / No. KTP <strong>" . htmlspecialchars($nik) . "</strong> sudah terdaftar dalam sistem.<br />";
    }

    if (!empty($error)) {
        $content .= '<div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 18px; margin-bottom: 24px; font-size: 14px;">' . $error . '</div>';
    } else {
        $insert = $koneksi_db->sql_query("INSERT INTO `mod_data_pmb` (`nomor`, `prodi`, `sumber`, `sumber2`, `oleh`, `oleh2`, `nama`, `tempat`, `lahir`, `kelamin`, `nik`, `agama`, `telp`, `email`, `kwn`, `jenis`, `tanggal`, `prov`, `kab`, `kec`, `kel`, `kodepos`, `rt`, `rw`, `alamat`, `kps`, `nokps`, `ibu`, `gel`, `sekolah`, `biaya`, `nisn`) VALUES ('$nomor', '$prodi', '$sumber', '$sumber2', '$oleh', '$oleh2', '$nama', '$tempat', '$lahir', '$kelamin', '$nik', '$agama', '$telp', '$email', '$kwn', '$jenis', '$tanggal', '$prov', '$kab', '$kec', '$kel', '$kodepos', '$rt', '$rw', '$alamat', '$kps', '$nokps', '$ibu', '$gel', '$sekolah', '$biaya', '$nisn')");

        if ($insert) {
            $koneksi_db->sql_query("INSERT INTO `mod_data_jumlah` (`nama`) VALUES ('1')");
            $koneksi_db->sql_query("INSERT INTO `pengguna` (`nama`, `alamat`, `telp`, `email`, `user`, `password`, `tipe`, `level`) VALUES ('$nama', '$alamat', '$telp', '$email', '$user', '$password', 'aktif', 'User')");

            // Kirim notifikasi email bila class phpmailer tersedia
            if (class_exists('PHPMailer')) {
                try {
                    $mail = new PHPMailer;
                    $mail->IsSMTP();
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = "selayar.iixcp.rumahweb.net";
                    $mail->SMTPDebug = 0;
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Timeout = 10;
                    $mail->Username = "pmb@iaipibandung.ac.id";
                    $mail->Password = "pmb@22";
                    $mail->SetFrom("pmb@iaipibandung.ac.id", "IAI PERSIS BANDUNG");
                    $mail->Subject = "Bukti Registrasi Akun PMB";
                    $mail->AddAddress($email, $nama);
                    $mail->MsgHTML("Selamat, pendaftaran Anda berhasil.<br/>Username: $nomor<br/>Password: $lahir2<br/>Silakan login di portal PMB.");
                    @$mail->Send();
                } catch (Exception $e) {
                    // Ignore email error on local
                }
            }

            $content .= '
            <div style="background: #f0fdf4; border-left: 4px solid #16a34a; padding: 24px; margin-bottom: 30px; font-size: 14px; color: #166534; line-height: 1.6;">
                <h3 style="margin: 0 0 10px 0; color: #15803d; font-size: 18px; font-weight: 700; text-transform: uppercase;">Alhamdulillah, Pendaftaran Berhasil!</h3>
                <p style="margin: 0 0 12px 0;">Akun pendaftaran calon mahasiswa baru Anda telah dibuat dengan rincian:</p>
                <div style="background: #ffffff; border: 1px solid #bbf7d0; padding: 14px 18px; margin-bottom: 16px; font-size: 14px;">
                    <div><strong>No. Pendaftaran (Username):</strong> ' . htmlspecialchars($nomor) . '</div>
                    <div><strong>Password:</strong> ' . htmlspecialchars($lahir2) . ' (Format: YYYYMMDD)</div>
                </div>
                <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 16px;">
                    <a href="index.php?pilih=login&amp;modul=yes" style="background: #0b4d3c; color: #ffffff; padding: 10px 20px; font-weight: 700; text-decoration: none; text-transform: uppercase; font-size: 13px; display: inline-block;">
                        Login ke Akun PMB
                    </a>
                    <a href="https://chat.whatsapp.com/HC9B26K95xJ44YDmllnMpV" target="_blank" rel="noopener" style="background: #25d366; color: #ffffff; padding: 10px 20px; font-weight: 700; text-decoration: none; text-transform: uppercase; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa fa-whatsapp"></i> Gabung Grup WhatsApp PMB
                    </a>
                </div>
            </div>';
        } else {
            $content .= '<div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 18px; margin-bottom: 24px;">Gagal menyimpan data pendaftaran. Silakan periksa kembali data Anda.</div>';
        }
    }
}

// 3. Persiapkan Data Dropdown
$asal44x = '';
$propinsi5x = $koneksi_db->sql_query("SELECT id, nama FROM mod_data_agama ORDER BY id ASC");
if ($propinsi5x) {
    while ($p11x = $koneksi_db->sql_fetchrow($propinsi5x)) {
        $asal44x .= '<option value="' . htmlspecialchars($p11x['id']) . '">' . htmlspecialchars($p11x['nama']) . '</option>';
    }
}

$asal442 = '';
$propinsi52 = $koneksi_db->sql_query("SELECT kode, nama FROM mod_data_prodi ORDER BY id ASC");
if ($propinsi52) {
    while ($p112 = $koneksi_db->sql_fetchrow($propinsi52)) {
        $asal442 .= '<option value="' . htmlspecialchars($p112['kode']) . '">' . htmlspecialchars($p112['nama']) . '</option>';
    }
}

$asal44 = '';
$propinsi5 = $koneksi_db->sql_query("SELECT id, nama_provinsi FROM provinsi ORDER BY id ASC");
if ($propinsi5) {
    while ($p11 = $koneksi_db->sql_fetchrow($propinsi5)) {
        $asal44 .= '<option value="' . htmlspecialchars($p11['id']) . '">' . htmlspecialchars($p11['nama_provinsi']) . '</option>';
    }
}
?>

<div class="pmb-register-wrapper" style="max-width: 900px; margin: 15px auto 40px auto; background: #ffffff; border: 1px solid #e2e8f0; padding: 32px 36px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); font-family: inherit;">
    <!-- Form Title & Header -->
    <div style="border-bottom: 2px solid #0b4d3c; padding-bottom: 14px; margin-bottom: 24px;">
        <div style="display: inline-block; background: #ecfdf5; color: #0b4d3c; font-size: 11px; font-weight: 800; padding: 3px 8px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; border: 1px solid #d1fae5;">
            Formulir PMB Online
        </div>
        <h2 style="margin: 0 0 6px 0; color: #0b4d3c; font-size: 22px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
            Pendaftaran Mahasiswa Baru IAI PERSIS Bandung
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 13.5px; line-height: 1.5;">
            Silakan isi data calon mahasiswa di bawah ini secara lengkap dan benar sesuai dokumen resmi (KTP/Ijazah).
        </p>
    </div>

    <?php echo $content; ?>

    <?php if ($xt1 == 1 || $xt2 == 1 || $xt3 == 1): ?>
    <form method="POST" action="" enctype="multipart/form-data" name="input_jabatan" style="margin: 0;">

        <!-- Bagian 1: Jalur & Pilihan Program Studi -->
        <div style="background: #f8fafc; border-left: 3px solid #0b4d3c; padding: 10px 16px; margin-bottom: 16px; font-weight: 700; font-size: 13.5px; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">
            1. Jalur Pendaftaran &amp; Program Studi
        </div>

        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px; font-size: 13.5px; margin-bottom: 24px;">
            <tr>
                <td style="width: 210px; font-weight: 600; color: #334155; vertical-align: middle;">Periode / Gelombang</td>
                <td style="width: 15px; text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" value="Gelombang <?= htmlspecialchars($gel_aktif); ?>" disabled="disabled" style="width: 100%; max-width: 320px; padding: 9px 12px; border: 1px solid #cbd5e1; background: #f1f5f9; color: #334155; font-weight: 700; border-radius: 0;">
                    <input type="hidden" name="gel" value="<?= htmlspecialchars($gel_aktif); ?>">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Jenis Kelas <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="sumber" required style="width: 100%; max-width: 320px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="">-- Pilih Salah Satu --</option>
                        <option value="Class Online" selected>Class Online</option>
                        <option value="Reguler">Reguler / Tatap Muka</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Keterangan / Catatan</td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" name="sumber2" placeholder="Keterangan tambahan (opsional)" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Pilihan Program Studi <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="prodi" required style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="">-- Pilih Program Studi --</option>
                        <?= $asal442; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Jenis Pendaftaran <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="jenis" required style="width: 100%; max-width: 320px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="1" selected>Mahasiswa Baru</option>
                        <option value="2">Pindahan / Transfer</option>
                    </select>
                </td>
            </tr>
        </table>

        <!-- Bagian 2: Identitas Calon Mahasiswa -->
        <div style="background: #f8fafc; border-left: 3px solid #0b4d3c; padding: 10px 16px; margin-bottom: 16px; font-weight: 700; font-size: 13.5px; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">
            2. Identitas Pribadi Calon Mahasiswa
        </div>

        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px; font-size: 13.5px; margin-bottom: 24px;">
            <tr>
                <td style="width: 210px; font-weight: 600; color: #334155; vertical-align: middle;">Nama Lengkap <span style="color: #ef4444;">*</span></td>
                <td style="width: 15px; text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" name="nama" required value="<?= htmlspecialchars(isset($_POST['nama']) ? $_POST['nama'] : ''); ?>" placeholder="Masukkan nama lengkap sesuai ijazah/KTP" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">NIK / No. KTP <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" name="nik" required maxlength="16" value="<?= htmlspecialchars(isset($_POST['nik']) ? $_POST['nik'] : ''); ?>" placeholder="16 digit Nomor Induk Kependudukan" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Tempat Lahir <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" name="tempat" required value="<?= htmlspecialchars(isset($_POST['tempat']) ? $_POST['tempat'] : ''); ?>" placeholder="Kota / Kabupaten tempat lahir" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Tanggal Lahir <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="date" name="lahir" required value="<?= htmlspecialchars(isset($_POST['lahir']) ? $_POST['lahir'] : ''); ?>" placeholder="YYYY-MM-DD" style="width: 100%; max-width: 320px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Jenis Kelamin <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="kelamin" required style="width: 100%; max-width: 320px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="">-- Pilih Salah Satu --</option>
                        <option value="L" <?= ((@$_POST['kelamin'] == 'L') ? 'selected' : ''); ?>>Laki-laki (L)</option>
                        <option value="P" <?= ((@$_POST['kelamin'] == 'P') ? 'selected' : ''); ?>>Perempuan (P)</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Agama <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="agama" required style="width: 100%; max-width: 320px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="">-- Pilih Agama --</option>
                        <?= $asal44x; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Kewarganegaraan <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="kwn" required style="width: 100%; max-width: 320px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="ID" selected>Indonesia (WNI)</option>
                        <option value="WNA">Warga Negara Asing (WNA)</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Nama Ibu Kandung <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" name="ibu" required value="<?= htmlspecialchars(isset($_POST['ibu']) ? $_POST['ibu'] : ''); ?>" placeholder="Nama lengkap ibu kandung" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Asal Sekolah / PT Asal</td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" name="sekolah" value="<?= htmlspecialchars(isset($_POST['sekolah']) ? $_POST['sekolah'] : ''); ?>" placeholder="Nama SMA / SMK / MA / Universitas Asal" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">NISN (Nomor Induk Siswa Nasional)</td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" name="nisn" value="<?= htmlspecialchars(isset($_POST['nisn']) ? $_POST['nisn'] : ''); ?>" placeholder="10 digit NISN (jika ada)" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>
        </table>

        <!-- Bagian 3: Wilayah & Alamat Domisili -->
        <div style="background: #f8fafc; border-left: 3px solid #0b4d3c; padding: 10px 16px; margin-bottom: 16px; font-weight: 700; font-size: 13.5px; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">
            3. Wilayah &amp; Alamat Domisili
        </div>

        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px; font-size: 13.5px; margin-bottom: 24px;">
            <tr>
                <td style="width: 210px; font-weight: 600; color: #334155; vertical-align: middle;">Provinsi <span style="color: #ef4444;">*</span></td>
                <td style="width: 15px; text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="prov" id="propinsi5" required style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="">-- Pilih Provinsi --</option>
                        <?= $asal44; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Kota / Kabupaten <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="kab" id="kota5" required style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="">-- Pilih Kota/Kabupaten --</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Kecamatan <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="kec" id="kec5" required style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="">-- Pilih Kecamatan --</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Kelurahan / Desa <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <select name="kel" id="desa5" required style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                        <option value="">-- Pilih Kelurahan --</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: top; padding-top: 10px;">Alamat Lengkap <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b; vertical-align: top; padding-top: 10px;">:</td>
                <td>
                    <textarea name="alamat" required rows="3" placeholder="Nama jalan, nomor rumah, RT, RW, dusun/kampung" style="width: 100%; max-width: 540px; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff; font-family: inherit; font-size: 13.5px;"><?= htmlspecialchars(isset($_POST['alamat']) ? $_POST['alamat'] : ''); ?></textarea>
                    <div style="margin-top: 8px; display: flex; gap: 10px;">
                        <input type="text" name="rt" size="5" placeholder="RT" value="<?= htmlspecialchars(isset($_POST['rt']) ? $_POST['rt'] : ''); ?>" style="width: 80px; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 0; outline: none;">
                        <input type="text" name="rw" size="5" placeholder="RW" value="<?= htmlspecialchars(isset($_POST['rw']) ? $_POST['rw'] : ''); ?>" style="width: 80px; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 0; outline: none;">
                    </div>
                </td>
            </tr>
        </table>

        <!-- Bagian 4: Kontak & Komunikasi -->
        <div style="background: #f8fafc; border-left: 3px solid #0b4d3c; padding: 10px 16px; margin-bottom: 16px; font-weight: 700; font-size: 13.5px; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">
            4. Kontak &amp; Jalur Komunikasi
        </div>

        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px; font-size: 13.5px; margin-bottom: 24px;">
            <tr>
                <td style="width: 210px; font-weight: 600; color: #334155; vertical-align: middle;">No. WhatsApp / Telepon <span style="color: #ef4444;">*</span></td>
                <td style="width: 15px; text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="text" name="telp" required value="<?= htmlspecialchars(isset($_POST['telp']) ? $_POST['telp'] : ''); ?>" placeholder="Contoh: 081234567890" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600; color: #334155; vertical-align: middle;">Alamat Email Aktif <span style="color: #ef4444;">*</span></td>
                <td style="text-align: center; color: #64748b;">:</td>
                <td>
                    <input type="email" name="email" required value="<?= htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ''); ?>" placeholder="Contoh: emailanda@gmail.com" style="width: 100%; max-width: 480px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 0; outline: none; background: #ffffff;">
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td style="padding-top: 14px;">
                    <button type="submit" name="submit" value="Daftar" style="background: #0b4d3c; color: #ffffff; border: none; border-radius: 0; padding: 14px 32px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#083a2d'" onmouseout="this.style.backgroundColor='#0b4d3c'">
                        Kirim Formulir Pendaftaran
                    </button>
                </td>
            </tr>
        </table>
    </form>
    <?php else: ?>
        <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 18px 24px; font-size: 14px;">
            <h4 style="margin: 0 0 6px 0; font-weight: 700; font-size: 16px;">Pendaftaran Sedang Ditutup</h4>
            <p style="margin: 0;">Mohon maaf, saat ini periode pendaftaran mahasiswa baru sedang tidak aktif. Silakan hubungi bagian Helpdesk PMB untuk informasi gelombang berikutnya.</p>
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
    $("#propinsi5").change(function(){
        var propinsi5 = $(this).val();
        if(propinsi5) {
            $.ajax({
                url: "ambilkota5.php",
                type: "GET",
                data: { propinsi5: propinsi5 },
                cache: false,
                success: function(msg){
                    $("#kota5").html(msg);
                    $("#kec5").html('<option value="">-- Pilih Kecamatan --</option>');
                    $("#desa5").html('<option value="">-- Pilih Kelurahan --</option>');
                }
            });
        }
    });

    $("#kota5").change(function(){
        var kota5 = $(this).val();
        if(kota5) {
            $.ajax({
                url: "ambilkecamatan5.php",
                type: "GET",
                data: { kota5: kota5 },
                cache: false,
                success: function(msg){
                    $("#kec5").html(msg);
                    $("#desa5").html('<option value="">-- Pilih Kelurahan --</option>');
                }
            });
        }
    });

    $("#kec5").change(function(){
        var kec5 = $(this).val();
        if(kec5) {
            $.ajax({
                url: "ambildesa5.php",
                type: "GET",
                data: { kec5: kec5 },
                cache: false,
                success: function(msg){
                    $("#desa5").html(msg);
                }
            });
        }
    });
});
</script>
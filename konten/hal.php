<?php

if (!defined('cms-KONTEN')) {
	Header("Location: ../index.php");
	exit;
}

$index_hal = 1;
$tengah = '';

global $koneksi_db;

$id = int_filter($_GET['id']);
$hasil = $koneksi_db->sql_query("SELECT judul, konten, foto FROM halaman WHERE id='$id'");
$data = $koneksi_db->sql_fetchrow($hasil);

$judulnya = $data['judul'];
$urlkontenxhal = str_replace(" ", ", ", $judulnya);

$judul_situs = ucwords($data['judul']);
$_META['description'] = limitTXT2(htmlentities(strip_tags($data['konten'])), 140);
$_META['keywords'] = $urlkontenxhal;

if (empty($judulnya)) {
	$tengah .= '<div class="alert alert-warning" style="background: #fffbeb; border: 1px solid #fef3c7; color: #92400e; padding: 20px; font-weight: 600;">Halaman tidak tersedia atau belum dipublikasikan.</div>';
} else {
	$gambar = !empty($data['foto']) && file_exists('images/' . $data['foto']) ? '<div style="margin-bottom: 25px;"><img src="images/' . $data['foto'] . '" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0;" alt="' . htmlspecialchars($data['judul']) . '"></div>' : '';

	$tengah .= '
    <!-- Breadcrumb Nav -->
    <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px 18px; margin-bottom: 24px; font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
        <a href="index.html" style="color: #0b4d3c; text-decoration: none; font-weight: 600;"><i class="fa fa-home"></i> Beranda</a>
        <i class="fa fa-angle-right" style="color: #cbd5e1;"></i>
        <span style="color: #64748b;">Program Akademik / Informasi</span>
        <i class="fa fa-angle-right" style="color: #cbd5e1;"></i>
        <span style="color: #0f172a; font-weight: 600;">' . htmlspecialchars($data['judul']) . '</span>
    </div>

    <!-- Main Content Card Flat -->
    <div class="hal-article-container" style="background: #ffffff; border: 1px solid #e2e8f0; border-top: 4px solid #0b4d3c; padding: 36px 40px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <div style="margin-bottom: 12px;">
            <span style="display: inline-block; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #0b4d3c; background: #ecfdf5; padding: 4px 12px; border: 1px solid #d1fae5;">
                <i class="fa fa-graduation-cap" style="color: #c89a3b; margin-right: 4px;"></i> Informasi Akademik & PMB
            </span>
        </div>

        <h1 style="font-family: var(--font-heading); font-size: 28px; font-weight: 800; color: #0f172a; margin-top: 8px; margin-bottom: 20px; line-height: 1.35; letter-spacing: -0.02em;">
            ' . htmlspecialchars($data['judul']) . '
        </h1>

        <hr style="border: 0; border-top: 1px solid #f1f5f9; margin-bottom: 28px;">

        ' . $gambar . '

        <div class="hal-article-body" style="font-size: 15.5px; line-height: 1.85; color: #334155; font-family: var(--font-main);">
            ' . $data['konten'] . '
        </div>

        <!-- Call to Action Footer -->
        <div style="margin-top: 45px; padding: 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #c89a3b; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
            <div>
                <h4 style="font-family: var(--font-heading); font-size: 17px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
                    Tertarik Bergabung dengan Program Studi Ini?
                </h4>
                <p style="font-size: 13.5px; color: #64748b; margin: 0;">
                    Penerimaan Mahasiswa Baru Tahun Akademik 2026/2027 telah dibuka. Segera amankan kuota Anda!
                </p>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="register.html" class="btn-flat btn-flat-accent" style="padding: 10px 22px; font-size: 13.5px;">
                    <i class="fa fa-user-plus"></i> Daftar Sekarang
                </a>
                <a href="https://api.whatsapp.com/send?phone=+628119081122&text=Assalamu%27alaikum%20Admin%20PMB,%20saya%20ingin%20konsultasi%20mengenai%20' . urlencode($data['judul']) . '" target="_blank" class="btn-flat btn-flat-primary" style="padding: 10px 20px; font-size: 13.5px;">
                    <i class="fa fa-whatsapp"></i> Chat Helpdesk
                </a>
            </div>
        </div>
    </div>
    ';
}

echo $tengah;
?>
<?php
global $koneksi_db, $maxkonten;

// 1. Ticker / Profil Singkat
$perintah_profil = "SELECT * FROM mod_data_profil LIMIT 1";
$hasil_profil = $koneksi_db->sql_query($perintah_profil);
while ($data_profil = $koneksi_db->sql_fetchrow($hasil_profil)) {
?>
<!-- Ticker Pengumuman Flat -->
<div style="background: #073529; color: #ecfdf5; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
        <div style="display: flex; align-items: center; gap: 10px; flex: 1; min-width: 280px;">
            <span style="background: #c89a3b; color: #073529; font-weight: 800; font-size: 11px; padding: 3px 8px; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap;">
                PENGUMUMAN
            </span>
            <div style="font-size: 13px; font-weight: 500; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                <?= htmlspecialchars($data_profil['nama']); ?> &bull; <?= htmlspecialchars($data_profil['slogan'] ?? 'Penerimaan Mahasiswa Baru'); ?>
            </div>
        </div>
        <div style="font-size: 12px; color: #94a3b8; display: flex; align-items: center; gap: 6px;">
            <i class="fa fa-map-marker" style="color: #c89a3b;"></i>
            <span><?= htmlspecialchars($data_profil['alamat']); ?></span>
        </div>
    </div>
</div>
<?php } ?>

<style>
/* CSS Flat Modern untuk Seluruh Komponen Beranda */
.pmb-section {
    padding: 60px 0;
    position: relative;
}

.pmb-section-alt {
    background-color: #f8fafc;
    border-top: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
}

/* Service Grid Flat */
.service-grid-flat {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

@media (max-width: 991px) {
    .service-grid-flat {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 575px) {
    .service-grid-flat {
        grid-template-columns: 1fr;
    }
}

.service-card-flat {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    padding: 30px 20px;
    text-align: center;
    transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 180px;
    text-decoration: none !important;
}

.service-card-flat:hover {
    border-color: #0b4d3c;
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(11, 77, 60, 0.08);
}

.service-card-flat .icon-box {
    width: 60px;
    height: 60px;
    background: #ecfdf5;
    border: 1px solid #d1fae5;
    color: #0b4d3c;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 16px;
    transition: background 0.2s ease, color 0.2s ease;
}

.service-card-flat:hover .icon-box {
    background: #0b4d3c;
    color: #ffffff;
}

.service-card-flat h3 {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1.4;
}

/* CTA Heroic Section */
.cta-banner-flat {
    background: #0b4d3c;
    color: #ffffff;
    padding: 50px 30px;
    border: 1px solid #073529;
    text-align: center;
    position: relative;
    margin-top: 30px;
}

.cta-banner-flat h2 {
    font-size: 26px;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.cta-banner-flat p {
    font-size: 15px;
    color: #ecfdf5;
    max-width: 650px;
    margin: 0 auto 24px auto;
}

.btn-cta-main {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: #c89a3b;
    color: #073529 !important;
    font-family: var(--font-heading);
    font-size: 15px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    padding: 16px 40px;
    border: none;
    border-radius: 0px;
    text-decoration: none !important;
    transition: all 0.2s ease;
}

.btn-cta-main:hover {
    background: #e5b349;
    color: #000000 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
}

/* Social Grid Flat */
.social-grid-flat {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 15px;
}

@media (max-width: 991px) {
    .social-grid-flat {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 575px) {
    .social-grid-flat {
        grid-template-columns: repeat(2, 1fr);
    }
}

.social-card-flat {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    padding: 24px 15px;
    text-align: center;
    text-decoration: none !important;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.social-card-flat:hover {
    border-color: #0f172a;
    background: #0f172a;
    transform: translateY(-3px);
}

.social-card-flat i {
    font-size: 28px;
    color: #0b4d3c;
    transition: color 0.2s ease;
}

.social-card-flat strong {
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: color 0.2s ease;
}

.social-card-flat:hover i,
.social-card-flat:hover strong {
    color: #ffffff;
}

/* News Cards Flat */
.news-grid-flat {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}

@media (max-width: 991px) {
    .news-grid-flat {
        grid-template-columns: 1fr;
    }
}

.news-card-flat {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.news-card-flat:hover {
    border-color: #0b4d3c;
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.06);
}

.news-card-thumb {
    position: relative;
    width: 100%;
    height: 200px;
    background: #e2e8f0;
    overflow: hidden;
}

.news-card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.news-card-flat:hover .news-card-thumb img {
    transform: scale(1.04);
}

.news-card-body {
    padding: 24px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.news-card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 12px;
    color: #94a3b8;
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f1f5f9;
}

.news-card-title {
    font-size: 17px;
    font-weight: 700;
    line-height: 1.45;
    color: #0f172a;
    margin-bottom: 12px;
    text-decoration: none !important;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card-title:hover {
    color: #0b4d3c;
}

.news-read-more {
    font-size: 13px;
    font-weight: 700;
    color: #0b4d3c;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: auto;
    text-decoration: none !important;
}

.news-read-more:hover {
    color: #c89a3b;
}

/* FAQ & Video Flat */
.faq-item-flat {
    border: 1px solid #e2e8f0;
    background: #ffffff;
    margin-bottom: 12px;
}

.faq-header-flat {
    padding: 16px 20px;
    font-weight: 700;
    font-size: 15px;
    color: #0f172a;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ffffff;
    transition: background 0.2s ease, color 0.2s ease;
    user-select: none;
}

.faq-header-flat:hover {
    background: #f8fafc;
    color: #0b4d3c;
}

.faq-header-flat.active {
    background: #ecfdf5;
    color: #0b4d3c;
    border-bottom: 1px solid #d1fae5;
}

.faq-body-flat {
    padding: 16px 20px;
    font-size: 14px;
    line-height: 1.6;
    color: #475569;
    display: none;
    background: #ffffff;
}

.faq-body-flat.open {
    display: block;
}

.video-container-flat {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    background: #0f172a;
    border: 1px solid #e2e8f0;
}

.video-container-flat iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
</style>

<!-- SECTION 1: LAYANAN PMB (QUICK ACCESS) -->
<section class="pmb-section">
    <div class="container">
        <div class="section-header-flat">
            <span class="badge-tag">Portal Pendaftaran</span>
            <h2>Layanan Utama PMB</h2>
            <p>Akses cepat ke seluruh menu informasi dan administrasi pendaftaran mahasiswa baru</p>
        </div>

        <div class="service-grid-flat">
            <?php
            $perintah_layanan = "SELECT * FROM mod_data_layanan ORDER By id ASC LIMIT 8";
            $hasil_layanan = $koneksi_db->sql_query($perintah_layanan);
            while ($data_layanan = $koneksi_db->sql_fetchrow($hasil_layanan)) {
                $icon = !empty($data_layanan['icon']) ? $data_layanan['icon'] : 'check-circle';
            ?>
            <a href="<?= htmlspecialchars($data_layanan['link']); ?>" class="service-card-flat">
                <div class="icon-box">
                    <i class="fa fa-<?= htmlspecialchars($icon); ?>"></i>
                </div>
                <h3><?= htmlspecialchars($data_layanan['nama']); ?></h3>
            </a>
            <?php } ?>
        </div>

        <!-- HEROIC CTA BANNER -->
        <div class="cta-banner-flat">
            <h2>Penerimaan Mahasiswa Baru Telah Dibuka</h2>
            <p>Segera bergabung bersama Institut Agama Islam Persatuan Islam Bandung. Wujudkan masa depan gemilang dengan pendidikan berkualitas berlandaskan nilai-nilai Islam.</p>
            <a href="https://iaipibdg.sevimaplatform.com/spmbfront/" target="_blank" rel="noopener" class="btn-cta-main">
                <i class="fa fa-user-plus"></i> DAFTAR SEKARANG
            </a>
        </div>
    </div>
</section>

<!-- SECTION 2: SOCIAL MEDIA CHANNELS -->
<section class="pmb-section pmb-section-alt">
    <div class="container">
        <div class="section-header-flat">
            <span class="badge-tag">Konektivitas</span>
            <h2>Media & Informasi Resmi</h2>
            <p>Ikuti akun media sosial resmi kami untuk mendapatkan informasi terkini dan pengumuman seleksi</p>
        </div>

        <div class="social-grid-flat">
            <?php
            $perintah_social = "SELECT * FROM mod_data_layanan2 ORDER By id ASC LIMIT 6";
            $hasil_social = $koneksi_db->sql_query($perintah_social);
            while ($data_soc = $koneksi_db->sql_fetchrow($hasil_social)) {
                $soc_icon = $data_soc['icon'];
                // Handle tiktok / video icon cleanly
                if ($soc_icon === 'tiktok' || $soc_icon === 'fa-tiktok') {
                    $soc_icon = 'play-circle';
                }
            ?>
            <a href="<?= htmlspecialchars($data_soc['link']); ?>" target="_blank" rel="noopener" class="social-card-flat">
                <i class="fa fa-<?= htmlspecialchars($soc_icon); ?>"></i>
                <strong><?= htmlspecialchars($data_soc['nama']); ?></strong>
            </a>
            <?php } ?>
        </div>
    </div>
</section>

<!-- SECTION 3: BERITA & PENGUMUMAN KAMPUS -->
<section class="pmb-section">
    <div class="container">
        <div class="section-header-flat">
            <span class="badge-tag">Update & Agenda</span>
            <h2>Berita dan Informasi Seputar PMB</h2>
            <p>Dapatkan berita terbaru seputar kegiatan kampus, alur seleksi, dan pengumuman penting</p>
        </div>

        <div class="news-grid-flat">
            <?php
            $query_berita = $koneksi_db->sql_query("SELECT * FROM `artikel` WHERE publikasi=1 ORDER BY `id` DESC LIMIT 3");
            while ($data_berita = $koneksi_db->sql_fetchrow($query_berita)) {
                $url_slug = str_replace(" ", "-", $data_berita['judul']);
                $url_slug = preg_replace('/[^A-Za-z0-9\-]/', '', $url_slug);
                $url_slug = preg_replace('/-+/', '-', $url_slug);
                $url_slug = trim($url_slug, '-');
                if (empty($url_slug)) {
                    $url_slug = 'artikel-'.$data_berita['id'];
                }

                $img_src = 'images/berita-kampus-placeholder.jpg';
                if (!empty($data_berita['gambar']) && file_exists('images/artikel/'.$data_berita['gambar'])) {
                    $img_src = 'images/artikel/'.$data_berita['gambar'];
                }
            ?>
            <div class="news-card-flat">
                <div class="news-card-thumb">
                    <img src="<?= htmlspecialchars($img_src); ?>" alt="<?= htmlspecialchars($data_berita['judul']); ?>">
                </div>
                <div class="news-card-body">
                    <div>
                        <div class="news-card-meta">
                            <span><i class="fa fa-calendar-o"></i> <?= datetimess($data_berita['tgl']); ?></span>
                            <span><i class="fa fa-eye"></i> <?= $data_berita['hits']; ?> Views</span>
                        </div>
                        <a href="artikel/<?= $data_berita['id']; ?>/<?= $url_slug; ?>.html" class="news-card-title">
                            <?= htmlspecialchars($data_berita['judul']); ?>
                        </a>
                    </div>
                    <a href="artikel/<?= $data_berita['id']; ?>/<?= $url_slug; ?>.html" class="news-read-more">
                        Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="kategori/1/Berita-Kampus.html" class="btn-flat btn-flat-primary" style="padding: 14px 36px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                Lihat Semua Berita <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- SECTION 4: FAQ & VIDEO PROFIL -->
<section class="pmb-section pmb-section-alt">
    <div class="container">
        <div class="row">
            <!-- Kolom FAQ -->
            <div class="col-md-7 col-sm-12" style="margin-bottom: 30px;">
                <div style="margin-bottom: 25px;">
                    <span class="badge-tag" style="background: #ecfdf5; color: #0b4d3c; font-size: 11px; font-weight: 700; padding: 3px 10px; border: 1px solid #d1fae5; text-transform: uppercase;">Bantuan & Tanya Jawab</span>
                    <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 8px; text-transform: uppercase;">Pertanyaan Seputar PMB</h3>
                </div>

                <div class="faq-accordion-container">
                    <?php
                    $perintah_faq = "SELECT * FROM mod_data_faq ORDER By id ASC LIMIT 5";
                    $hasil_faq = $koneksi_db->sql_query($perintah_faq);
                    $faq_count = 0;
                    while ($data_faq = $koneksi_db->sql_fetchrow($hasil_faq)) {
                        $faq_count++;
                        $is_first = ($faq_count === 1);
                    ?>
                    <div class="faq-item-flat">
                        <div class="faq-header-flat <?= $is_first ? 'active' : ''; ?>" onclick="toggleFaq(this)">
                            <span><?= htmlspecialchars($data_faq['nama']); ?></span>
                            <i class="fa fa-<?= $is_first ? 'minus' : 'plus'; ?>"></i>
                        </div>
                        <div class="faq-body-flat <?= $is_first ? 'open' : ''; ?>">
                            <?= $data_faq['ket']; ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Kolom Video -->
            <div class="col-md-5 col-sm-12">
                <div style="margin-bottom: 25px;">
                    <span class="badge-tag" style="background: #ecfdf5; color: #0b4d3c; font-size: 11px; font-weight: 700; padding: 3px 10px; border: 1px solid #d1fae5; text-transform: uppercase;">Video Informasi</span>
                    <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 8px; text-transform: uppercase;">Profil & Panduan</h3>
                </div>

                <div class="video-container-flat">
                    <?php
                    $perintah_video = "SELECT * FROM mod_data_video ORDER By id DESC LIMIT 1";
                    $hasil_video = $koneksi_db->sql_query($perintah_video);
                    while ($data_video = $koneksi_db->sql_fetchrow($hasil_video)) {
                    ?>
                    <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($data_video['video']); ?>?rel=0" allowfullscreen></iframe>
                    <?php } ?>
                </div>
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-top: none; padding: 16px 20px;">
                    <div style="font-size: 13px; font-weight: 600; color: #0f172a;">
                        <i class="fa fa-youtube-play" style="color: #ef4444; margin-right: 6px;"></i> Saksikan Video Panduan PMB & Profil Kampus
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFaq(elem) {
    var body = elem.nextElementSibling;
    var icon = elem.querySelector('i');
    var isOpen = body.classList.contains('open');

    // Close all other faqs in container
    var container = elem.closest('.faq-accordion-container');
    var allHeaders = container.querySelectorAll('.faq-header-flat');
    var allBodies = container.querySelectorAll('.faq-body-flat');

    for (var i = 0; i < allHeaders.length; i++) {
        allHeaders[i].classList.remove('active');
        allHeaders[i].querySelector('i').className = 'fa fa-plus';
        allBodies[i].classList.remove('open');
    }

    if (!isOpen) {
        elem.classList.add('active');
        icon.className = 'fa fa-minus';
        body.classList.add('open');
    }
}
</script>
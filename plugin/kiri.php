<?php
global $koneksi_db, $maxkonten;

// 1. Ambil Data Profil Lembaga
$perintah_profil = "SELECT * FROM mod_data_profil LIMIT 1";
$hasil_profil = $koneksi_db->sql_query($perintah_profil);
$data_profil = $koneksi_db->sql_fetchrow($hasil_profil);
?>

<!-- ==========================================
     CSS PROSPERUM-INSPIRED PMB DESIGN SYSTEM
     ========================================== -->
<style>
/* CSS Reset & Variables */
:root {
    --pmb-green-dark: #073529;
    --pmb-green: #0b4d3c;
    --pmb-green-light: #ecfdf5;
    --pmb-gold: #c89a3b;
    --pmb-gold-hover: #e5b349;
    --pmb-slate: #0f172a;
    --pmb-muted: #64748b;
    --pmb-border: #e2e8f0;
    --pmb-bg-alt: #f8fafc;
}

/* SECTION UTILITIES */
.pmb-section {
    padding: 75px 0;
    position: relative;
}

.pmb-section-alt {
    background-color: var(--pmb-bg-alt);
    border-top: 1px solid var(--pmb-border);
    border-bottom: 1px solid var(--pmb-border);
}

.section-header-flat {
    text-align: center;
    margin-bottom: 45px;
    max-width: 750px;
    margin-left: auto;
    margin-right: auto;
}

.badge-tag {
    display: inline-block;
    background: #ecfdf5;
    color: #0b4d3c;
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    padding: 6px 14px;
    border: 1px solid #d1fae5;
    margin-bottom: 14px;
}

.section-header-flat h2 {
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-size: 30px;
    font-weight: 800;
    color: var(--pmb-slate) !important;
    line-height: 1.25;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: -0.5px;
}

.section-header-flat p {
    font-size: 15px;
    color: var(--pmb-muted);
    line-height: 1.6;
    margin: 0;
}

/* ==========================================
   1. HERO SECTION (PROSPERUM STYLE)
   ========================================== */
.pmb-hero-section {
    background: #073529;
    color: #ffffff;
    padding: 70px 0 120px 0;
    position: relative;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.pmb-hero-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
    flex-wrap: wrap;
}

.pmb-hero-content {
    flex: 1 1 560px;
}

.pmb-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(200, 154, 59, 0.15);
    border: 1px solid rgba(200, 154, 59, 0.4);
    color: #c89a3b;
    font-size: 11px;
    font-weight: 800;
    padding: 6px 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
}

.pmb-hero-title {
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-size: 42px;
    font-weight: 800;
    line-height: 1.2;
    color: #ffffff !important;
    margin-bottom: 20px;
    letter-spacing: -0.5px;
}

.pmb-hero-desc {
    font-size: 16px;
    line-height: 1.7;
    color: #d1fae5;
    margin-bottom: 32px;
    max-width: 580px;
}

.pmb-hero-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.btn-hero-primary {
    background: #c89a3b;
    color: #073529 !important;
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-weight: 800;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 15px 32px;
    border: none;
    border-radius: 0;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s ease;
}

.btn-hero-primary:hover {
    background: #e5b349;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
}

.btn-hero-outline {
    background: transparent;
    color: #ffffff !important;
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-weight: 700;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 14px 28px;
    border: 2px solid rgba(255,255,255,0.4);
    border-radius: 0;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s ease;
}

.btn-hero-outline:hover {
    border-color: #ffffff;
    background: rgba(255,255,255,0.1);
}

/* Floating Stat Badges on Right */
.pmb-hero-stats {
    flex: 0 1 360px;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.stat-badge-card {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.12);
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: transform 0.2s ease, background 0.2s ease;
}

.stat-badge-card:hover {
    background: rgba(255,255,255,0.12);
    transform: translateX(4px);
}

.stat-badge-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}

.stat-badge-icon.gold { background: #c89a3b; color: #073529; }
.stat-badge-icon.green { background: #0b4d3c; color: #ffffff; border: 1px solid #10b981; }
.stat-badge-icon.slate { background: #0f172a; color: #ffffff; border: 1px solid #334155; }

.stat-badge-text h4 {
    font-size: 15px;
    font-weight: 700;
    color: #ffffff !important;
    margin: 0 0 3px 0;
}

.stat-badge-text p {
    font-size: 12px;
    color: #94a3b8;
    margin: 0;
}

/* ==========================================
   2. OVERLAPPING QUICK ACTION CARDS
   ========================================== */
.pmb-overlap-container {
    margin-top: 26px;
    position: relative;
    z-index: 10;
    margin-bottom: 30px;
}

.pmb-overlap-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

@media (max-width: 991px) {
    .pmb-overlap-grid {
        grid-template-columns: 1fr;
    }
}

.overlap-card {
    background: #ffffff;
    border: 1px solid var(--pmb-border);
    padding: 30px 24px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    text-decoration: none !important;
}

.overlap-card:hover {
    border-color: var(--pmb-green);
    transform: translateY(-4px);
    box-shadow: 0 16px 30px rgba(11, 77, 60, 0.12);
}

.overlap-card-top {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 16px;
}

.overlap-icon {
    width: 48px;
    height: 48px;
    background: #ecfdf5;
    border: 1px solid #d1fae5;
    color: #0b4d3c;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    transition: all 0.2s ease;
}

.overlap-card:hover .overlap-icon {
    background: #0b4d3c;
    color: #ffffff;
}

.overlap-card-top h3 {
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-size: 16px;
    font-weight: 700;
    color: var(--pmb-slate) !important;
    margin: 0 0 6px 0;
    line-height: 1.3;
    text-transform: uppercase;
}

.overlap-card-top p {
    font-size: 13px;
    color: var(--pmb-muted);
    line-height: 1.5;
    margin: 0;
}

.overlap-link {
    font-size: 13px;
    font-weight: 700;
    color: #0b4d3c;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 10px;
    padding-top: 12px;
    border-top: 1px solid #f1f5f9;
}

.overlap-card:hover .overlap-link {
    color: #c89a3b;
}

/* ==========================================
   3. FEATURED SOLUTIONS / JALUR STUDI (PROSPERUM 3-CARD WITH FLOATING BADGE)
   ========================================== */
.solution-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}

@media (max-width: 991px) {
    .solution-grid {
        grid-template-columns: 1fr;
    }
}

.solution-card {
    background: #ffffff;
    border: 1px solid var(--pmb-border);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.solution-card:hover {
    border-color: var(--pmb-green);
    transform: translateY(-5px);
    box-shadow: 0 16px 32px rgba(0,0,0,0.08);
}

.solution-img-wrapper {
    position: relative;
    width: 100%;
    height: 210px;
    background: #0f172a;
    overflow: hidden;
}

.solution-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.solution-card:hover .solution-img-wrapper img {
    transform: scale(1.05);
}

/* Floating Icon Badge Overlapping Corner */
.solution-badge-overlap {
    position: absolute;
    bottom: -18px;
    right: 24px;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    border: 3px solid #ffffff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.12);
    z-index: 2;
}

.badge-gold { background: #c89a3b; color: #073529; }
.badge-green { background: #0b4d3c; color: #ffffff; }
.badge-slate { background: #0f172a; color: #ffffff; }

.solution-body {
    padding: 30px 24px 24px 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.solution-body h3 {
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-size: 18px;
    font-weight: 800;
    color: var(--pmb-slate) !important;
    margin: 0 0 10px 0;
    text-transform: uppercase;
}

.solution-body p {
    font-size: 14px;
    line-height: 1.6;
    color: var(--pmb-muted);
    margin-bottom: 22px;
}

.btn-solution-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #0b4d3c;
    color: #ffffff !important;
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 12px 20px;
    text-decoration: none !important;
    transition: all 0.2s ease;
    border: none;
    border-radius: 0;
    width: 100%;
}

.btn-solution-action:hover {
    background: #c89a3b;
    color: #073529 !important;
}

/* ==========================================
   4. HOW WE WORK (TIMELINE) & HELPDESK BOX (SIDE-BY-SIDE)
   ========================================== */
.how-it-works-row {
    display: flex;
    gap: 36px;
    align-items: stretch;
}

@media (max-width: 991px) {
    .how-it-works-row {
        flex-direction: column;
    }
}

.how-it-works-col {
    flex: 1 1 58%;
}

.helpdesk-box-col {
    flex: 1 1 42%;
}

/* Step Timeline */
.pmb-step-timeline {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 25px;
}

.pmb-step-item {
    display: flex;
    gap: 18px;
    background: #ffffff;
    border: 1px solid var(--pmb-border);
    padding: 18px 20px;
    transition: transform 0.2s ease, border-color 0.2s ease;
}

.pmb-step-item:hover {
    border-color: var(--pmb-green);
    transform: translateX(4px);
}

.pmb-step-num {
    width: 44px;
    height: 44px;
    background: #ecfdf5;
    border: 1px solid #d1fae5;
    color: #0b4d3c;
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-weight: 800;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.pmb-step-content h4 {
    font-size: 15px;
    font-weight: 700;
    color: var(--pmb-slate) !important;
    margin: 0 0 4px 0;
    text-transform: uppercase;
}

.pmb-step-content p {
    font-size: 13px;
    color: var(--pmb-muted);
    line-height: 1.5;
    margin: 0;
}

/* Dark Helpdesk Box (Prosperum Style) */
.helpdesk-dark-box {
    background: #073529;
    color: #ffffff;
    border: 1px solid #0b4d3c;
    padding: 36px 30px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.helpdesk-dark-box h3 {
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-size: 24px;
    font-weight: 800;
    color: #ffffff !important;
    margin: 0 0 10px 0;
    text-transform: uppercase;
}

.helpdesk-dark-box p {
    font-size: 14px;
    color: #d1fae5;
    line-height: 1.6;
    margin-bottom: 24px;
}

.helpdesk-info-row {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    padding: 12px 16px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 13px;
    color: #ecfdf5;
}

.helpdesk-info-row i {
    color: #c89a3b;
    font-size: 16px;
    width: 20px;
    text-align: center;
}

.btn-wa-helpdesk-direct {
    background: #25d366;
    color: #ffffff !important;
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-weight: 800;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 15px 24px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    border: none;
    text-decoration: none !important;
    width: 100%;
    margin-top: 14px;
    transition: all 0.2s ease;
}

.btn-wa-helpdesk-direct:hover {
    background: #1eb856;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
}

/* ==========================================
   5. BERITA & INFORMASI (3 CARDS FLAT)
   ========================================== */
.news-grid-flat {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 26px;
}

@media (max-width: 991px) {
    .news-grid-flat {
        grid-template-columns: 1fr;
    }
}

.news-card-flat {
    background: #ffffff;
    border: 1px solid var(--pmb-border);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.news-card-flat:hover {
    border-color: var(--pmb-green);
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.06);
}

.news-card-thumb {
    position: relative;
    width: 100%;
    height: 200px;
    background: #0f172a;
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
    font-family: var(--font-heading, 'Plus Jakarta Sans', sans-serif);
    font-size: 16px;
    font-weight: 700;
    line-height: 1.45;
    color: var(--pmb-slate) !important;
    margin-bottom: 12px;
    text-decoration: none !important;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card-title:hover {
    color: var(--pmb-green) !important;
}

.news-read-more {
    font-size: 13px;
    font-weight: 700;
    color: var(--pmb-green);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: auto;
    text-decoration: none !important;
}

.news-read-more:hover {
    color: var(--pmb-gold);
}

/* ==========================================
   6. SOCIAL MEDIA CHANNELS (PERFECT SYMMETRICAL FLEXBOX)
   ========================================== */
.social-flex-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
    max-width: 900px;
    margin: 0 auto;
}

.social-pill-card {
    background: #ffffff;
    border: 1px solid var(--pmb-border);
    padding: 20px 28px;
    min-width: 155px;
    text-align: center;
    text-decoration: none !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.social-pill-card:hover {
    background: #0f172a;
    border-color: #0f172a;
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.social-pill-card i {
    font-size: 26px;
    color: var(--pmb-green);
    transition: color 0.2s ease;
}

.social-pill-card strong {
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: color 0.2s ease;
}

.social-pill-card:hover i,
.social-pill-card:hover strong {
    color: #ffffff;
}

/* ==========================================
   7. FAQ & VIDEO PROFIL
   ========================================== */
.faq-item-flat {
    border: 1px solid var(--pmb-border);
    background: #ffffff;
    margin-bottom: 12px;
}

.faq-header-flat {
    padding: 16px 20px;
    font-weight: 700;
    font-size: 15px;
    color: var(--pmb-slate) !important;
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
    color: var(--pmb-green) !important;
}

.faq-header-flat.active {
    background: #ecfdf5;
    color: var(--pmb-green) !important;
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
    border: 1px solid var(--pmb-border);
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


<!-- ==========================================
     TOP TICKER PENGUMUMAN
     ========================================== -->
<?php if ($data_profil) { ?>
<div style="background: #04241c; color: #ecfdf5; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
        <div style="display: flex; align-items: center; gap: 10px; flex: 1; min-width: 280px;">
            <span style="background: #c89a3b; color: #073529; font-weight: 800; font-size: 11px; padding: 3px 8px; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap;">
                PENGUMUMAN
            </span>
            <div style="font-size: 13px; font-weight: 500; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                <?= htmlspecialchars($data_profil['nama']); ?>
            </div>
        </div>
        <div style="font-size: 12px; color: #94a3b8; display: flex; align-items: center; gap: 6px;">
            <i class="fa fa-map-marker" style="color: #c89a3b;"></i>
            <span><?= htmlspecialchars($data_profil['alamat']); ?></span>
        </div>
    </div>
</div>
<?php } ?>


<!-- ==========================================
     SECTION 1: OVERLAPPING QUICK ACTION CARDS
     ========================================== -->
<div class="container pmb-overlap-container">
    <div class="pmb-overlap-grid">
        <!-- Card 1 -->
        <a href="https://iaipibdg.sevimaplatform.com/spmbfront/" target="_blank" rel="noopener" class="overlap-card">
            <div>
                <div class="overlap-card-top">
                    <div class="overlap-icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <div>
                        <h3>Pendaftaran Online</h3>
                        <p>Registrasi akun calon mahasiswa dan pengisian biodata mandiri via portal Sevima.</p>
                    </div>
                </div>
            </div>
            <div class="overlap-link">
                Daftar Online Sekarang <i class="fa fa-arrow-right"></i>
            </div>
        </a>

        <!-- Card 2 -->
        <a href="pages/66/biaya-2026.html" class="overlap-card">
            <div>
                <div class="overlap-card-top">
                    <div class="overlap-icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <div>
                        <h3>Program Studi & Biaya</h3>
                        <p>Informasi rincian biaya kuliah terjangkau, skema pembayaran, dan pilihan program studi.</p>
                    </div>
                </div>
            </div>
            <div class="overlap-link">
                Lihat Rincian Biaya <i class="fa fa-arrow-right"></i>
            </div>
        </a>

        <!-- Card 3 -->
        <a href="pages/70/Brosur-PMB-2026-2027.html" class="overlap-card">
            <div>
                <div class="overlap-card-top">
                    <div class="overlap-icon">
                        <i class="fa fa-calendar-check-o"></i>
                    </div>
                    <div>
                        <h3>Brosur & Jadwal Seleksi</h3>
                        <p>Unduh e-brosur resmi PMB serta cek agenda tahapan pendaftaran gelombang aktif.</p>
                    </div>
                </div>
            </div>
            <div class="overlap-link">
                Unduh Brosur PMB <i class="fa fa-arrow-right"></i>
            </div>
        </a>
    </div>
</div>


<!-- ==========================================
     SECTION 3: PILIHAN PROGRAM & LAYANAN UNGGULAN (PROSPERUM 3-CARD SOLUTION)
     ========================================== -->
<section class="pmb-section">
    <div class="container">
        <div class="section-header-flat">
            <span class="badge-tag">Jalur & Layanan</span>
            <h2>Pilihan Program Studi & Jalur PMB</h2>
            <p>Pilih jalur pendaftaran dan sistem perkuliahan yang sesuai dengan kebutuhan dan cita-cita masa depan Anda</p>
        </div>

        <div class="solution-grid">
            <!-- Solution Card 1 -->
            <div class="solution-card">
                <div class="solution-img-wrapper">
                    <img src="images/gallery-01.jpg" onerror="this.onerror=null; this.src='images/course-img.jpg';" alt="Program Sarjana S1">
                    <div class="solution-badge-overlap badge-green">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="solution-body">
                    <div>
                        <h3>Program Sarjana (S1)</h3>
                        <p>Program sarjana unggulan dengan integrasi keilmuan Islam, sains, hukum ekonomi syariah, dan pendidikan berkualitas.</p>
                    </div>
                    <a href="pages/56/Progrm-Studi.html" class="btn-solution-action">
                        Pilihan Program Studi <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Solution Card 2 -->
            <div class="solution-card">
                <div class="solution-img-wrapper">
                    <img src="images/gallery-02.jpg" onerror="this.onerror=null; this.src='images/course-img.jpg';" alt="Kelas Online LMS">
                    <div class="solution-badge-overlap badge-gold">
                        <i class="fa fa-laptop"></i>
                    </div>
                </div>
                <div class="solution-body">
                    <div>
                        <h3>Kuliah Kelas Online LMS</h3>
                        <p>Sistem kuliah fleksibel berbasis Learning Management System modern untuk mahasiswa reguler maupun pekerja profesional.</p>
                    </div>
                    <a href="pages/58/Panduan-Pendaftran-Online-dan-pengisian-Form-Pendaftran.html" class="btn-solution-action">
                        Panduan Sistem Kuliah <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Solution Card 3 -->
            <div class="solution-card">
                <div class="solution-img-wrapper">
                    <img src="images/gallery-03.jpg" onerror="this.onerror=null; this.src='images/course-img.jpg';" alt="Jalur Beasiswa">
                    <div class="solution-badge-overlap badge-slate">
                        <i class="fa fa-trophy"></i>
                    </div>
                </div>
                <div class="solution-body">
                    <div>
                        <h3>Jalur Beasiswa & Prestasi</h3>
                        <p>Dukungan biaya pendidikan melalui beasiswa KIP-K, Tahfidz Al-Qur'an, dan beasiswa prestasi akademik & kelembagaan.</p>
                    </div>
                    <a href="pages/55/Beasiswa.html" class="btn-solution-action">
                        Informasi Beasiswa <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ==========================================
     SECTION 4: ALUR PENDAFTARAN & HELPDESK KONSULTASI (SIDE-BY-SIDE)
     ========================================== -->
<section class="pmb-section pmb-section-alt">
    <div class="container">
        <div class="how-it-works-row">
            <!-- Left: Alur Pendaftaran (How We Work) -->
            <div class="how-it-works-col">
                <span class="badge-tag">Panduan Alur</span>
                <h2 style="font-family: var(--font-heading); font-size: 26px; font-weight: 800; color: #0f172a !important; text-transform: uppercase; margin-bottom: 8px;">
                    Alur Pendaftaran Mahasiswa Baru
                </h2>
                <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;">
                    4 Langkah mudah dan praktis untuk menyelesaikan proses pendaftaran di IAI PERSIS Bandung
                </p>

                <div class="pmb-step-timeline">
                    <!-- Step 1 -->
                    <div class="pmb-step-item">
                        <div class="pmb-step-num">01</div>
                        <div class="pmb-step-content">
                            <h4>Registrasi Akun Online</h4>
                            <p>Buka portal SPMB Sevima dan daftarkan email serta nomor WhatsApp aktif Anda.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="pmb-step-item">
                        <div class="pmb-step-num">02</div>
                        <div class="pmb-step-content">
                            <h4>Pengisian Data & Berkas</h4>
                            <p>Lengkapi biodata diri, pilihan program studi, dan unggah dokumen persyaratan pendaftaran.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="pmb-step-item">
                        <div class="pmb-step-num">03</div>
                        <div class="pmb-step-content">
                            <h4>Ujian Seleksi Masuk</h4>
                            <p>Ikuti tahapan tes Computer Based Test (CBT) dan wawancara sesuai jadwal yang ditentukan.</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="pmb-step-item">
                        <div class="pmb-step-num">04</div>
                        <div class="pmb-step-content">
                            <h4>Pengumuman & Registrasi Ulang</h4>
                            <p>Cek status kelulusan pada akun pendaftaran dan lakukan pembayaran registrasi ulang mahasiswa baru.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Dark Helpdesk Consultation Box (Prosperum Style) -->
            <div class="helpdesk-box-col">
                <div class="helpdesk-dark-box">
                    <div>
                        <span style="background: rgba(200, 154, 59, 0.2); color: #c89a3b; font-size: 11px; font-weight: 800; padding: 4px 10px; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 12px; border: 1px solid rgba(200, 154, 59, 0.3);">
                            Helpdesk Center
                        </span>
                        <h3>Butuh Bantuan Pendaftaran?</h3>
                        <p>
                            Tim panitia PMB IAI PERSIS Bandung siap memandu dan menjawab pertanyaan Anda seputar pendaftaran, beasiswa, dan perkuliahan.
                        </p>

                        <div class="helpdesk-info-row">
                            <i class="fa fa-clock-o"></i>
                            <div><strong>Jam Layanan:</strong> Setiap Hari Kerja (07.00 - 16.00 WIB)</div>
                        </div>

                        <div class="helpdesk-info-row">
                            <i class="fa fa-phone"></i>
                            <div><strong>Hotline PMB:</strong> <?= htmlspecialchars($data_profil['telp'] ?? '0811-9081-122'); ?></div>
                        </div>

                        <div class="helpdesk-info-row">
                            <i class="fa fa-envelope-o"></i>
                            <div><strong>Email:</strong> <?= htmlspecialchars($data_profil['email'] ?? 'info@iaipibandung.ac.id'); ?></div>
                        </div>
                    </div>

                    <div>
                        <a href="https://wa.me/628119081122?text=Halo%20Panitia%20PMB%20IAI%20Persis%20Bandung,%20saya%20ingin%20bertanya%20seputar%20pendaftaran%20mahasiswa%20baru" target="_blank" rel="noopener" class="btn-wa-helpdesk-direct">
                            <i class="fa fa-whatsapp" style="font-size: 20px;"></i> KONSULTASI VIA WHATSAPP
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ==========================================
     SECTION 5: BERITA & INFORMASI SEPUTAR PMB (3 CARDS FLAT)
     ========================================== -->
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
                $raw_judul = $data_berita['judul'];
                // Decode double-encoded Windows-1252 to UTF-8
                if (strpos($raw_judul, 'ðŸ') !== false || strpos($raw_judul, 'â') !== false) {
                    $clean_title = mb_convert_encoding($raw_judul, 'Windows-1252', 'UTF-8');
                } else {
                    $clean_title = $raw_judul;
                }

                $clean_title = trim(preg_replace('/\s+/', ' ', $clean_title));
                if (empty($clean_title)) {
                    $clean_title = $raw_judul;
                }

                // Buat slug untuk link artikel
                $url_slug = str_replace(" ", "-", $clean_title);
                $url_slug = preg_replace('/[^A-Za-z0-9\-]/', '', $url_slug);
                $url_slug = preg_replace('/-+/', '-', $url_slug);
                $url_slug = trim($url_slug, '-');
                if (empty($url_slug)) {
                    $url_slug = 'artikel-'.$data_berita['id'];
                }

                // Penentuan path image src yang presisi
                $raw_gambar = $data_berita['gambar'];
                $img_src = 'images/course-img.jpg';

                if (!empty($raw_gambar)) {
                    if (strpos($raw_gambar, 'ðŸ') !== false || strpos($raw_gambar, 'â') !== false) {
                        $clean_gambar = mb_convert_encoding($raw_gambar, 'Windows-1252', 'UTF-8');
                    } else {
                        $clean_gambar = $raw_gambar;
                    }

                    if (file_exists('images/artikel/' . $clean_gambar)) {
                        $img_src = 'images/artikel/' . rawurlencode($clean_gambar);
                    } elseif (file_exists('images/artikel/' . $raw_gambar)) {
                        $img_src = 'images/artikel/' . rawurlencode($raw_gambar);
                    }
                }
            ?>
            <div class="news-card-flat">
                <div class="news-card-thumb">
                    <img src="<?= $img_src; ?>" onerror="this.onerror=null; this.src='images/course-img.jpg';" alt="<?= htmlspecialchars($clean_title); ?>">
                </div>
                <div class="news-card-body">
                    <div>
                        <div class="news-card-meta">
                            <span><i class="fa fa-calendar-o"></i> <?= datetimess($data_berita['tgl']); ?></span>
                            <span><i class="fa fa-eye"></i> <?= $data_berita['hits']; ?> Views</span>
                        </div>
                        <a href="artikel/<?= $data_berita['id']; ?>/<?= $url_slug; ?>.html" class="news-card-title">
                            <?= htmlspecialchars($clean_title); ?>
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
            <a href="kategori/1/Berita-Kampus.html" class="btn-solution-action" style="display: inline-flex; width: auto; padding: 14px 36px; font-size: 14px; letter-spacing: 1px;">
                Lihat Semua Berita <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</section>


<!-- ==========================================
     SECTION 6: SALURAN MEDIA RESMI (100% SYMMETRICAL CENTERED)
     ========================================== -->
<section class="pmb-section pmb-section-alt">
    <div class="container">
        <div class="section-header-flat">
            <span class="badge-tag">Konektivitas</span>
            <h2>Media & Informasi Resmi</h2>
            <p>Ikuti akun media sosial resmi kami untuk mendapatkan informasi terkini dan pengumuman seleksi</p>
        </div>

        <div class="social-flex-container">
            <?php
            $perintah_social = "SELECT * FROM mod_data_layanan2 ORDER By id ASC LIMIT 6";
            $hasil_social = $koneksi_db->sql_query($perintah_social);
            while ($data_soc = $koneksi_db->sql_fetchrow($hasil_social)) {
                $soc_icon = $data_soc['icon'];
                if ($soc_icon === 'tiktok' || $soc_icon === 'fa-tiktok' || $soc_icon === 'reply') {
                    $soc_icon = 'play';
                } elseif ($soc_icon === 'video' || $soc_icon === 'play') {
                    $soc_icon = 'youtube-play';
                }
            ?>
            <a href="<?= htmlspecialchars($data_soc['link']); ?>" target="_blank" rel="noopener" class="social-pill-card">
                <i class="fa fa-<?= htmlspecialchars($soc_icon); ?>"></i>
                <strong><?= htmlspecialchars($data_soc['nama']); ?></strong>
            </a>
            <?php } ?>
        </div>
    </div>
</section>


<!-- ==========================================
     SECTION 7: FAQ & VIDEO PROFIL KAMPUS
     ========================================== -->
<section class="pmb-section">
    <div class="container">
        <div class="row">
            <!-- Kolom FAQ -->
            <div class="col-md-7 col-sm-12" style="margin-bottom: 30px;">
                <div style="margin-bottom: 25px;">
                    <span class="badge-tag">Bantuan & Tanya Jawab</span>
                    <h3 style="font-family: var(--font-heading); font-size: 24px; font-weight: 800; color: #0f172a !important; margin-top: 8px; text-transform: uppercase;">Pertanyaan Seputar PMB</h3>
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
                    <span class="badge-tag">Video Informasi</span>
                    <h3 style="font-family: var(--font-heading); font-size: 24px; font-weight: 800; color: #0f172a !important; margin-top: 8px; text-transform: uppercase;">Profil & Panduan</h3>
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
                <div style="background: #ffffff; border: 1px solid var(--pmb-border); border-top: none; padding: 16px 20px;">
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
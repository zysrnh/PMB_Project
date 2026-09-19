































			<?php
global $koneksi_db, $maxkonten;
$perintah="SELECT * FROM mod_data_profil";
$hasil = $koneksi_db->sql_query( $perintah );
$coint_i = 0;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    $coint_i++;
    $id = md5($data['id']);
?>
<footer style="background-color: #0f172a; color: #94a3b8; padding-top: 60px; font-family: var(--font-main); border-top: 4px solid #0b4d3c;">
    <div class="container">
        <div class="row" style="margin-bottom: 40px;">
            <!-- Kolom 1: Tentang Kami -->
            <div class="col-md-5 col-sm-12" style="margin-bottom: 30px;">
                <h3 style="color: #ffffff; font-size: 18px; font-weight: 800; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 0.5px; border-left: 3px solid #c89a3b; padding-left: 10px;">
                    Tentang Kampus
                </h3>
                <p style="font-size: 14px; line-height: 1.7; color: #cbd5e1; margin-bottom: 20px;">
                    <?= $data['desc']; ?>
                </p>
                <div style="font-size: 13px; line-height: 2; color: #cbd5e1;">
                    <div><i class="fa fa-map-marker" style="color: #c89a3b; width: 20px;"></i> <?= htmlspecialchars($data['alamat']); ?></div>
                    <div><i class="fa fa-phone" style="color: #c89a3b; width: 20px;"></i> Telp: <?= htmlspecialchars($data['telp']); ?></div>
                    <div><i class="fa fa-envelope-o" style="color: #c89a3b; width: 20px;"></i> Email: <?= htmlspecialchars($data['email']); ?></div>
                </div>
            </div>

            <!-- Kolom 2: Quick Links -->
            <div class="col-md-4 col-sm-12" style="margin-bottom: 30px;">
                <h3 style="color: #ffffff; font-size: 18px; font-weight: 800; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 0.5px; border-left: 3px solid #c89a3b; padding-left: 10px;">
                    Menu Pintasan
                </h3>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 14px; line-height: 2.2;">
                    <?php 
                    $hasil3 = $koneksi_db->sql_query( "SELECT * FROM menu2 WHERE published=1 ORDER BY ordering LIMIT 6" );
                    while ($datamenu3 = $koneksi_db->sql_fetchrow($hasil3)) {
                    ?>
                    <li>
                        <a href="<?= htmlspecialchars($datamenu3['url']); ?>" style="color: #cbd5e1; text-decoration: none; transition: color 0.2s ease;">
                            <i class="fa fa-angle-right" style="color: #c89a3b; margin-right: 8px;"></i> <?= htmlspecialchars($datamenu3['menu2']); ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <!-- Kolom 3: Media Sosial -->
            <div class="col-md-3 col-sm-12" style="margin-bottom: 30px;">
                <h3 style="color: #ffffff; font-size: 18px; font-weight: 800; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 0.5px; border-left: 3px solid #c89a3b; padding-left: 10px;">
                    Media Sosial
                </h3>
                <p style="font-size: 13px; color: #94a3b8; margin-bottom: 16px;">
                    Terhubung langsung dengan kanal komunikasi resmi kami:
                </p>
                <div style="display: flex; flex-direction: column; gap: 8px; font-size: 13px;">
                    <?php if(!empty($data['fb'])) { ?>
                    <a href="<?= $data['fb']; ?>" target="_blank" style="color: #cbd5e1; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-facebook-square" style="color: #60a5fa; font-size: 18px; width: 20px;"></i> Facebook
                    </a>
                    <?php } ?>
                    <?php if(!empty($data['in'])) { ?>
                    <a href="<?= $data['in']; ?>" target="_blank" style="color: #cbd5e1; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-instagram" style="color: #f472b6; font-size: 18px; width: 20px;"></i> Instagram
                    </a>
                    <?php } ?>
                    <?php if(!empty($data['wa'])) { ?>
                    <a href="https://api.whatsapp.com/send?phone=<?= $data['wa']; ?>" target="_blank" style="color: #cbd5e1; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-whatsapp" style="color: #4ade80; font-size: 18px; width: 20px;"></i> WhatsApp PMB
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div style="background-color: #090d16; border-top: 1px solid rgba(255,255,255,0.06); padding: 18px 0; font-size: 13px; color: #64748b;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <div>
                Copyright &copy; <?= date('Y'); ?> <strong><?= htmlspecialchars($data['nama']); ?></strong>. All rights reserved.
            </div>
            <div style="font-size: 12px;">
                Sistem Penerimaan Mahasiswa Baru (PMB)
            </div>
        </div>
    </div>
</footer>
<?php } ?>

<!-- WhatsApp Floating Button Flat -->
<div style="position: fixed; left: 20px; bottom: 20px; z-index: 9999;">
    <a href="https://api.whatsapp.com/send?phone=+628119081122&text=Assalamu%27alaikum%20Admin%20PMB%20IAI%20Persis%20Bandung..." target="_blank" rel="noopener" style="text-decoration: none;">
        <div style="background: #25D366; color: #ffffff; padding: 10px 18px; font-weight: 700; font-size: 13px; display: flex; align-items: center; gap: 8px; border: 1px solid #1ebd59; box-shadow: 0 4px 14px rgba(37, 211, 102, 0.4); border-radius: 0px;">
            <i class="fa fa-whatsapp" style="font-size: 20px;"></i>
            <span>Chat Helpdesk PMB</span>
        </div>
    </a>
</div>

<a href="#kingster-top-anchor" class="kingster-footer-back-to-top-button" id="kingster-footer-back-to-top-button" style="border-radius: 0px;"><i class="fa fa-angle-up"></i></a>

<script type='text/javascript' src='wp-content/plugins/goodlayers-core/plugins/combine/script6a4d.js?ver=6.1.1' id='gdlr-core-plugin-js'></script>
<script type='text/javascript' src='wp-content/plugins/goodlayers-core/include/js/page-builderd36b.js?ver=1.3.9' id='gdlr-core-page-builder-js'></script>
<script type='text/javascript' src='wp-includes/js/jquery/ui/effect.min3f14.js?ver=1.13.2' id='jquery-effects-core-js'></script>
<script type='text/javascript' src='wp-content/themes/kingster/js/script-core8a54.js?ver=1.0.0' id='kingster-script-core-js'></script>
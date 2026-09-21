<?php
$perintah = "SELECT * FROM slider ORDER By id DESC LIMIT 1";
$hasil = $koneksi_db->sql_query($perintah);
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    if (!empty($data['foto']) && file_exists('images/slides/' . $data['foto'])) {
        echo '
        <div class="pmb-slider-banner-wrap" style="width: 100%; line-height: 0; background: #073529; text-align: center;">
            <img src="images/slides/' . htmlspecialchars($data['foto']) . '" alt="' . htmlspecialchars($data['nama']) . '" style="width: 100%; height: auto; display: block; margin: 0 auto; max-width: 100%;">
        </div>';
    }
}
?>